<?php

include ("account.php");

$db = new mysqli($hostname, $username, $password, $project);

if (mysqli_connect_errno()) {
	exit();
}
$ucid=$_POST["ucid"];

$query = "select distinct testID 
from answer where ucid='$ucid'";
($t = mysqli_query($db, $query)) or die(mysqli_error($db));
$num = mysqli_num_rows ( $t );
$tests=array();
$i=0;
echo "[";
while($r = mysqli_fetch_array($t,MYSQLI_ASSOC)){
	
	$tests[$i]="{\"TID\":".$r["testID"]."}";
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