<?php
	session_set_cookie_params(0, "/~bg252/");
	session_start();
	if (!isset($_SESSION["logged"]))
	{
		header ("refresh: 1 url = login.html");
		exit();		
	}
 
  $_SESSION["TestID"] = $_POST["TID"];
?>


<html>
	<head>
		<script src="takeExamScripts.js"> </script>
		
		<style>
			table, th, td 
			{
			  border: 1px solid black;
			}
		</style>
		
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

	<body onload="getTest();">
 
		<table id="studentTest" width="1000">
		
			<tr>
				<th align="left" width="30%"> Prompt</th>
				<th align="left" width="40%"> Your Code </th>
				<th align="left" width="10%"> Points </th>
        <th align="left" width="20%"> Sumbit Answer </th>
			</tr>
		</table>
   
   <button id="finishTest"> Finish </button>

	</body>

</html>