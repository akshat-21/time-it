<?php
include("init.php");
if(isset($_POST))
{
 $fname=$_POST["fname"];
 $bname=$fname."_b";
 $lname=$_POST["lname"];
 $email=$_POST["email"];
 $number=$_POST["number"];
 $password=$_POST["password"];
 $sql="insert into users(fname,lname,email,number,password) values('$fname','$lname','$email','$number','$password');";
 $sql .= "create table $fname(id int auto_increment,fname varchar(50),email varchar(50),number varchar(20),date varchar(50),event varchar(50),time varchar(50),daily varchar(1),weekly varchar(1),monthly varchar(1),never varchar(1),monday varchar(1),tuesday varchar(1),wednesday varchar(1),thursday varchar(1),friday varchar(1),saturday varchar(1),sunday varchar(1),primary key(id));";
 $sql .="create table $bname(id int auto_increment,part varchar(50),amount varchar(50),primary key(id))";if(mysqli_multi_query($con,$sql))
{

echo "<br><h3> row inserted...</h3>";

}
else
{

echo "Error in insertion...".mysqli_error($con);
}
}
?>