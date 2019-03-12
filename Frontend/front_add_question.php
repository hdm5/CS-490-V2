<?php
    $data = array();
    $data['category'] = $_POST['topic'];
    $data['difficulty'] = $_POST['difficulty'];
    $data['question'] = $_POST['question'];
    $data['answer'] = $_POST['answer'];
    $data['questionID'] = $_POST['questionID'];
    $data['type'] = "createQuestion";

    $url = "https://web.njit.edu/~hdm5/Beta/Middle/middleServer.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($returnCode == 200)
        echo "Question added successfully";
    else
        echo "Failed to add question: $response";
?>
