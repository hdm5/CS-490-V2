<?php
    $con = mysqli_connect("sql1.njit.edu","hdm5","Ex1lf2cWV", "hdm5");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    $data = json_decode(file_get_contents('php://input'),true);
    $questionBankTable = '`Question Bank`';

    $result = mysqli_query($con, "SELECT * FROM $questionBankTable");
    if ($result === false) {
        http_response_code(400);
        die ("couldn't get question bank");
    }

    $count = mysqli_num_rows($result);
    $return = array();

    # add rows from the select query to the return array to send back to the middle
    while ($row = mysqli_fetch_assoc($result)) {
    	# filter by topic
	if (isset($data['topic'])) {
            if ($row['Topic'] === $data['topic'])
	        array_push($return, $row);
	}
	# filter by difficulty
	elseif (isset($data['difficulty'])) {
	    if ($row['Difficulty'] === $data['difficulty'])
	        array_push($return, $row);
	}
	# filter by keyword
	elseif (isset($data['keyword'])) {
	    if (strpos($row['Question'], $data['keyword']) !== false)
	        array_push($return, $row);
	}
	# no filter, get the whole question bank
        else {
	    array_push($return, $row);
	}
    }

    http_response_code(200);
   
    mysqli_free_result($result);
    die (json_encode($return));
?>
