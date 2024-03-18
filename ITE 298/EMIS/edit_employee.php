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
$empDetails = $employee->getEmployeeDetails($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $address = $_POST['address'];

    $employee->editEmployee($id, $name,$gender,$department, $email, $phone,$position, $address);

    header('location: admin_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Details</title>
<style>
* {
  box-sizing: border-box;
}

body {
    color: black;
    font-family: Arial, sans-serif;
    font-size: 15px;
    margin: 20px;
    background-image: url('bg-ram.jpg');
        background-size: cover;
  margin-left: 30%;
  margin-right: 30%;
}
input[type=text],input[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: none;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: white;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

.row::after {
  content: "";
  display: table;
  clear: both;
}

@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body onLoad="PopWindowOne()">
    <div class="container">
    <h1>Edit Details</h1>
    <hr>
    <form method="post" action="">


    <div class="row">
    <div class="col-25">
      <label for="department">Department</label>
    </div>
    <div class="col-25">
<div class="col-75">
    <select id="department" name="department">
        <option value="---" >Department</option>
        <option value="HR" <?php echo ($empDetails['department'] == 'HR') ? 'selected' : ''; ?>>HR</option>
        <option value="IT" <?php echo ($empDetails['department'] == 'IT') ? 'selected' : ''; ?>>IT</option>
        <option value="MAINTENANCE" <?php echo ($empDetails['department'] == 'MAINTENANCE') ? 'selected' : ''; ?>>MAINTENANCE</option>
        <option value="DATABASE" <?php echo ($empDetails['department'] == 'DATABASE') ? 'selected' : ''; ?>>DATABASE</option>
        <option value="ENGINEERING" <?php echo ($empDetails['department'] == 'ENGINEERING') ? 'selected' : ''; ?>>ENGINEERING</option>
        
    </select></div>
</div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="department">Position</label>
    </div>
    <div class="col-75">
    <input type="text" id="position" name="position" value="<?php echo $empDetails['position']; ?>">
    </div>

        <input type="hidden" name="id" value="<?php echo $empDetails['id']; ?>">
  <div class="row">
    <div class="col-25">
      <label for="fname">Name</label>
    </div>
    <div class="col-75">
    <input type="text" id="name" name="name" value="<?php echo $empDetails['name']; ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="gender">Gender</label>
    </div>
    <div class="col-25">
<div class="col-75">
    <select id="gender" name="gender">
    <option value="---" >Gender</option>
        <option value="Male" <?php echo ($empDetails['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo ($empDetails['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        <option value="Other" <?php echo ($empDetails['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option> 
    </select></div>
</div>
  </div> 



  <div class="row">
    <div class="col-25">
      <label for="email">Email</label>
    </div>
    <div class="col-75">
    <input type="email" id="email" name="email" value="<?php echo $empDetails['email']; ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Phone</label>
    </div>
    <div class="col-75">
    <input type="text" id="phone" name="phone" value="<?php echo $empDetails['phone']; ?>">
    </div>
  </div>





  <div class="row">
    <div class="col-25">
      <label for="subject">Address</label>
    </div>
    <div class="col-75">
    <textarea id="address" name="address"><?php echo $empDetails['address']; ?></textarea>
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>

</body>
</html>


