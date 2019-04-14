<?php

	header('Content-Type: application/json');

	$ch = curl_init('https://web.njit.edu/~bg252/download/CS490/Beta/getTestsToReview.php.php');                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     

	
	echo(curl_exec($ch));

?>