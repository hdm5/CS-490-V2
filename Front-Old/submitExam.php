<?php

	header('Content-Type: application/json');
	$data = file_get_contents( "php://input" ); 

	$ch = curl_init('https://web.njit.edu/~bg252/download/CS490/submitExam.php');                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($data))                                                                       
	);
	
	echo (curl_exec($ch));

?>