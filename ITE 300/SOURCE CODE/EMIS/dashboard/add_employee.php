<?php
session_start();
include('Employee.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $employee = new Employee();
    $employee->addEmployee($id,$name, $email, $phone,$address);

    header('location: admin_dashboard.php');
    exit();
}
?>
