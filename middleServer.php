<?php
  header("Access-Control-Allow-Origin: *");
  
  # Receive request JSON from front-end
  $frontend_data = file_get_contents('php://input');
  $logindata = json_decode($frontend_data, true);

  $username = "";
  $password = "";	
  if(isset($logindata['username']))
    $username = $logindata['username'];
  if(isset($logindata['password']))
    $password = $logindata['password'];
 
  # fall back to backend database if login with njit fails
  if (check_login_njit($username,$password) == true) {
    $authenticated = true;
    $studentNJIT = "NJIT";
  }
  else if(check_login_backend_db($username,$password) == true) {
    $authenticated = true;
    $studentNJIT = "Database";
  }
  else {
    $authenticated = false;
    $studentNJIT = "";
  }

  # return response to frontend
  die (json_encode(array("authenticated" => $authenticated, "studentNJIT" => $studentNJIT)));
  
  function check_login_njit($username, $password)
  {
    # make a json object of username and password                
    $payload = array(
    "ucid" => $username,
    "pass" => $password);
    
    $njitUrl = "https://aevitepr2.njit.edu/myhousing/login.cfm";
    $chsession = curl_init($njitUrl);
    curl_setopt($chsession, CURLOPT_POST, true);
    curl_setopt($chsession, CURLOPT_POSTFIELDS , http_build_query($payload));
    curl_setopt($chsession, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($chsession, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($chsession, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/17.17134');
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
    if(strpos($response, 'Please select a MyHousing System to sign into') == true)			            
      return true;
    else
      return false;
  }
  
  function check_login_backend_db($username,$password)
  {
    # make a json object of username and password        
    $payload = json_encode(array("username"=>$username, "password"=>$password));
    $backendUrl = "https://web.njit.edu/~sd744/back.php";

    $ch = curl_init($backendUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $response = curl_exec($ch);
    $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($returnCode === 200)
        http_response_code(200);
    else
        http_response_code(401);

    $data = json_decode($response, true);
    if (!isset($data['authenticated']))
        return false;
    else
        return $data["authenticated"];
  }
?>
