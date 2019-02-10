<?php
    $con = mysqli_connect("sql1.njit.edu","sd744","Kevin12345","cWVQNRNgF");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("Accounts", $con);
   
    $User = $_POST['Username'];
    $Pass = $_POST['Password'];
    $check = $_POST['Check'];
    
  
    
   if ($check == 'student') {
        
        $sql = mysql_query("SELECT COUNT(*) FROM StudentLogin SL WHERE Student_ID = '$User' AND Student_PW = '$Pass'");
        $info = mysql_fetch_assoc($sql);
        $ver = $info['COUNT(*)'];
        
        if ($ver == 1) {
            session_start();
            $_SESSION['UserST'] = $User;
            echo "student connected";
        }
        else {
            header ("Location: http://web.njit.edu/~sd744/CS490/Front/login.html");
            echo "Invalid Login";
        } 
    } 
    
?>
