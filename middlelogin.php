<?php

  header("Access-Control-Allow-Origin: *");
  
  # Receive request JSON from front-end
  $frontend_data = file_get_contents('php://input');
  $logindata = json_decode($frontend_data, true);
  
  $Username = "";
  $Password = "";
  $Check = "";

  if(isset($logindata['Username']))
    $Username = $logindata['Username'];
  if(isset($logindata['Password']))
    $Password = $logindata['Password'];
  if(isset($logindata['Check']))
    $Check = $logindata['Check'];
 
 
    # make a json object of username, password and check        
    $payload = json_encode(array("Username"=>$Username, "Password"=>$Password,"Check"=>$Check));
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

    $authenticated = $data['authenticated'];
  

    # return response to frontend
    die (json_encode(array("authenticated" => $authenticated)));
  
?>