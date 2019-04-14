<?php

include('account.php');
include('myfunctions.php');

$db = mysqli_connect ($hostname, $username, $password, $project);
if (mysqli_connect_errno ()){ 
	echo "{\"Error\":\"Failed to connect to MySQL \"}";
	exit ();
}
$obj = file_get_contents('php://input');
//$obj = file_get_contents('php://input');
$json = json_decode($obj);
$s = "select * from question";
$topic = $json->Topic;
$difficulty = $json->Difficulty;
$keyword = $json->Keyword;
if(!isset($keyword)){
	$i=0;
	if(isset($topic)){
		$i=1;
		$s.=" where topic like '%$topic%'";
	}
	if(isset($difficulty)){
		if($i==0)
			$s.=" where difficulty like '%$difficulty%'";
		else
			$s.=" and difficulty like '%$difficulty%'";
	}
}else
	$s.=" where prompt like '%$keyword%'";
($t = mysqli_query ($db,$s)) or die (mysqli_error($db));
$result="[";
$i=0;
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ){
	if($i!=0)
		$result.=",";
	$i++;
	$result.='{"QuestionID": '.$r["questionID"];
	$result.=',"Prompt": "'.$r["prompt"].'"';
	$result.=',"Topic": "'.$r["topic"].'"';
	$result.=',"Difficulty": "'.$r["difficulty"].'"';
	$result.=',"FuncName": "'.$r["funcName"].'"';
	$result.=',"Constraints": "'.$r["constraints"].'"}';
}
$result.="]";
echo $result;
/*
//Filter by Topic and Difficulty 
{
	"Topic": "For Loops", 
	"Difficulty": "Easy"
}
// Filter by Difficulty Only
{
	"Topic": "NONE", 
	"Difficulty": "Easy"
}
// Filter by Topic Only
{
	"Topic": "For Loops", 
	"Difficulty": "NONE"
}
// Filter by Keyword 
{
	"Keyword": "foo"
}
*/


?>
