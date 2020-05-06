<?php
session_start();
$email = $_SESSION['email'];
include("connect.php");
$conn->query("UPDATE user SET chargeverified='0' WHERE email='$email'");
$conn->query("UPDATE connection SET toconnect='0' WHERE portid='B22A6'");
// $conn->query("UPDATE user SET chargeverified='0' WHERE email='$email'");

session_destroy();
header('location:login.php');
exit(1);

?>