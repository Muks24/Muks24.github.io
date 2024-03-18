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
    <title>Employee Information System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>

    <h2>Employee List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
            
        </tr>
        <?php foreach ($employees as $emp): ?>
        <tr>
        <td><?php echo $emp['id']; ?></td>
            <td><?php echo $emp['name']; ?></td>
            <td><?php echo $emp['email']; ?></td>
            <td><?php echo $emp['phone']; ?></td>
            <td><?php echo $emp['address']; ?></td>
            <td>
                <a href="edit_employee.php?id=<?php echo $emp['id']; ?>">Edit</a>
                <a href="delete_employee.php?id=<?php echo $emp['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add New Employee</h2>
    <form action="add_employee.php" method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" name="phone" placeholder="Phone" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="submit" value="Add Employee">
    </form>

    <script src="script.js"></script>
</body>
</html>
