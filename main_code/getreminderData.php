<?php
include("init.php");
session_start();
$fname=$_SESSION['fname'];
$sql="Select * from $fname order by 'date' ASC";
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