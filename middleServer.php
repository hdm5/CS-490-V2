<?php

# Receive request JSON
$frontendData = file_get_contents('php://input');
$backendUrl = "https://web.njit.edu/~sd744/back.php";

# Forward request from frontend to backend
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $backendUrl);
curl_setopt($ch, CURLOPT_POSTFIELDS, $frontendData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$curlResult = curl_exec($ch);
$returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($returnCode === 200)
    http_response_code(200);
else
    http_response_code(401);

# Return the backend response to frontend
die ($curlResult);

?>
