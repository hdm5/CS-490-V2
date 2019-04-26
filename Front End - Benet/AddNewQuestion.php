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
<head>
	<script src="AddQuestionScripts.js"> </script>
	<script> 
		function logout()
		{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200)
				{
					window.location.replace("https://web.njit.edu/~bg252/download/Test/Front/login.html");
				}
			};
			xhttp.open("POST", "https://web.njit.edu/~bg252/download/Test/Front/logout.php",true);
			xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhttp.send();
		}
	</script>
</head>
<body>
	Adding Questions
	<div>
	<textarea rows="4" cols="50" name="PROMPT" id="PROMPT"></textarea>
	Prompt
	<br>
	<input type="text" name="DIFF" id="DIFF">
	Difficulty
	<br>
	<input type="text" name="TOPIC" id="TOPIC">
	Topic
	<br>
	<input type="text" name="FNAME" id="FNAME">
	Function Name
	<br>
	<input type="text" name="T1IN" id="T1IN">
	<input type="text" name="T1OUT" id="T1OUT">
	Test Case 1
	<br>
	<input type="text" name="T2IN" id="T2IN">
	<input type="text" name="T2OUT" id="T2OUT">
	Test Case 2
	<br>
	<input type="text" name="T3IN" id="T3IN">
	<input type="text" name="T3OUT" id="T3OUT">
	Test Case 3
	<br>
	<button onclick="submitForm();"> Submit </button>
	</div>
	<p id="output"> </p>
	<button id="logout" onclick="logout();"> Logout </button>
</body>
</html>
