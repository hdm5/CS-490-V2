<?php

include ("account.php");
include("myfunctions.php");

$db = new mysqli($hostname, $username, $password, $project);

if (mysqli_connect_errno()) {
	exit();
}
$ucid=$_POST["ucid"];
$tid = $_POST["TestID"];

if(!isset($ucid) || !isset($tid)){
	$ucid = $_GET["ucid"];
	$tid = $_GET["TestID"];
}

$query = "select * 
from answer where ucid='$ucid' and testid='$tid'";

($t = mysqli_query($db, $query)) or die(mysqli_error($db));
$num = mysqli_num_rows ( $t );
$tests=array();
$i=0;
echo "[";
while($r = mysqli_fetch_array($t,MYSQLI_ASSOC)){
	$code = $r["code"];
	$code = str_replace("\"","'",$code);
	$tests[$i]="{\"QuestionID\":".$r["questionID"];
	$tests[$i].=",\"Code\":"."\"".rep($code)."\"";
	$tests[$i].=",\"Grade\":"."\"".rep($r["grade"])."\"";
	$tests[$i].=",\"MaxGrade\":"."\"".rep($r["maxGrade"])."\"";
	$tests[$i].=",\"TeacherComments\":"."\"".rep($r["teacherComments"])."\"";
	$tests[$i].=",\"ComputerComments\":"."\"".rep($r["compComments"])."\"";
	$tests[$i].=",\"TestID\":"."\"".rep($r["testID"])."\"";
	$tests[$i].=",\"UCID\":"."\"".rep($r["ucid"])."\"}";
	
	
	$i++;
}
for($count=0;$count<=$i;$count++){
	echo $tests[$count];
	if($count<$i-1){
		echo ",";
	}
}
echo "]";

?>