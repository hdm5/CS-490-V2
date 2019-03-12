<?php
    $con = mysqli_connect("sql1.njit.edu","hdm5","Ex1lf2cWV", "hdm5");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    $data = json_decode(file_get_contents('php://input'),true);
    $uname = $data['username'];
    $pass = $data['password'];
    
    $sql = mysqli_query($con, "SELECT Instructor FROM Accounts WHERE uname = '$uname' AND password = '$pass'");
    $info = mysqli_fetch_assoc($sql);
    $count = count($info);
    
    $authenticated;
    $instructor = false;
    if ($count == 1) {
	# check if the login was an instructor or not
	$instructor = ($info['Instructor'] == 1) ? true : false;
        $authenticated = true;
        http_response_code(200);
    }
    else {
        $authenticated = false;
        http_response_code(401);
    }
    
    mysqli_free_result($info);
    die (json_encode(array(
        "authenticated" => $authenticated,
	"check" => $instructor)
    ));
?>
