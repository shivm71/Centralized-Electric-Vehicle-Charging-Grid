<?php
include("connect.php");
session_start();


$random = $_POST["code"];
$email = $_SESSION['email'];

$r=$conn->query("SELECT * FROM user WHERE email='$email'");
$row = $r->fetch_array();
// echo "<pre>";print_r($row);die;
$wrongcount = $row["wrongcount"];
// echo "<pre>";print_r($row);
if ($row["chargecode"] == $random)
{
    $conn->query("UPDATE user SET wrongcount = '0' WHERE email='$email'");
    // echo "verified";
    $conn->query("UPDATE user SET chargeverified = '1' WHERE email='$email'");
    $conn->query("UPDATE connection SET toconnect = '$email' WHERE portid='B22A6'");
    header("location:led.php");
}
else{
    $wrongcount = $wrongcount + 1;
    
    $conn->query("UPDATE user SET wrongcount = '$wrongcount' WHERE email='$email'");
    // echo "<pre>";print_r($wrongcount);die;
    header("location:led.php");
}
if ($wrongcount >= 3)
{
    header("location:block.php");
}


?>

