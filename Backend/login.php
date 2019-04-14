<?php
	include ("account.php");

	$db = new mysqli($hostname,$username, $password ,$project);

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}


	$ucid = $_POST["uname"];
	$pass = $_POST["psw"];
	
	$SQL = "SELECT * FROM user WHERE ucid='$ucid' AND password='$pass'";
	
	($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
	
	if(mysqli_num_rows($t) == 1)
	{
		$r = mysqli_fetch_array($t,MYSQLI_ASSOC);
		$type = $r["userType"];
		echo '{"Valid":true, "Type":"'.$type.'"}';
	}
	else
	{
		echo '{"Valid":false, "Type":"NONE"}';
	}
?>