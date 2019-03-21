<?php
	session_set_cookie_params(0, "/~bg252/");
	session_start();

	$_SESSION = array();
	session_unset(); 
	session_destroy();
?>