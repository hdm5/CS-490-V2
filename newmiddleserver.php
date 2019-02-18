<?php

    header("Access-Control-Allow-Origin: *");
    
    # Receive request JSON from front-end
    $frontend_data = file_get_contents('php://input');
    $logindata = json_decode($frontend_data, true);
    
    $username = "";
	$password ="";	
    
    if(isset($logindata['username']))
		$username = $logindata['username'];
	if(isset($logindata['password']))
		$password = $logindata['password'];
        
    $statusCheck = check_login_njit($username,$password);
    
    if ($statusCheck == "NJIT Login Failed")
    {
        check_login_backend_db($username,$password);
        echo "check_login_backend_db";
    }
    else
    {
        echo "NOT !!!!check_login_backend_db";
        check_login_backend_db($username,$password);
    }
    
    function check_login_njit($username, $password)
	{
        # make a json object of username and password                
        $payload = array(
			"ucid" => $username,
			"pass" => $password
		);
        
        
	
		$njitUrl = "https://aevitepr2.njit.edu/myhousing/login.cfm";
		$chsession = curl_init($njitUrl);
		curl_setopt($chsession, CURLOPT_POST, true);
		curl_setopt($chsession, CURLOPT_POSTFIELDS , http_build_query($payload));
		curl_setopt($chsession, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($chsession, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($chsession, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140             Safari/537.36 Edge/17.17134');
		curl_setopt($chsession, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($chsession, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($chsession);
        $returnCode = curl_getinfo($chsession, CURLINFO_HTTP_CODE);
        
		curl_close($chsession);		

        if ($returnCode === 200)
            http_response_code(200);
        else
            http_response_code(401);
        
        
        $returnMsg = "";
        echo $response;
		if($response == "User not found in database, authentication failed!")			            
            $returnMsg = "NJIT Login Failed"; 
		else
			$returnMsg = "NJIT Login Successful";
        
        
        # Return the NJIT response to frontend
        die ($response);
        return $returnMsg;
    }
    
    function check_login_backend_db($username,$password)
    {
        
        echo "In check_login_backend_db";
        # make a json object of username and password        
        $payload = json_encode( array( "$username"=> $username, "$password"=>$password) );
       
        $backendUrl = "https://web.njit.edu/~sd744/back.php";
        
        $ch = curl_init($backendUrl);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
        $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

        if ($returnCode === 200)
            http_response_code(200);
        else
            http_response_code(401);
        
        
		if($response == "")
			#echo "DB Error";
		else
			#echo "</br>".$response;
        
        # Return the backend response to frontend
        echo "check_login_backend_db".$response;    
        die ($response);
        
    }

?>