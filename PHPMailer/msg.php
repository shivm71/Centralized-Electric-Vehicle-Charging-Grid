<?php
// PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;
// Base files 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// create object of PHPMailer class with boolean parameter which sets/unsets exception.
$mail = new PHPMailer(true);                              
try {
    $mail->isSMTP(); // using SMTP protocol                                     
    $mail->Host = 'cpanel.freehosting.com'; // SMTP host as gmail 
    $mail->SMTPAuth = true;  // enable smtp authentication                             
    $mail->Username = 'helpdesk@divineocean.in';  // sender gmail host              
    $mail->Password = 'Jwm968kI3c'; // sender gmail host password                          
    $mail->SMTPSecure = 'ssl';  // for encrypted connection                           
    $mail->Port = 465;   // port for SMTP     

    $mail->setFrom('helpdesk@divineocean.in', "Sender"); // sender's email and name
    $mail->addAddress('shivamshah71@gmail.com', "Receiver");  // receiver's email and name

    $mail->Subject = 'Test subject';
    $mail->Body    = 'Test body';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) { // handle error.
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>