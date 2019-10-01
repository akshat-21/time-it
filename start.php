<?php
include("init.php");  
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}   
else
{
//	echo "Connection sucess";
}
date_default_timezone_set('Asia/Kolkata');
$time=date("G:i");
// echo $time."<br>";
$hrs=substr_replace($time,"",2,3);
$hrs=(int)$hrs;
$hrs=$hrs*60*60;
// echo $hrs."<br>";
$min=substr_replace($time,"",0,3);
$min=(int)$min;
$min=$min*60;
// echo $min."<br>";

$ct=$hrs+$min;
 echo $ct."<br>";


    // Authorisation details.
    $username = "contact.timeit@gmail.com";
    $hash = "0aa53ec37dbec312f06915dbe246512743c01eb4";

    // Config variables. Consult http://api.textlocal.in/docs for more info.
    $test = "0";

    // Data for text message. This is the text message data.
    $sender = "TXTLCL"; // This is who the message appears to be from.

$sql="SELECT fname FROM users";
$result=mysqli_query($con,$sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fname=$row["fname"];
        $sql1="SELECT * FROM $fname";
		$result1=mysqli_query($con,$sql1);
		if ($result1->num_rows > 0) 
        {
            while($row1 = $result1->fetch_assoc())
            {
                $time=$row1["time"];
                $min=substr_replace($time,"",0,3);
                $min=(int)$min;
                $min=$min*60;
                // echo $min."<br>";
                $hrs=substr_replace($time,"",2,3);
                $hrs=(int)$hrs;
                $hrs=$hrs*60*60;
                // echo $hrs."<br>";
                $time=$hrs+$min;

                if(($time-$ct<3600)&&($time-$ct>=0))
                {
                if($row1["never"]==1)
                {
                        $numbers = $row1["number"]; // A single number or a comma-seperated list of numbers
                        $numbers ="91".$numbers;
                        echo $numbers;
                        $message=$row1["fname"]." you have ".$row1["event"]." on ".$row1["date"]." at ".$row1["time"];
                        mail($row1["email"],"One time Reminder from Time-it",$message);
                        // 612 chars or less
                        // A single number or a comma-seperated list of numbers
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                    $event=$row1['event'];
                    $sql2="DELETE from $fname where event='$event'";
                    $result2=mysqli_query($con,$sql2);
                    if($result2)
                        echo "deleted";
                    else
                        echo "error";
                }
                else if($row1["daily"]==1)
                {
                        $numbers = $row1["number"]; // A single number or a comma-seperated list of numbers
                        $numbers ="91".$numbers;
                        echo $numbers;
                        $message=$row1["fname"]." you have ".$row1["event"]." on ".$row1["date"]." at ".$row1["time"];
                        mail($row1["email"],"Daily Reminder from Time-it",$message);
                        // 612 chars or less
                        // A single number or a comma-seperated list of numbers
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                }
                else if($row1["weekly"]==1)
                {
                    $message=$row1["fname"]." you have ".$row1["event"]." on ".$row1["date"]." at ".$row1["time"];
                    $message1="Today is " . date("l") ."\n";
                    $message=$message1." ".$message;
                    $numbers = $row1["number"]; // A single number or a comma-seperated list of numbers
                    $numbers ="91".$numbers;
                        echo $numbers;
                        // 612 chars or less
                        // A single number or a comma-seperated list of numbers
                    $day=strtolower(date("l"));
                    if(($day=="monday")&&($row1["monday"]==1)){
                        mail($row1["email"],"Weekly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                        
                    }
                    if(($day=="tuesday")&&($row1["tuesday"]==1)){
                        mail($row1["email"],"Weekly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                    }
                    if(($day=="wednesday")&&($row1["wednesday"]==1)){
                        mail($row1["email"],"Weekly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                        
                    }
                    if(($day=="thursday")&&($row1["thursday"]==1)){
                        mail($row1["email"],"Weekly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                        
                    }
                    if(($day=="friday")&&($row1["friday"]==1)){
                        mail($row1["email"],"Weekly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                        
                    }
                    if(($day=="saturday")&&($row1["saturday"]==1)){
                        mail($row1["email"],"Weekly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                        
                    }
                    if(($day=="sunday")&&($row1["sunday"]==1)){
                        mail($row1["email"],"Weekly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);
                        
                    }
                }
                else if($row1["monthly"]==1)
                {
                    $message=$row1["fname"]." you have ".$row1["event"]." on ".$row1["date"]." at ".$row1["time"];
                    $message1="Today is " . date("l") ."\n";
                    $message=$message1." ".$message; 
                    $numbers = $row1["number"]; // A single number or a comma-seperated list of numberss
                    $numbers ="91".$numbers;
                        echo $numbers;
                        // 612 chars or less
                        // A single number or a comma-seperated list of numbers
                                              
                    $date1=date("d/m/Y");
                    if($row1["date"]==$date1)  
                    {   
                        mail($row1["email"],"Monthly Reminder from Time-it",$message);
                        $message = urlencode($message);
                        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;                                  
                        echo "here";         
                        $ch = curl_init('http://api.textlocal.in/send/?');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        if($result = curl_exec($ch))
                            echo "sent"; // This is the result from the API
                        else
                            echo "not sent";
                        curl_close($ch);       
                        
                    }
                }
               // echo $row1["fname"]." ".$row1["email"]." ".$row1["date"]." ".$row1["event"]." ".$row1["time"]." ".$row1["daily"]." ".$row1["weekly"]." ".$row1["monthly"]." ".$row1["never"]."<br>";
            }
            else
            {
                echo "nothing sent";
            }
        }
    }
        else
        {
            echo "wrong";
        }
    }
} 
else {
    echo "0 results";
}
	mysqli_close($con);
?>


