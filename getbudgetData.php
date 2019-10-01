<?php
include("init.php");
session_start();
$fname=$_SESSION['fname'];
$bname=$fname."_b";
$sql="Select * from $bname";
$result=mysqli_query($con,$sql);
if($result)
{
	$rows = array();
	$count=0;
	while($r = mysqli_fetch_assoc($result)){
		$rows[$count++] = $r;
	}
	echo json_encode($rows);
}
?>