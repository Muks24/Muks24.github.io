<?php
session_start();
include('Employee.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('location: admin_dashboard.php');
    exit();
}

$employee = new Employee();
$employee->deleteEmployee($_GET['id']);

header('location: admin_dashboard.php');
exit();
?>
