<?php
session_start();
include('Employee.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

$employee = new Employee();
$employees = $employee->getAllEmployees();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        
body {
    color: black;
    font-family: Arial, sans-serif;
    font-size: 15px;
    margin: 20px;
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
    font-weight: bold;
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
input.logout{
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
    <header>
        <h1>Welcome, User!</h1>
    </header>

    <main>
        <section>
        <div class="container">
            <h2>EMPLOYEE LIST</h2>
            <hr>
            
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
                <?php foreach ($employees as $employee) { ?>
                    <tr>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['email'] ?></td>
                        <td><?= $employee['phone'] ?></td>
                        <td><?= $employee['address'] ?></td>
                    </tr>
                <?php } ?>
            </table>
                </div>
        </section>
    </main>

    <footer>
        <center><p>&copy; 2023 Your Company</p></center>
    </footer>
</body>
</html>
