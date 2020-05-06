<?php
$conn =new mysqli("localhost","u371677447_root","shivam","u371677447_iot");
$name_error=null;
$email_ckek=null;

if(isset($_POST['sub']))
{
    
    $name =$_POST['name'];
    $email=$_POST['email'];
    $mno=$_POST['mobile'];
    $pass=$_POST['pass'];
    
    if($name==null)
        {
         $name_error="Can not left blank";
        }
    else
        {
        $r=$conn->query("SELECT id FROM user WHERE email='".$email."'");
        // echo "<pre>";print_r($conn);
        // die;
        if($r->num_rows>0)
            {
               $email_ckek= "email already exist";
               
             
            }
            else
            {   
                $sql = "INSERT INTO `user` ( `name`, `mobileno`, `password`, `email`, `verified`, `chargeverified`, `energy`, `paymentdue`) VALUES ( '$name', '$mno', '$pass', '$email', '0', '0', '0', '0')";
                if($conn->query($sql) === TRUE)
                {
                    header('location:login.php');
            	    exit(1);
                }
                else
                {
                    echo "insert failed";
                    
                }
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
  margin: 8px 0;
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
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>
   <h1 style="text-align: center;">Registration</h1><p><a href="login.php">if Already a Member</a></p>
   <div class="form">
   	<form action="" method="POST">
   	    <input type="text" name="name" placeholder="Name"><span><?php echo $name_error; ?></span> <br>
   		<input type="email" name="email" placeholder="E-mail"><?php echo $email_ckek; ?><br>
   		<input type="text" name="mobile" placeholder="Mobile No"><br>
   		<input type="password" name="pass" placeholder="Password"><br>
   		<input type="submit" name="sub" value="Register">
   		
   	
   	</form>
   	
   </div>
</body>
</html>