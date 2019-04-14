
 <?php
include ("account.php");

$db = new mysqli($hostname, $username, $password, $project);

if (mysqli_connect_errno()) {
	echo "{\"Added\":false}";
	exit();
}

function testCaseInsert($in, $out,$qid,$db,$tID){
	if(isset($in) && isset($out)){
		if(!($out=='')){
			$query = "insert into testCases values('$tID','$qid','$in','$out')";
			($t = mysqli_query($db, $query)) or die(mysqli_error($db));
			return true;
		}else{
			return false;
		}
		
	}else{
		return false;
	}
}

$prompt = $_POST['PROMPT'];
$difficulty = $_POST['DIFF'];
$topic = $_POST['TOPIC'];
$functionName = $_POST['FNAME'];
$t1In = $_POST['T1IN'];
$t1Out = $_POST['T1OUT'];
$t2In = $_POST['T2IN'];
$t2Out = $_POST['T2OUT'];
$t3In = $_POST['T3IN'];
$t3Out = $_POST['T3OUT'];
$t4In = $_POST['T4IN'];
$t4Out = $_POST['T4OUT'];
$t5In = $_POST['T5IN'];
$t5Out = $_POST['T5OUT'];
$t6In = $_POST['T6IN'];
$t6Out = $_POST['T6OUT'];

mysqli_select_db($db, $project);
$query = "insert into question (prompt,topic,difficulty,funcName) values('$prompt','$topic','$difficulty','$functionName')";

if(isset($prompt) && isset($difficulty) && isset( $topic) && isset($functionName)){
	($t = mysqli_query($db, $query)) or die(mysqli_error($db));
}
$query = "select questionID from question order by questionID desc limit 1";
($t = mysqli_query($db, $query)) or die(mysqli_error($db));
echo "{\"Added\":true}";
$testCaseID=1;
$r = mysqli_fetch_array($t,MYSQLI_ASSOC);
if(testCaseInsert($t1In,$t1Out,$r["questionID"],$db,$testCaseID)){
	$testCaseID = $testCaseID+1;
}
if(testCaseInsert($t2In,$t2Out,$r["questionID"],$db,$testCaseID)){
	$testCaseID = $testCaseID+1;
}
if(testCaseInsert($t3In,$t3Out,$r["questionID"],$db,$testCaseID)){
	$testCaseID = $testCaseID+1;
}
if(testCaseInsert($t4In,$t4Out,$r["questionID"],$db,$testCaseID)){
	$testCaseID = $testCaseID+1;
}
if(testCaseInsert($t5In,$t5Out,$r["questionID"],$db,$testCaseID)){
	$testCaseID = $testCaseID+1;
}
if(testCaseInsert($t6In,$t6Out,$r["questionID"],$db,$testCaseID)){
	$testCaseID = $testCaseID+1;
}

?> 