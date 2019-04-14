<?php
	header('Content-Type: application/json');
	include ("account.php");

	$db = new mysqli($hostname,$username, $password ,$project);

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	
	$SQL = "SELECT * FROM question";
	
	($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
	
	$returnString = '[';
	
	while($r = mysqli_fetch_array($t,MYSQLI_ASSOC)) 
	{
		$qID = $r["questionID"];
		$prompt = $r["prompt"];
		$topic = $r["topic"];
		$diff = $r["difficulty"];
		$returnString.='{"Q_ID":'.$qID.',"Q_prompt":"'.$prompt.'","difficulty":"'.$diff.'","topic":"'.$topic.'"},';
	};
	
	$returnString = substr($returnString, 0, -1);
	
	$returnString.=']';
	
	echo ($returnString);

?>