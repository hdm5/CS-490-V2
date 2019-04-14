<?php

	function curlBackend($pFields, $bURL) 
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $bURL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $pFields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_REFERER, $bURL);
		
		return (curl_exec($ch));
	}

?>



<?php

	$backendURL = "https://web.njit.edu/~shh7/CS490/addQuestion.php";

	$prompt =  $_POST['PROMPT'];
	$difficulty = $_POST['DIFF'];
	$topic =  $_POST['TOPIC'];
	$functionName = $_POST['FNAME'];
 
  $constraints = $_POST['CONSTRAINTS'];
	$t1In =  $_POST['T1IN'];
	$t1Out = $_POST['T1OUT'];
	$t2In =  $_POST['T2IN'];
	$t2Out = $_POST['T2OUT'];
	$t3In =  $_POST['T3IN'];
	$t3Out = $_POST['T3OUT'];
 
    $t4In =  $_POST['T4IN'];
	$t4Out = $_POST['T4OUT'];
	$t5In =  $_POST['T5IN'];
	$t5Out = $_POST['T5OUT'];
	$t6In =  $_POST['T6IN'];
	$t6Out = $_POST['T6OUT'];
	
	$postFields = "";
	$postFields .= "PROMPT=".$prompt;
	$postFields .= "&DIFF=".$difficulty;
	$postFields .= "&TOPIC=".$topic;
	$postFields .= "&FNAME=".$functionName;
    $postFields .= "&CONSTRAINTS=".$constraints;
	$postFields .= "&T1IN=".$t1In;
	$postFields .= "&T1OUT=".$t1Out;
	$postFields .= "&T2IN=".$t2In;
	$postFields .= "&T2OUT=".$t2Out;
	$postFields .= "&T3IN=".$t3In;
	$postFields .= "&T3OUT=".$t3Out;
 
    $postFields .= "&T4IN=".$t4In;
	$postFields .= "&T4OUT=".$t4Out;
	$postFields .= "&T5IN=".$t5n;
	$postFields .= "&T5OUT=".$t4Out;
	$postFields .= "&T6IN=".$t6In;
	$postFields .= "&T6OUT=".$t6Out;
	
	$returnJSON = curlBackend($postFields, $backendURL);
	echo($returnJSON);
	
?>