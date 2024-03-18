<?php
include('db_connect.php');

class Employee {
    public function getAllEmployees() {
        global $conn;
        $sql = "SELECT * FROM employees";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmployeeDetails($id) {
        global $conn;
        $sql = "SELECT * FROM employees WHERE id = $id";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function addEmployee($id,$name,$gender,$department, $email,$phone,$position,$address) {
        global $conn;
        $sql = "INSERT INTO employees (id,name,gender,department, email,phone,position,address) VALUES ('$id','$name','$gender','$department', '$email','$phone','$position','$address')";
        $conn->query($sql);
    }

    public function editEmployee($id, $name,$gender,$department, $email, $phone,$position, $address) {
        global $conn;
        $sql = "UPDATE employees SET id='$id',name='$name',gender='$gender',department='$department', email='$email' ,phone='$phone',position='$position',address='$address' WHERE id=$id";
        $conn->query($sql);
    }

    public function deleteEmployee($id) {
        global $conn;
        $sql = "DELETE FROM employees WHERE id = $id";
        $conn->query($sql);
        
    }
}
?>
