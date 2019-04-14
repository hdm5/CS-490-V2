<?php
	session_set_cookie_params(0, "/~bg252/");
	session_start();
	if (!isset($_SESSION["logged"]))
	{
		header ("refresh: 1 url = login.html");
		exit();		
	}	
?>


<html>

	<body>
		<p> hello <?php echo $_POST["TID"] ?></p>
	
	</body>

</html>