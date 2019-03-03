<?php
  header("Access-Control-Allow-Origin: *");
  
  # Receive request JSON from front-end
  $frontend_data = file_get_contents('php://input');
  $logindata = json_decode($frontend_data, true);
  
  $username = "";
  $password = "";
  $check = "";
  if(isset($logindata['username']))
    $username = $logindata['username'];
  if(isset($logindata['password']))
    $password = $logindata['password'];
   if(isset($logindata['check']))
    $check = $logindata['check'];
 
  
 
  if(check_login_backend_db($username,$password, $check) == true) {
    $authenticated = true;
    $studentNJIT = "Database";
  }
  else {
    $authenticated = false;
    $studentNJIT = "";
  }
  # return response to frontend
  die (json_encode(array("authenticated" => $authenticated, "studentNJIT" => $studentNJIT)));
  
 
  
  function check_login_backend_db($username,$password,$check)
  {
    # make a json object of username, password and check        
    $payload = json_encode(array("username"=>$username, "password"=>$password,"check"=>$check));
    $backendUrl = "https://web.njit.edu/~sd744/backlogin.php";
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