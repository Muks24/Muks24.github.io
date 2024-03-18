<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $phone = ($_POST['phone']);
    $address = ($_POST['address']);

    

    $db_connect = mysqli_connect('localhost', 'root', '', 'employee_db');
    $query = "INSERT INTO employees (name, email,phone,address) VALUES ('$name', '$email', '$phone','$address')";
    $result = mysqli_query($db_connect, $query);
    if ($result) {
        header('location: account.php');
        exit();
    } else {
        header('location: signup.php?error=failed');
        exit();
    }
}
?>
