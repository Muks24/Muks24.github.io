// ================== Import Dependencies ==================
const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const methodOverride = require('method-override');
const bcrypt = require('bcryptjs');
const db = require('./db');
const app = express();
const PORT = 3000;

// ================== Middleware Setup ==================
app.use(bodyParser.urlencoded({ extended: false }));
app.use(methodOverride('_method'));
app.use(express.static('public'));
app.set('view engine', 'ejs');

// ================== Session Configuration ==================
app.use(session({
    secret: 'secret',
    resave: false,
    saveUninitialized: true
}));

// ================== Authentication Middleware ==================
const auth = (roles) => (req, res, next) => {
    if (req.session.user && roles.includes(req.session.user.role)) {
        next();
    } else {
        res.redirect('/login');
    }
};

// ================== Basic Routes ==================
app.get('/', (req, res) => {
    res.render('index');
});

app.get('/login', (req, res) => {
    res.render('login');
});

app.post('/login', (req, res) => {
    const { username, password } = req.body;
    db.query('SELECT * FROM users WHERE username = ?', [username], (err, results) => {
        if (err) throw err;
        if (results.length && bcrypt.compareSync(password, results[0].password)) {
            req.session.user = results[0];
            res.redirect('/dashboard');
        } else {
            res.send('Invalid Credentials');
        }
    });
});

app.get('/logout', (req, res) => {
    req.session.destroy();
    res.redirect('/login');
});

// ================== Dashboard Route ==================
app.get('/dashboard', auth(['captain', 'secretary', 'resident']), (req, res) => {
    res.render('dashboard', { user: req.session.user });
});

// ================== Announcements Routes ==================
// Display All Announcements
app.get('/announcements', auth(['captain', 'secretary', 'resident']), (req, res) => {
    db.query('SELECT * FROM announcements ORDER BY date DESC', (err, results) => {
        if (err) {
            console.error('Error fetching announcements:', err);
            return res.status(500).send('Error retrieving announcements');
        }
        res.render('announcements', { user: req.session.user, announcements: results });
    });
});

// Display Create Announcement Form (for Captain and Secretary only)
app.get('/announcements/create', auth(['captain', 'secretary']), (req, res) => {
    res.render('create_announcement', { user: req.session.user });
});

// Handle Creating New Announcement
app.post('/announcements/create', auth(['captain', 'secretary']), (req, res) => {
    const { title, content } = req.body;
    const posted_by = req.session.user.username;

    db.query(
        'INSERT INTO announcements (title, content, posted_by) VALUES (?, ?, ?)', 
        [title, content, posted_by], 
        (err) => {
            if (err) {
                console.error('Error inserting announcement:', err);
                return res.status(500).send('Error creating announcement');
            }
            res.redirect('/announcements');
        }
    );
});
// ================== View Pending Requests (For Captain) ==================
app.get('/requests/pending', auth(['captain']), (req, res) => {
    const businessQuery = `
        SELECT bp.id, bp.purpose, bp.details, bp.requested_by, bp.date, 
               r.first_name, r.last_name, r.address, r.contact
        FROM business_permits bp
        JOIN residents r ON bp.requested_by = r.username
        WHERE bp.status = 'pending'
        ORDER BY bp.date DESC
    `;

    const clearanceQuery = `
        SELECT bc.id, bc.purpose, bc.details, bc.requested_by, bc.date, 
               r.first_name, r.last_name, r.address, r.contact
        FROM barangay_clearances bc
        JOIN residents r ON bc.requested_by = r.username
        WHERE bc.status = 'pending'
        ORDER BY bc.date DESC
    `;

    db.query(`${businessQuery}; ${clearanceQuery}`, (err, results) => {
        if (err) {
            console.error('Error fetching pending requests:', err.message);
            return res.status(500).send('Error retrieving pending requests');
        }

        // Check if the results array is as expected
        console.log('Pending Requests Results:', results);

        // Check if results contain two arrays for business and clearance requests
        if (Array.isArray(results) && results.length === 2) {
            res.render('pending_requests', {
                user: req.session.user,
                businessRequests: results[0],
                clearanceRequests: results[1]
            });
        } else {
            console.error('Unexpected results format:', results);
            res.status(500).send('Unexpected results format');
        }
    });
});
// ================== Approve Request (For Captain) ==================
app.post('/requests/approve/:type/:id', auth(['captain']), (req, res) => {
    const { type, id } = req.params;
    let table = '';

    if (type === 'business_permit') {
        table = 'business_permits';
    } else if (type === 'barangay_clearance') {
        table = 'barangay_clearances';
    } else {
        return res.status(400).send('Invalid request type');
    }

    const query = `UPDATE ${table} SET status = 'approved' WHERE id = ?`;

    db.query(query, [id], (err) => {
        if (err) {
            console.error('Error approving request:', err);
            return res.status(500).send('Error approving request');
        }
        res.redirect('/requests/pending');
    });
});

