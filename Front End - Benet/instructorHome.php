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
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
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
		
		<h2>Instructor Home</h2>
			
		<form action="AddNewQuestion.php">
			<input type="submit" value="Add Question" />
		</form>

		<form action="CreateTest.php" method="post" accept-charset=utf-8>
			<input type="submit" id="submit" name="submit" value="Create Test" />
		</form>
			
		<form action="CheckGrades.php">
			<input type="submit" value="Check Grades" />
		</form>
	
		<p id="Database"></p>
		
		<button id="logout" onclick="logout();"> Logout </button>

	</body>
</html>
