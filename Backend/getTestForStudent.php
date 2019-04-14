<?php
include('account.php');
include('myfunctions.php');
$db = mysqli_connect ($hostname, $username, $password, $project);
if (mysqli_connect_errno ()){ 
	echo "{\"Error\":\"Failed to connect to MySQL \"}";
	exit ();
}
$id = $_POST["TestID"];
if(!isset($id))
	$id = $_GET["TestID"];
$s = "select questionID from test where testID=$id";
($t = mysqli_query ($db,$s)) or die (mysqli_error($db));
$result="[";
/*
[
	{
		
]
*/
$i=0;
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ){
	$qid = $r["questionID"];
	$s2 = "select * from question where questionID='$qid'";
	if($i!=0)
		$result.=",";
	$i++;
	($t2 = mysqli_query ($db,$s2)) or die (mysqli_error($db));
	while ( $r2 = mysqli_fetch_array ( $t2, MYSQLI_ASSOC) ){
		
		
		$result.='{"QuestionID": '.$r2["questionID"];
		$result.=',"Prompt": "'.$r2["prompt"].'"';
		$result.=',"Topic": "'.$r2["topic"].'"';
		$result.=',"Difficulty": "'.$r2["difficulty"].'"';
		$result.=',"FuncName": "'.$r2["funcName"].'"';
		$result.=',"Constraints": "'.$r2["constraints"].'"}';
	}
	
}
$result.="]";
echo $result;

?>