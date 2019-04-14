<?php
	session_set_cookie_params(0, "/~bg252/");
	session_start();
	$return_arr["uname"] = $_POST["uname"];
	$return_arr["psw"] = $_POST["psw"];

	$url = 'https://web.njit.edu/~bg252/download/CS490/Beta/login.php'; /* URL of mid end php file goes in between apostrophes */
	$ch = curl_init($url);

	$postString = http_build_query($return_arr, '', '&');

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	
	$resp = curl_exec($ch); 
	curl_close($ch);
	
	$js = json_decode($resp);
	
	if($js->Valid == 1)
	{	
		
		$_SESSION["logged"] = true;
		$ucid = $return_arr["uname"];
		$_SESSION["UCID"] = $ucid;
		
		if($js->Type == "student") 
		{
			echo '{"Type":"student"}';
		}
		
		else if($js->Type == "teacher")
		{
			echo '{"Type":"teacher"}';
		}
	}
	else
	{
		echo'{"Type":"NONE"}';
	}
	
	
	
?>