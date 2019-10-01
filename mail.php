<?php
// echo "Today is " . date("d/m/Y") . "<br>";
// echo "Today is " . date("Y.m.d") . "<br>";
// echo "Today is " . date("Y-m-d") . "<br>";
// $day=strtolower(date("l"));
// echo "Today is " . $day."<br>";
// $day=strtolower($day);
// if("sunday"==$day)
// 	echo "yes<br>";
// else
// 	echo "no<br>";
date_default_timezone_set("Asia");
echo "The time is " . date("h:i:sa")."<br>";
echo "The time is " . date("h:i").'<br>';
$t=time();
echo($t . "<br>");
$date="14:50";
$min=substr_replace($date,"",0,3);
$min=(int)$min;
$min=$min*60;
echo $min."<br>";
$hrs=substr_replace($date,"",2,3);
$hrs=(int)$hrs;
$hrs=$hrs*60*60;
echo $hrs;

// include("init.php");
// $fname="sagar";
// $sql="Select * from $fname order by 'date' ASC";
// $result=mysqli_query($con,$sql);
// if($result)
// {
// 	$rows = array();
// 	$count=0;
// 	while($r = mysqli_fetch_assoc($result)){
// 		$rows[$count++] = $r;
// 	}
// 	echo json_encode($rows);
// }
?>