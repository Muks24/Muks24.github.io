<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $department = ($_POST['department']);
    $position = ($_POST['position']);
    $name = ($_POST['name']);
    $gender = ($_POST['gender']);    
    $email = ($_POST['email']);
    $phone = ($_POST['phone']);    
    $address = ($_POST['address']);

    

    $db_connect = mysqli_connect('localhost', 'root', '', 'employee_db');
    $query = "INSERT INTO employees (department,position,name,gender, email,phone,address) VALUES ('$department','$position','$name','$gender', '$email', '$phone','$address')";
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
