<?php
$username = $_POST['username'];
$password = $_POST['password'];

#$url= "https://postman-echo.com/post";

$url = "https://web.njit.edu/~pm347/doLogin.php";

$ch = curl_init( $url );

# Setup request to send json via POST.
$payload = json_encode( array( "username"=> $username, "password"=>$password) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

# Send request.
$result = curl_exec($ch);
curl_close($ch);

# Print response.
echo "Result = $result";
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "http CODE = $httpcode";
?>