// ================== Profile Route ==================
app.get('/profile', auth(['captain', 'secretary', 'resident']), (req, res) => {
    res.render('profile', { user: req.session.user });
});

// ================== Residents Route ==================
app.get('/residents', auth(['captain', 'secretary']), (req, res) => {
    db.query('SELECT * FROM residents ORDER BY created_at DESC', (err, results) => {
        if (err) throw err;
        res.render('residents', { user: req.session.user, residents: results });
    });
});
// ================== Document Request Selection ==================
app.get('/requests', auth(['captain', 'secretary', 'resident']), (req, res) => {
    res.render('request', { user: req.session.user });
});
// ================== Request Business Permit ==================
app.get('/requests/business_permit', auth(['captain', 'secretary', 'resident']), (req, res) => {
    res.render('request_business_permit', { user: req.session.user });
});

app.post('/requests/business_permit', auth(['captain', 'secretary', 'resident']), (req, res) => {
    const { business_name, business_address, business_details } = req.body;
    const requested_by = req.session.user.username;

    db.query(
        'INSERT INTO business_permits (business_name, business_address, business_details, requested_by, status) VALUES (?, ?, ?, ?, "pending")', 
        [business_name, business_address, business_details, requested_by], 
        (err) => {
            if (err) {
                console.error('Error inserting business permit request:', err);
                return res.status(500).send('Error creating business permit request');
            }
            res.redirect('/requests');
        }
    );
});

// ================== Request Barangay Clearance ==================
app.get('/requests/barangay_clearance', auth(['captain', 'secretary', 'resident']), (req, res) => {
    res.render('request_barangay_clearance', { user: req.session.user });
});

app.post('/requests/barangay_clearance', auth(['captain', 'secretary', 'resident']), (req, res) => {
    const { purpose, details } = req.body;
    const requested_by = req.session.user.username;

    db.query(
        'INSERT INTO barangay_clearances (purpose, details, requested_by, status) VALUES (?, ?, ?, "pending")', 
        [purpose, details, requested_by], 
        (err) => {
            if (err) {
                console.error('Error inserting barangay clearance request:', err);
                return res.status(500).send('Error creating barangay clearance request');
            }
            res.redirect('/requests');
        }
    );
});

// ================== Main Reports Page ==================
app.get('/reports', auth(['captain', 'secretary']), (req, res) => {
    res.render('reports', { user: req.session.user });
});

// ================== Reports Data Route ==================
app.get('/reports/data', auth(['captain', 'secretary']), (req, res) => {
    const type = req.query.type;
    const filter = req.query.filter;
    let query = '';
    
    // Handle Business Permits
    if (type === 'business_permit' || type === 'business_permits') {
        if (filter === 'weekly') {
            query = `
                SELECT WEEK(date) AS label, COUNT(*) AS value 
                FROM business_permits 
                WHERE status = 'approved'
                GROUP BY WEEK(date)
                ORDER BY WEEK(date)
            `;
        } else if (filter === 'monthly') {
            query = `
                SELECT MONTH(date) AS label, COUNT(*) AS value 
                FROM business_permits 
                WHERE status = 'approved'
                GROUP BY MONTH(date)
                ORDER BY MONTH(date)
            `;
        } else if (filter === 'yearly' || filter === 'per_year') {
            query = `
                SELECT YEAR(date) AS label, COUNT(*) AS value 
                FROM business_permits 
                WHERE status = 'approved'
                GROUP BY YEAR(date)
                ORDER BY YEAR(date)
            `;
        }
    }

    // Handle Barangay Clearances
    else if (type === 'barangay_clearance' || type === 'barangay_clearances') {
        if (filter === 'weekly') {
            query = `
                SELECT WEEK(date) AS label, COUNT(*) AS value 
                FROM barangay_clearances 
                WHERE status = 'approved'
                GROUP BY WEEK(date)
                ORDER BY WEEK(date)
            `;
        } else if (filter === 'monthly') {
            query = `
                SELECT MONTH(date) AS label, COUNT(*) AS value 
                FROM barangay_clearances 
                WHERE status = 'approved'
                GROUP BY MONTH(date)
                ORDER BY MONTH(date)
            `;
        } else if (filter === 'yearly' || filter === 'per_year') {
            query = `
                SELECT YEAR(date) AS label, COUNT(*) AS value 
                FROM barangay_clearances 
                WHERE status = 'approved'
                GROUP BY YEAR(date)
                ORDER BY YEAR(date)
            `;
        }
    }

    if (query) {
        db.query(query, (err, results) => {
            if (err) {
                console.error('Error fetching chart data:', err);
                return res.status(500).send('Error retrieving chart data');
            }
            const labels = results.map(row => row.label);
            const values = results.map(row => row.value);
            res.json({ labels, values });
        });
    } else {
        res.status(400).send('Invalid type or filter');
    }
});
// ================== Barangay Officials Routes ==================

