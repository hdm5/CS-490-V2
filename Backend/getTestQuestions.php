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
 
 
	
	$SQL = "select questionID from test where testID='$testID'";
 
	
	($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
   $objects;
   $qs;
   $i = 0;
   while($r = mysqli_fetch_array($t,MYSQLI_ASSOC))
   {
     $qs[$i] = $r["questionID"];
     $i++;
   }
 
   for($j = 0; $j < sizeOf($qs); $j++)
   {
     $obj->QID = $qs[$j];
     $SQL = "select parameters, output from testCases where questionID = '$qs[$j]'";
     ($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
     
     $testCases;
     $tc = "[";
     $k = 0;
     while($r= mysqli_fetch_array($t,MYSQLI_ASSOC))
     {
       $in = $r["parameters"];
       $out = $r["output"];
       //$testCase->Input = $in;
       //$testCase->Output = $out;
       //$testCases[$k] = $testCase;
       
      $tc .= "{\"Input\":\"".$in."\",\"Output\":\"".$out."\"},";
      //echo "{\"Input\":\"".$in."\",\"Output\":\"".$out."\"},";
       
       $k++;
     }
     
     $tc = substr($tc, 0, -1);
     
     $tc .= "]";
     
     $SQL = "SELECT q.questionID, t.testID, q.prompt, q.funcName, q.constraints, t.points
     FROM question as q, test as t 
     where t.testID = '$testID' AND t.questionID = q.questionID AND q.questionID = '$qs[$j]'";
     
     //echo("$SQL\n\n");
     
     ($t = mysqli_query($db,  $SQL)) or die( mysqli_error($db) );
     
     $r = mysqli_fetch_array($t,MYSQLI_ASSOC);
     $obj->TestID = $r["testID"];
     $obj->Q_PROMPT = $r["prompt"];
     $obj->FUNCTION_NAME = $r["funcName"];
     $obj->CONSTRAINTS = $r["constraints"];
     $obj->TEST_CASES = json_decode($tc);
     $obj->Points = $r["points"];
     $obj->UCID = $ucid;
     
     $objects[$j] = clone $obj;
   }
   
   echo(json_encode($objects));
?>