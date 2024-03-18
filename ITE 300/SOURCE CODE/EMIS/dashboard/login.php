<?php
session_start();

if (isset($_SESSION['username'])) {
    header('location: admin_dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assuming you have a database connection
    $db_connect = mysqli_connect('localhost', 'root', '', 'employee_db');

    if (!$db_connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db_connect, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = $user['usertype'];

            // Redirect based on account type
            if ($user['usertype'] == 'Admin') {
                header('location: admin_dashboard.php');
            } elseif ($user['usertype'] == 'user') {
                header('location: user_dashboard.php');
            }
            exit();
        }
    }

    mysqli_close($db_connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
body {
    color: white;
    font-family: Arial, sans-serif;
    font-size: 20px;
    margin: 20px;
    background-image: url('bg-ram.jpg');
        background-size: cover;
}
p,label {
    color: white;
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

input[type=text], input[type=password] {
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
}

th, td {
    border: 1px solid #ccc;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

a {
    text-decoration: none;
    margin-right: 10px;
}

form {
    margin-bottom: 20px;
}
.bg {
    height: 120px;
    width: 75%;
    border-radius: 10px;
    font-family: Arial, sans-serif;
    font-size: 50px;
}

.container {
  border-radius: 15px;
  background-color: black;
  padding: 20px;
    margin-left: 35%;
    margin-right: 35%;
}
        </style>
</head>
<body>
    <center>
    <div class="bg">
        <br>
        RAMBUTAN PRIME HOLDINGS INC
    </div>
    <br>
    <div class="container">
        <h2>LOGIN</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>&nbsp;
            <input type="password" name="password" placeholder="Password" required><br>
            <label for="usertype">Select User Type:</label><br>
            <select id="usertype" name="usertype">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <br><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</center>
</body>
</html>


