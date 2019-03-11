<?php

  header("Access-Control-Allow-Origin: *");
  
  # Receive request JSON from front-end
  $frontend_answer = file_get_contents('php://input');
  $fe_answer = json_decode($frontend_answer, true);
  
  $quizid = "";
  $questions = "";
  $difficulty = "";
  $answer = "";

  if(isset($fe_answer['quizid']))
    $quizid = $fe_answer['quizid'];
  if(isset($fe_answer['questions']))
    $questions = $fe_answer['questions'];
  if(isset($fe_answer['difficulty']))
    $difficulty = $fe_answer['difficulty'];
  if(isset($fe_answer['answer']))
    $answer = $fe_answer['answer'];
 
   $con = mysqli_connect("sql1.njit.edu","sd744","DVDjpHtNw", "sd744");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }
  
    $sqlListanswer = mysql_query("SELECT answer FROM Lists where quizID = '$quizid' and questions = '$questions' ");
$sqlStatementanswer = mysql_query("SELECT answer FROM Statements where quizID = '$quizid' and questions = '$questions' and difficulty ='$difficulty' ");

    $matchfoundlist = "";
    $matchfoundstatement = "";

    while($lsanswer = mysql_fetch_assoc($sqlListanswer)){          
          if ($lsanswer == $answer)
          {
             $matchfoundlist = "correct"; 
          }
    }
    

     while($lsstateanswer = mysql_fetch_assoc($sqlStatementanswer)){          
          if ($lsstateanswer == $answer)
          {
             $matchfoundstatement = "correct"; 
          }
    }

      $Answers = json_encode(array('Lists' => $matchfoundlist, 'Statments' => $matchfoundstatement)); 
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, "https://web.njit.edu/~hdm5/Beta/instructor_page.html");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $Answers);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl); 


?>