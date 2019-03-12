<?php
    $con = mysqli_connect("sql1.njit.edu","hdm5","Ex1lf2cWV", "hdm5");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    $result = mysqli_query($con, "SELECT b.Question FROM ExamQuestions a, `Question Bank` b WHERE a.QuestionID = b.QuestionID");
    if ($result === false) {
        http_response_code(500);
        die ("couldn't get exam");
    }

    $return = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($return, $row);
    }

    http_response_code(200);
   
    mysqli_free_result($result);
    die (json_encode($return));
?>
