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

	$middleURL = "https://web.njit.edu/~bg252/download/CS490/Beta/addQuestion.php";

	$prompt =  $_POST['PROMPT'];
	$difficulty = $_POST['DIFF'];
	$topic =  $_POST['TOPIC'];
	$functionName = $_POST['FNAME'];
	$t1In =  $_POST['T1IN'];
	$t1Out = $_POST['T1OUT'];
	$t2In =  $_POST['T2IN'];
	$t2Out = $_POST['T2OUT'];
	$t3In =  $_POST['T3IN'];
	$t3Out = $_POST['T3OUT'];
	
	$postFields = "";
	$postFields .= "PROMPT=".$prompt;
	$postFields .= "&DIFF=".$difficulty;
	$postFields .= "&TOPIC=".$topic;
	$postFields .= "&FNAME=".$functionName;
	$postFields .= "&T1IN=".$t1In;
	$postFields .= "&T1OUT=".$t1Out;
	$postFields .= "&T2IN=".$t2In;
	$postFields .= "&T2OUT=".$t2Out;
	$postFields .= "&T3IN=".$t3In;
	$postFields .= "&T3OUT=".$t3Out;
	
	$returnJSON = curlBackend($postFields, $middleURL);
	echo($returnJSON);
	
?>