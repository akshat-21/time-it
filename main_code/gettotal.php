<?php
include("init.php");
session_start();
$fname=$_SESSION['fname'];
$bname=$fname."_b";
$sql="SELECT SUM(amount) from $bname";
$result=mysqli_query($con,$sql);
if($result)
{
	$response = array();
	$count=0;
	while($row=mysqli_fetch_array($result))
	{
		array_push($response,array("Sum"=>$row[0]));
	}
	echo json_encode($response,JSON_FORCE_OBJECT);
}
?>