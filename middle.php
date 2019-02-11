<?php

    # Retrieve Username/Password sent from action page
    $UserComp = $_POST['username'];
    $PassComp = $_POST['password'];

    # make a json object of username and password
    $payload = json_encode( array( "username"=> $UserComp, "password"=>$PassComp) );
    
    # call the back component with username and password received from action page
    $backurl = "https://web.njit.edu/~pm347/back.php";
    $chsession = curl_init( $backurl );

    curl_setopt( $chsession, CURLOPT_POSTFIELDS, $payload );
    curl_setopt( $chsession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt( $chsession, CURLOPT_RETURNTRANSFER, true );

    # Make a request to the back component and return the result to the action page
    $result = curl_exec($chsession);
    
    curl_close($ch);
?>