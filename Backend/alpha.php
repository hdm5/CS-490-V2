
 <?php 
       include ("account.php" );
       $db = mysqli_connect ($hostname, $username, $password, $project);
       if (mysqli_connect_errno ())
        { echo "{\"Database\":false}";
        exit ();
        }
        $usr = $_POST['usr'];
        $psw=$_POST['psw'];
        mysqli_select_db ($db, $project);
        $query = "select * from users where usr='$usr' and psw='$psw'";
        ( $t = mysqli_query($db, $query) ) or die ( mysqli_error( $db ) );
       $num = mysqli_num_rows ( $t );
       if($num==0){
         echo "{\"Database\":false}";
         }
         else{
         echo "{\"Database\":true}";
         }
        ?> 



