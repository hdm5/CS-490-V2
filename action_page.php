<?php
$username = $_POST['username'];
$password = $_POST['password'];

$url = "https://web.njit.edu/~hdm5/Beta/Middle/middleServer.php";

$ch = curl_init( $url );
$payload = json_encode( array( "username"=> $username, "password"=>$password, "type"=>"login" ));
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$result = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = json_decode($result,true);
if (!isset($data['authenticated'])) {
    echo "Authentication failed!";
}
else {
    $authenticate = $data['authenticated'];
    if($authenticate === true) {
        if (isset($data['check'])) {
	    $instructor = $data['check'];
            if ($instructor) {
		$url = 'https://web.njit.edu/~hdm5/Beta/instructor_page.html';
		die ('<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">');
	    }
	    else {
		$url = 'https://web.njit.edu/~hdm5/Beta/student_page.html';
		die ('<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">');
	    }
     	}	
    }
    else {
        echo "Authentication failed!";
    }
}

?>
