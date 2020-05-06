<?php
// echo(rand(1000,9999));
include("connect.php");
session_start();
$email = $_SESSION['email'];
$r=$conn->query("SELECT * FROM user WHERE email='$email'");
$row = $r->fetch_array();

$paymentdue = $row["paymentdue"];
// echo $paymentdue;
// echo"<pre>";print_r($row);
if(isset($_POST['submit']))
{
    $paymentdue = round(($paymentdue - $_POST["pay"]),2); 
    $conn->query("UPDATE user SET paymentdue='$paymentdue' WHERE email='$email'");
    header("location:led.php");
    

}
?>
<html>
        <style>
input[type=text], select,input[type=email],input[type=number] {
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
input[type=text]:focus,input[type=number]:focus,input[type=email]:focus {
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
  
   <h1 style="text-align: center;">PAYMENT</h1><p>ENTER AMOUNT TO PAY</p>

 <div class="form">
   	<form action="" method="POST">
   		<input type="email" name="bla" placeholder="email" value = "<?php echo $paymentdue; ?>" disabled>
   		<input type="number" name="pay" placeholder="ENTER AMOUNT TO PAY"><br>
   		<input type="submit" name="submit" value="PAY">
   	</form>
   </div>
</body>
</html>