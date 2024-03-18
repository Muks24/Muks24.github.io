<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <style>
    body {
    color: black;
    font-family: Arial, sans-serif;
    font-size: 20px;
    margin: 20px;
    background-color: black;
    background-image: url('bg-ram.jpg');
        background-size: cover;
}

.container {
  border-radius: 10px;
  background-color: white;
  padding: 20px;
  margin-left: 30%;
  margin-right: 30%;
}
p,label {
    color: gray;
    font-family: Arial, sans-serif;
    font-size: 15px;
    margin: 20px;
}
input[type=button], input[type=submit] {
    background-color: #3CB043;
    color: white;
    border-radius: 5px;
    width: 140px;
    height: 25px;
    cursor: pointer;
    margin-bottom: 10px;
}

input[type=reset] {
    background-color: red;
    color: white;
    border-radius: 5px;
    width: 140px;
    height: 25px;
    cursor: pointer;
    margin-bottom: 10px;
}
input[type=text], input[type=password],input[type=email],input[type=tel]{
    background-color: white;
    color: black;
    border-radius: 5px;
    width: 300px;
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
    background-color: #f2f2f2;
}

a {
    text-decoration: none;
    margin-right: 10px;
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
</style>
</head>
<body>
    <center>
    <div class="container">
        <h2>CREATE ACCOUNT</h2>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>            
            <label for="usertype">Select User Type:</label>
            <br>
            <select id="usertype" name="usertype">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <br>
            <input type="reset" value="reset">
            <input type="submit" value="create account">
        </form>
    </div>
</center>
</body>
</html>
