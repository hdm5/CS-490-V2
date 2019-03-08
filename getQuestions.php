<?php

 $con = mysqli_connect("sql1.njit.edu","sd744","DVDjpHtNw", "sd744");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }
    
    //mysql_select_db("sd744", $con);
    
    $sqlList = mysql_query("SELECT quizID, questions FROM Lists");
    $sqlStat = mysql_query("SELECT quizID, questions FROM Statements");
    
    
    $sqlEasy = mysql_query("SELECT quizID, questions FROM Lists WHERE difficulty = 'Easy' UNION SELECT quizID, questions FROM Statements WHERE difficulty ='Easy' ");
    $sqlMedium = mysql_query("SELECT quizID, questions FROM Lists WHERE difficulty = 'Medium' UNION SELECT quizID, questions FROM Statements WHERE difficulty ='Medium' ");
    $sqlHard = mysql_query("SELECT quizID, questions FROM Lists WHERE difficulty = 'Hard' UNION SELECT quizID, questions FROM Statements WHERE difficulty ='Hard' ");
    
    $listquestions = array();
    $statquestions = array();
    
    while($ls = mysql_fetch_assoc($sqlList)){
          $listquestions[] = $ls;    
    }
    while($st= mysql_fetcch_assoc($sqlStat)){
          $statquestions[] = array();    
    }
    
    $Easyquestions       = array();
    $Mediumquestions     = array();
    $Hardquestions       = array();
    
    while($e = mysql_fetch_assoc($sqlEasy)){
          $Eastquestions[] = $e;
    }
    while($m = mysql_fetch_assoc($sqlMedium)){
          
    }
    while($h = mysql_fetch_assoc($sqlHard)) {
            $Hardquestions[] = $h;
    }
    $Qus = json_encode(array('Lists' => $listquestions, 'Statments' => $statquestions,'Easy' => $Easyquestions, 'Medium' => $Mediumquestions, 'Hard' => $Hardquestions)); 

    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, "https://web.njit.edu/~hdm5/Beta/instructor_page.html");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $Qus);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl); 
?>
