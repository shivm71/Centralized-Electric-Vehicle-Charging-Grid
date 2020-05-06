<?php
include("connect.php");
session_start();
if($_SESSION!=null)
{
  header('location:led.php');
  exit(1);
}
if(isset($_POST['sub']))
{
$email=$_POST['email'];
$pass=$_POST['pass'];
if($email==null || $pass==null)
{
  echo "email and password is required";
}
else{
$r=$conn->query("SELECT email,password FROM user WHERE email='$email' AND password='$pass'");
if($r->num_rows>0)
{
  $_SESSION['email']=$email;
  header('location:led.php');
  exit(1);
 }
else
{
    echo "Invalide email or password";
}
}
}
?>

<!DOCTYPE html>
<html>
        <style>
input[type=text], select,input[type=email],input[type=password] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin-left: auto;
  margin-right: auto;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: center;
  
}

input[type=submit]:hover {
  background-color: #45a049;
}
input[type=text]:focus,input[type=email]:focus,input[type=password]:focus {
  border: 3px solid #555;
}


div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
 
}
</style>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
  
   <h1 style="text-align: center;">Login</h1><p><a href="register.php">Register?</a></p>

 <div class="form">
   	<form action="" method="POST">
   		<input type="email" name="email" placeholder="email"><br>
   		<input type="password" name="pass" placeholder="password"><br>
   		<input type="submit" name="sub" value="Login">
   	</form>
   </div>
</body>
</html>