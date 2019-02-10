<?php

    $con = mysqli_connect("sql1.njit.edu","sd744","DVDjpHtNw", "sd744");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

   $data=json_decode(file_get_contents('php://input'),true);
   $uname = $data['username'];
   $pass = $data['password'];

   $sql = mysqli_query($con, "SELECT COUNT(*) FROM Accounts WHERE Username = '$uname' AND Password = '$pass'");
   $info = mysqli_fetch_assoc($sql);
   $count = $info['COUNT(*)'];

   $authenticated;
   if ($count == 1) {
        $authenticated = true;
        http_response_code(200);
   }
   else {
        $authenticated = false;
        http_response_code(401);
   }

    die (json_encode(array("authenticated" => $authenticated)));
?>
