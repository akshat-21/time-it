<?php
include("init.php");
session_start();
$fname=$_SESSION["fname"];
$bname=$fname."_b";
$part=$_POST["part"];
$amount=$_POST["amount"];
$sql="insert into $bname(part,amount) values ('$part','$amount')";
if(mysqli_query($con,$sql))
	echo "inserted";
else
	echo "not inserted";
?>