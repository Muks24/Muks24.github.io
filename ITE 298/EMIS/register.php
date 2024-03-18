<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $usertype = ($_POST['usertype']);

    

    $db_connect = mysqli_connect('localhost', 'root', '', 'employee_db');
    $query = "INSERT INTO users (username, password, usertype) VALUES ('$username', '$password', '$usertype')";
    $result = mysqli_query($db_connect, $query);
    if ($result) {
        header('location: login.php');
        exit();
    } else {
        header('location: signup.php?error=failed');
        exit();
    }
}
?>