// Display All Barangay Officials
app.get('/officials', auth(['captain', 'secretary', 'resident']), (req, res) => {
    db.query('SELECT * FROM officials ORDER BY position ASC', (err, results) => {
        if (err) {
            console.error('Error fetching officials:', err);
            return res.status(500).send('Error retrieving officials');
        }
        res.render('officials', { user: req.session.user, officials: results });
    });
});

// Display Add Official Form (For Captain Only)
app.get('/officials/add', auth(['captain']), (req, res) => {
    res.render('add_official', { user: req.session.user });
});

// Handle Adding New Official (For Captain Only)
app.post('/officials/add', auth(['captain']), (req, res) => {
    const { name, position, term_start, term_end, contact } = req.body;

    db.query(
        'INSERT INTO officials (name, position, term_start, term_end, contact) VALUES (?, ?, ?, ?, ?)', 
        [name, position, term_start, term_end, contact], 
        (err) => {
            if (err) {
                console.error('Error inserting official:', err);
                return res.status(500).send('Error adding official');
            }
            res.redirect('/officials');
        }
    );
});

// Display Edit Official Form (For Captain Only)
app.get('/officials/edit/:id', auth(['captain']), (req, res) => {
    db.query('SELECT * FROM officials WHERE id = ?', [req.params.id], (err, results) => {
        if (err) {
            console.error('Error fetching official:', err);
            return res.status(500).send('Error retrieving official');
        }
        res.render('edit_official', { user: req.session.user, official: results[0] });
    });
});

// Handle Editing Official (For Captain Only)
app.post('/officials/edit/:id', auth(['captain']), (req, res) => {
    const { name, position, term_start, term_end, contact } = req.body;

    db.query(
        'UPDATE officials SET name = ?, position = ?, term_start = ?, term_end = ?, contact = ? WHERE id = ?', 
        [name, position, term_start, term_end, contact, req.params.id], 
        (err) => {
            if (err) {
                console.error('Error updating official:', err);
                return res.status(500).send('Error editing official');
            }
            res.redirect('/officials');
        }
    );
});

// Handle Deleting Official (For Captain Only)
app.post('/officials/delete/:id', auth(['captain']), (req, res) => {
    db.query('DELETE FROM officials WHERE id = ?', [req.params.id], (err) => {
        if (err) {
            console.error('Error deleting official:', err);
            return res.status(500).send('Error deleting official');
        }
        res.redirect('/officials');
    });
});
// ================== SK Officials Routes ==================

// Display All SK Officials
app.get('/sk_officials', auth(['captain', 'secretary', 'resident']), (req, res) => {
    db.query('SELECT * FROM sk_officials ORDER BY position ASC', (err, results) => {
        if (err) {
            console.error('Error fetching SK officials:', err);
            return res.status(500).send('Error retrieving SK officials');
        }
        res.render('sk_officials', { user: req.session.user, sk_officials: results });
    });
});

// Display Add SK Official Form (For Captain Only)
app.get('/sk_officials/add', auth(['captain']), (req, res) => {
    res.render('add_sk_official', { user: req.session.user });
});

// Handle Adding New SK Official (For Captain Only)
app.post('/sk_officials/add', auth(['captain']), (req, res) => {
    const { name, position, term_start, term_end, contact } = req.body;

    db.query(
        'INSERT INTO sk_officials (name, position, term_start, term_end, contact) VALUES (?, ?, ?, ?, ?)', 
        [name, position, term_start, term_end, contact], 
        (err) => {
            if (err) {
                console.error('Error inserting SK official:', err);
                return res.status(500).send('Error adding SK official');
            }
            res.redirect('/sk_officials');
        }
    );
});

// Display Edit SK Official Form (For Captain Only)
app.get('/sk_officials/edit/:id', auth(['captain']), (req, res) => {
    db.query('SELECT * FROM sk_officials WHERE id = ?', [req.params.id], (err, results) => {
        if (err) {
            console.error('Error fetching SK official:', err);
            return res.status(500).send('Error retrieving SK official');
        }
        res.render('edit_sk_official', { user: req.session.user, sk_official: results[0] });
    });
});

// Handle Editing SK Official (For Captain Only)
app.post('/sk_officials/edit/:id', auth(['captain']), (req, res) => {
    const { name, position, term_start, term_end, contact } = req.body;

    db.query(
        'UPDATE sk_officials SET name = ?, position = ?, term_start = ?, term_end = ?, contact = ? WHERE id = ?', 
        [name, position, term_start, term_end, contact, req.params.id], 
        (err) => {
            if (err) {
                console.error('Error updating SK official:', err);
                return res.status(500).send('Error editing SK official');
            }
            res.redirect('/sk_officials');
        }
    );
});

// Handle Deleting SK Official (For Captain Only)
app.post('/sk_officials/delete/:id', auth(['captain']), (req, res) => {
    db.query('DELETE FROM sk_officials WHERE id = ?', [req.params.id], (err) => {
        if (err) {
            console.error('Error deleting SK official:', err);
            return res.status(500).send('Error deleting SK official');
        }
        res.redirect('/sk_officials');
    });
});


// ================== Start Server ==================
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
