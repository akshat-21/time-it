<?php
$host="mysql.hostinger.in";
$user="u671790095_root";
$password="qwerty123";
$db="u671790095_time";

$con=mysqli_connect($host,$user,$password,$db);
if(!$con)
{
    die('Could not connect: ' . mysql_error());
}   
else
{
	//echo "Connection sucess";
}

?>