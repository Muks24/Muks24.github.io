<?php
session_start();
include('Employee.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

$employee = new Employee();
$employees = $employee->getAllEmployees();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for CRUD operations
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        
body {
    color: black;
    font-family: Arial, sans-serif;
    font-size: 15px;
    margin: 20px;
    background-color: #3E0C0C;
    background-image: url('bg-ram.jpg');
        background-size: cover;
  margin-left: 25%;
  margin-right: 25%;
}
h1 {
    color: white;
    font-family: Arial, sans-serif;
    font-size: 40px;
    margin: 20px;
    text-align: left;
}
p,label {
    color: black;
    font-family: Arial, sans-serif;
    font-size: 15px;
    margin: 20px;
}
input[type=button], input[type=submit] {
    background-color: #3CB043;
    color: white;
    border-radius: 5px;
    width: 100px;
    height: 25px;
    cursor: pointer;
    margin-bottom: 10px;
}

button, input[type=text], input[type=password], input[type=tel], input[type=email] {
    background-color: white;
    color: black;
    border-radius: 5px;
    width: 140px;
    height: 25px;
    cursor: pointer;
    margin-bottom: 10px;
}

select {
    background-color: white;
    color: gray;
    border-radius: 5px;
    width: 300px;
    height: 25px;
    cursor: pointer;
    margin-bottom: 10px;
}
table {
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
}

th, td {
    border: 1px solid #ccc;
    padding: 8px;
}

th {
    background-color: none;
    text-align: left;
}

a {
    text-decoration: none;
    margin-right: 10px;
}
a:link {
    text-decoration: white;
}
a:visited {
    text-decoration: white;
}
a:hover {
    text-decoration: white;
}
a:active {
    text-decoration: white;
}

a:logout {
    text-align: right;
}
form {
    margin-bottom: 20px;
}
.bg {
    background-image: url("bg-ram.jpg");
    height: 120px;
    width: 75%;
    border-radius: 10px;
    font-family: Arial, sans-serif;
    font-size: 50px;
}
input.logout {
    float:right;
    background-color: red;
}
.container {
  border-radius: 5px;
  background-color: white;
  padding: 20px;
}
        </style>
</head>
<body>

<form action="logout.php" method="post">
        <input type="submit" value="Log Out" class="logout">
    </form>
<center>
    <header>
        <h1>Welcome, Admin!</h1>
    </header>
<div class="container"
    <main>
        <section>
            <h2>EMPLOYEE LIST</h2>
            <HR>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($employees as $employee) { ?>
                    <tr>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['email'] ?></td>
                        <td><?= $employee['phone'] ?></td>
                        <td><?= $employee['address'] ?></td>
                        <td> 
                           <a href="edit_employee.php?id=<?= $employee['id'] ?>">Edit</a>
                           <a href="delete_employee.php?id=<?= $employee['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <h2>Add New Employee</h2><form action="add_employee.php" method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" name="phone" placeholder="Phone" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="submit" value="Add Employee">
    </form>
    
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Your Company</p>
    </footer>
                </div>
                </center>
</body>
</html>
