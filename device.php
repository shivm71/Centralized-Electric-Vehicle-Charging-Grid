<?php
include("connect.php");
$email=$_GET['email'];
$current = $_GET['current'];
$r=$conn->query("SELECT energy,paymentdue,count FROM user WHERE email='$email'");
$value=$r->fetch_array();
$count = $value['count'];

if($current < 1.40){
   $count = $count + 1;
    //  $conn->query("UPDATE user SET chargeverified='0' WHERE email='$email'");
    // $conn->query("UPDATE connection SET toconnect='0' WHERE portid='B22A6'");
}
else{ $count = 0; }
echo $current."ser".$count;
$conn->query("UPDATE user SET count='$count' WHERE email='$email'");
if($count >= 5){
    $conn->query("UPDATE user SET chargeverified='0' WHERE email='$email'");
    $conn->query("UPDATE connection SET toconnect='0' WHERE portid='B22A6'");
}

$voltage = 5.25;
// whr = (voltage * current) / 3600000

// echo "<pre>";print_r
$energy =  $value['energy'];
$energy = $energy + (($voltage * $current*1000) / 3600);
$conn->query("UPDATE user SET energy='$energy' WHERE email='$email'");
$paymentdue = round(($energy*25),2);
$conn->query("UPDATE user SET paymentdue='$paymentdue' WHERE email='$email'");
// echo $energy;

?>