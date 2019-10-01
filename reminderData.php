<?php
include("init.php");
session_start();
if(isset($_POST))
{
 $date=$_POST["date"];
 $date=str_ireplace(" ","/",$date);
 $date=str_ireplace("January","01",$date);
 $date=str_ireplace("February","02",$date);
 $date=str_ireplace("March","03",$date);
 $date=str_ireplace("April","04",$date);
 $date=str_ireplace("May","05",$date);
 $date=str_ireplace("June","06",$date);
 $date=str_ireplace("July","07",$date);
 $date=str_ireplace("August","08",$date);
 $date=str_ireplace("September","09",$date);
 $date=str_ireplace("October","10",$date);
 $date=str_ireplace("November","11",$date);
 $date=str_ireplace("December","12",$date);
 $event=$_POST["event"];
 $time=$_POST["time"];
 $daily=$_POST["daily"];
 $weekly=$_POST["weekly"];
 $monthly=$_POST["monthly"];
 $never=$_POST["never"];
 $monday=$_POST["monday"];
 $tuesday=$_POST["tuesday"];
 $wednesday=$_POST["wednesday"];
 $thursday=$_POST["thursday"];
 $friday=$_POST["friday"];
 $saturday=$_POST["saturday"];
 $sunday=$_POST["sunday"];
 $fname=$_SESSION['fname'];
 $email=$_SESSION['email'];
 $number=$_SESSION['number'];
 // $fname = mysql_real_escape_string($fname);
 // $email = mysql_real_escape_string($email);
 $sql="insert into $fname(fname,email,number,date,event,time,daily,weekly,monthly,never,monday,tuesday,wednesday,thursday,friday,saturday,sunday) values('$fname','$email','$number','$date','$event','$time','$daily','$weekly','$monthly','$never','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday','$sunday')";
if(mysqli_multi_query($con,$sql))
{

echo "<br><h3> row inserted...</h3>done";

}
else
{

echo "Error in insertion...".mysqli_error($con);
}
}
?>