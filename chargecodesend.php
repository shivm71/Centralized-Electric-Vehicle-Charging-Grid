<?php
include("connect.php");
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;
// Base files 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
session_start();
$email = $_SESSION['email'];
$s=$conn->query("SELECT * FROM user WHERE email='$email'");
$row = $s->fetch_array();
// echo "<pre>";print_r($row);die;
$wrongcount = $row["wrongcount"];
if ($wrongcount >= 3)
{
    header("location:block.php");
}
$portid = $_POST["portid"];
$r=$conn->query("SELECT * FROM connection WHERE portid='$portid'");
if($r->num_rows>0)
{
    $row = $r->fetch_array();
    // echo "<pre>";print_r($row);die;
    if ($row["toconnect"] == '0')
    {
        $random = rand(10000,99999);
        $conn->query("UPDATE user SET chargecode='$random' WHERE email='$email'");
        
        
        
        // mailing
            // PHPMailer classes into the global namespace
        
        // create object of PHPMailer class with boolean parameter which sets/unsets exception.
        // $email = $_SESSION["email"];
        $mail = new PHPMailer(true);                              
        try {
            $mail->isHTML(true);
            $mail->isSMTP(); // using SMTP protocol                                     
            $mail->Host = 'smtp.hostinger.in'; // SMTP host as gmail 
            $mail->SMTPAuth = true;  // enable smtp authentication                             
            $mail->Username = 'helpdesk@divineocean.in';  // sender gmail host              
            $mail->Password = 'Shivam'; // sender gmail host password                          
            $mail->SMTPSecure = 'ssl';  // for encrypted connection                           
            $mail->Port = 465;   // 465 587 port for SMTP      
        
            $mail->setFrom('helpdesk@divineocean.in', "CHARGEIT"); // sender's email and name
            $mail->addAddress($email, "Receiver");  // receiver's email and name
        
            $mail->Subject = 'VERIFICATION EMAIL';
            $mail->Body    = '<html>
        <head>
        <title>HTML email</title>
        <style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
          padding: 5px;
          text-align: left;
        }
        </style>
        </head>
        <body>
        <p></p>
        <p>VERIFICATION CODE </p>
        <p>PLEASE DONOT SHARE CODE WITH ANYONE </p>
        <p> YOUR CHARGING CODE IS - <span><h2>'.$random.'</h2></span> </p>
        
        </body>
        </html>';
        
            $mail->send();
            // echo 'CHARGING CODE has been sent PLEASE check you email'; 
            ?>
            <html>
            <body>
                <h1>CODE SENT </h1>
                <p> please enter below to start charging. and please note to check the ev is connected before entering the code.</p>
                <form action = "chargeverify.php"  method = "POST" >
                    <input type = "text" name = "code">
                    <input type = "submit" name = "submit">
                </form>
            </body>
        </html>
        <?php } catch (Exception $e) { // handle error.
            echo 'Code could not be sent.PLEASE login again due to security reasons.';
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    else
    {
        echo " SORRY THE PORT IS BUSY.PLEASE TRY AGAIN LATER. THANK YOU";
    }
}
else{echo "INVALID CHARGING PORT CODE.PLEASE SCAN AGAIN OR ENTER THE CODE CORRECTLY";}
?>
