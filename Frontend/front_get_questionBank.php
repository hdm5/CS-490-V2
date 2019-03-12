<?php
    $data = array();
    $data['type'] = "getQuestionBank";

    if (isset($_POST['topic']))
        $data['topic'] = $_POST['topic'];
    if (isset($_POST['difficulty']))
        $data['difficulty'] = $_POST['difficulty'];
    if (isset($_POST['keyword']))
        $data['keyword'] = $_POST['keyword'];

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

    if ($returnCode == 200) {
        $returnData = json_decode($response, true);
        echo "<table>
        <tr>
        <th>Question</th>
	      <th>Topic</th>
	      <th>Difficulty</th>
	      <th>QuestionID</th>
       	</tr>";
	      foreach ($returnData as $question) { 
            echo "<tr>";
	          echo "<td>" . $question['Question'] . "</td>";
            echo "<td>" . $question['Topic'] . "</td>";
            echo "<td>" . $question['Difficulty'] . "</td>";
            echo "<td>" . $question['QuestionID'] . "</td>";
            echo "</tr>";
	      }
        echo "</table>";
    }
    else {
        echo "Failed to get question bank";
    }
?>
