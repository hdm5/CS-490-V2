<?php
    $con = mysqli_connect("sql1.njit.edu","hdm5","Ex1lf2cWV", "hdm5");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    $data = json_decode(file_get_contents('php://input'),true);
    $questionBankTable = '`Question Bank`';
    $question = $data['question'];
    $answer = $data['answer'];
    $category = $data['category'];
    $difficulty = $data['difficulty'];
    $questionID = $data['questionID'];
    
    $query = "insert into $questionBankTable (Question,Topic,Difficulty,Answer,QuestionID) values ('$question','$category','$difficulty','$answer',$questionID)";
    $result = mysqli_query($con, $query);

    if ($result === true)
	http_response_code(200);
    else
        http_response_code(400);

    die (mysqli_error($con));
?>
