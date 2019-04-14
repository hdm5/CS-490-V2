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
		<script src="studentHomeScripts.js"> </script>
		
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

	<body onload="loadPage();"> 
		<h2> Create Exam </h2>
		<table width="1000">
			<th align="left"> Available Exams</th>
			<th align="left"> Posted Scores</th>
			
			<tr>
				<td>
					<ul id="availableExams" style="list-style-type:none;">
					</ul>
				</td>
				
				<td>
					<ul id="postedScores" style="list-style-type:none;">
					</ul>
				</td>
			
			</tr>
		
		</table>
		
		<p id="test"> </p>
		<button id="logout" onclick="logout();"> Logout </button>
	
	</body>
</html>
