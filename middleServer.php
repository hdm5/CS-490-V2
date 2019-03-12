<?php
    # Receive request JSON from front-end
    $frontend_data = file_get_contents('php://input');
    $data = json_decode($frontend_data, true);

    if (!isset($data['type'])) {
        http_response_code(501);
        die (json_encode(array("message" => "type key missing")));
    }

    switch ($data['type']) {
        case "login":
	    $loginUrl = "https://web.njit.edu/~hdm5/Beta/Backend/login.php";
	    $returnCode;

            $loginResponse = sendCurlRequest($loginUrl, $frontend_data, $returnCode);
	    http_response_code($returnCode);

            die ($loginResponse);
	    break;
	case "createQuestion":
            $createQuestionsUrl = "https://web.njit.edu/~hdm5/Beta/Backend/createQuestion.php";
	    $returnCode;
            
	    $createQuestionResponse = sendCurlRequest($createQuestionsUrl, $frontend_data, $returnCode);
            echo "responsecode = $returnCode";
	    http_response_code($returnCode);

            die ($createQuestionResponse);
	    break;
        case "getQuestionBank":
            $getQuestionBankUrl = "https://web.njit.edu/~hdm5/Beta/Backend/getQuestionBank.php";
            $returnCode;

            $getQuestionBankResponse = sendCurlRequest($getQuestionBankUrl, $frontend_data, $returnCode);
            http_response_code($returnCode);

            die ($getQuestionBankResponse);
            break;
        case "addExamQuestion":
	    $addExamQuestionUrl = "https://web.njit.edu/~hdm5/Beta/Backend/addExamQuestion.php";
	    $returnCode;

	    $addExamQuestionResponse = sendCurlRequest($addExamQuestionUrl, $frontend_data, $returnCode);
	    http_response_code($returnCode);

	    die ($addExamQuestionResponse);
	    break;
	case "getExam":
            $getExamUrl = "https://web.njit.edu/~hdm5/Beta/Backend/getExam.php";
            $returnCode;

            $getExamResponse = sendCurlRequest($getExamUrl, $frontend_data, $returnCode);
            http_response_code($returnCode);

            die ($getExamResponse);
            break;
	default:
	    http_response_code(501);
	    die (json_encode(array("message" => "type not yet added")));
    }

    function sendCurlRequest($url, $data, &$returnCode) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        $response = curl_exec($ch);
        $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        http_response_code($returnCode);
        return $response;
    }
?>
