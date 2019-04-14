<?php
	session_set_cookie_params(0, "/~bg252/");
	session_start();

	$ucid = $_SESSION["UCID"];
	$tid = $_POST["TID"];
	
	$middleURL = "https://web.njit.edu/~bg252/download/CS490/Beta/getGradedTest.php";
	$postFields .= "ucid=".$ucid;
	$postFields .= "&TID=".$tid;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $middleURL);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_REFERER, $middleURL);
	
	echo (curl_exec($ch));

?>