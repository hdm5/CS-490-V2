<?php
	include ("account.php");

	$db = new mysqli($hostname,$username, $password ,$project);

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}


	$ucid = $_POST["ucid"];
	$testID = $_POST["TID"];

	
	$SQL = "select q.questionID, a.code, a.grade, a.teacherComments, a.compComments, t.points, q.prompt
from question as q, answer as a, test as t
where a.questionID = q.questionID AND 
t.testID = a.testID AND 
t.testID = a.testID AND 
t.questionID = a.questionID AND
a.ucid = '$ucid' AND 
a.testID = '$testID'AND
a.released = 'Y'";
	
	($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
	
	$ret = '[';
	
	while($r = mysqli_fetch_array($t,MYSQLI_ASSOC)) 
	{
		$qID = $r["questionID"];
		$code = $r["code"];
		$grade = $r["grade"];
		$Tcomments = rawurlencode($r["teacherComments"]);
    $Ccomments = rawurlencode($r["compComments"]);
		$points = $r["points"];
		$prompt = $r["prompt"];
		
		$code = rawurlencode($code);
		
		//$code = str_replace('"','\"', $code);
		
		$ret.='{';
		$ret.='"QID":"'.$qID.'",';
		$ret.='"Code":"'.$code.'",';
		$ret.='"Grade":"'.$grade.'",';
		$ret.='"Q_PROMPT":"'.$prompt.'",';
		$ret.='"Total":"'.$points.'",';
		$ret.='"TeacherComments":"'.$Tcomments.'",';
    $ret.='"CompComments":"'.$Ccomments.'"';
		$ret.='},';
	};
	
	$ret = substr($ret, 0, -1);
	$ret.=']';
	echo $ret;
?>