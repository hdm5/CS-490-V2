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

	$backURL = "https://web.njit.edu/~bg252/download/Test/Back/getAutogradedTest.php";

	$ucid =  $_POST['UCID'];
	$tid = $_POST['TID'];
	$postFields = "";
	$postFields .= "UCID=".$ucid;
	$postFields .= "&TID=".$tid;

	
	$returnJSON = curlBackend($postFields, $backURL);
	echo($returnJSON);
	
?>