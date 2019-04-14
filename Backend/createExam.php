<?php
	header('Content-Type: application/json');
	include ("account.php");
	
	$data = file_get_contents("php://input"); 
	$data = json_decode( $data );

	
	$db = new mysqli($hostname,$username, $password ,$project);

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	
	$SQL = "SELECT max(testID) as M from test";
	
	($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
	
	if(mysqli_num_rows($t) == 1)
	{
		$r = mysqli_fetch_array($t,MYSQLI_ASSOC);
		$tID = $r["M"];
	}
	$tID = $tID + 1;
	
	for($i = 0; $i < sizeof($data); $i++)
	{
		$quest = $data[$i];
		$q = $quest->Q;
		$val = $quest->Val;
		$SQL = "INSERT INTO test values('$tID', '$q', '$tID', '$val')";
		($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
	}
	
	echo '{"Added":true}';

?>