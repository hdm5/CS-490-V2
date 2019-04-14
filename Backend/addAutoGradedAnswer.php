<?php
include('account.php');
include('myfunctions.php');
$db = mysqli_connect ($hostname, $username, $password, $project);
       if (mysqli_connect_errno ())
        { echo "{\"Error\":\"Failed to connect to MySQL \"}";
        exit ();
        }


$obj = file_get_contents('php://input');
$json = json_decode($obj);
$code =  rawurldecode($json->Code);
$qid = $json->QuestionID;
$ucid = $json->UCID;
$testid = $json->TestID;
$grade = $json->PointsEarned;
$maxGrade = $json->Points;
$compcomments = $json->Comments;
if(!isset($code) or !isset($ucid) or !isset($qid) or !isset($testid) or !isset($grade) or !isset($compcomments) or !isset($maxGrade)){
	echo "{\"Error\":\"Bad Json\"}";
	exit();
}
$code = mysqli_real_escape_string($db,trim($code));
$s = "insert into answer values('$qid','$ucid','$testid','$code','$grade','$maxGrade','','$compcomments','N')";
($t = mysqli_query ($db,$s)) or die (mysqli_error($db));
echo "{\"Submitted\":\"True\"}";
//$sCode = rawurldecode($obj->Code);
//echo $sCode;

?>