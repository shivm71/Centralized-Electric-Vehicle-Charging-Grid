<?php
include("connect.php");
$email = $_GET["email"];
$r=$conn->query("SELECT * FROM user WHERE email='$email'");
$value=$r->fetch_array();
echo $value['chargeverified'];
?>