<!DOCTYPE html>
<html>
<body>

<?php
	// Authorisation details.
	$username = "contact.timeit@gmail.com";
	$hash = "c7d3c5dc5198cb0431d397b58265b2b487a056ab";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "TXTLCL"; // This is who the message appears to be from.
	$numbers = "919167033530"; // A single number or a comma-seperated list of numbers
	$message = "Hello :)";
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
?>

</body>
</html>