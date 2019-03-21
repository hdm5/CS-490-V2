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
		<script src="creatingTestScripts.js"> </script> 
		
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
		
		<style>
		table, th, td
		{
		  border: 1px solid black;
		}
		li
		{
		  font-size: 120%;
		}
		div 
		{
		  background-color: white;
		  width: 30px;
		  border: 10px solid red;
		  padding: 10px;
		  margin: 10px;
		}
		</style>
	</head>

	<body onload="getQuestions();"> 
		<h2> Create Exam </h2>
		<table width="1000">
			<th align="left"> Question Bank</th>
			<th align="left"> Selected Questions </th>
			
			<tr>
				<td width="70%">
					<ul id="QuestBank" style="list-style-type:none;">
					</ul>
				</td>
				
				<td width="30%">
					<table id = "SelQuest" wrap-height="auto">
						<th align="left"> ID </th>
						<th align="left"> Points </th>
					</table>
				</td>
			
			</tr>
		
		</table>
		<div id="total" align="center">
			0
		</div>
		<button id="submit" onclick="createExam();"> Create Exam </button>
		
		<p id="test"> </p>
		<button id="logout" onclick="logout();"> Logout </button>
	
	</body>
</html>