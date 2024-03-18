<?php
session_start();
include('Employee.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $address = $_POST['address'];

    $employee = new Employee();
    $employee->addEmployee($id,$name,$gender,$department, $email, $phone,$position,$address);

    header('location: admin_dashboard.php');
    exit();
}
?>
