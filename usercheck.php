<?php
include("connect.php");
$portid = $_GET["portid"];
$r=$conn->query("SELECT * FROM connection WHERE portid='$portid'");
$value=$r->fetch_array();
echo $value['toconnect'];
?>