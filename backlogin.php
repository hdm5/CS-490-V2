<?php
    
    $con = mysqli_connect("sql1.njit.edu","sd744","DVDjpHtNw", "sd744");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }
   //mysqli_select_db( $con);
   $data=json_decode(file_get_contents('php://input')); 
   $uname = $data->Username;
   $pass = $data->Password;
   $check = $data->check;

	
   $sql = mysqli_query($con, "SELECT * FROM Accounts ");
   $rows = array();
   while($info = mysqli_fetch_assoc($sql)){
        $rows[] = $info;
   }
   //$count = $info['Check'];
   
  //$isexist= mysqli_query($con, "SELECT * FROM Accounts WHERE Username = '$uname' AND Password = '$pass'");
  //$isexist= mysqli_query($con, "SELECT Username, Password FROM Accounts " );
  //$check_user= mysqli_num_rows($isexist);
  //echo $check_user;
   //echo $check;
   echo json_encode($rows);
    
   //$authenticated;
   if ($check == 1) {
       //$_SESSION["count"] = $info['Check'];
       //$_SESSION["uname"] = $info['uname'];
       
        $authenticated = $uname;
        echo $uname;
        echo "teacher is connected   ";
	      http_response_code(200);
   }
   elseif($check == 0 ){
    
        $authenticated = $uname;
        //echo "student is connected";
	       http_response_code(200);
   
   }
   else {
        echo "****Invalid Login ****";
	      http_response_code(401);
   }
 /*
*******************************************************
   if ($check_user == '0'){
   $sql = mysqli_query($con, "SELECT COUNT(*) FROM Accounts WHERE Username = '$uname' AND Password = '$pass'");
   $info = mysqli_fetch_assoc($sql);
   $count = $info['COUNT(*)'];
  
   $authenticated;
   if ($count == 1) {
        $authenticated = $uname;
        echo "student is connected";
	       http_response_code(200);
   }
   else {
        echo "Invalid Login**********";
	       http_response_code(401);
   }
 }
  
  
    //die (json_encode(array("authenticated" => $authenticated)));
  */
?>
