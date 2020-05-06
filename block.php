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
        
            $mail->Subject = 'UNAUTHORIZED ATTEMPT ';
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
        <p>VERIFICATION LIMIT REACHED </p>
        <p>CHARGING BLOCKED  </p>
        <p><span><h2>LOGIN TO UNBLOCK</h2></span> </p>
        
        </body>
        </html>';
        
            $mail->send();
            // echo 'CHARGING CODE has been sent PLEASE check you email'; 
            ?>
            <html>
            <body>
                <h1>CHARGING BLOCKED! </h1>
                <p> YOUR VERIFICATION LIMIT HAS BEEN REACHED.PLEASE LOGIN TO UNBLOCK</p>
                <!--<form action = "chargeverify.php"  method = "POST" >-->
                <!--    <input type = "text" name = "code">-->
                <!--    <input type = "submit" name = "submit">-->
                <!--</form>-->
            </body>
        </html>
        <?php } catch (Exception $e) { // handle error.
            echo 'Code could not be sent.PLEASE login again due to security reasons.';
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
?>
