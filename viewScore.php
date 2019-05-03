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
		<script src="viewScoreScripts.js"> </script>
   
   <style>
			table, th, td {
			  border: 1px solid black;
			  border-collapse: collapse;
			}
			th, td {
			  padding: 5px;
			  text-align: left;
			}
			table#t01 {
			  width: 100%;    
			  background-color: #f1f1c1;
			}
      button 
      {
        background-color: #405090;
        border: none;
        color: white;
        padding: 20px 40px;
        text-align: center;
        display: inline-block;
        font-size: 20px;
        margin: 4px 4px;
        cursor: pointer;
      }
      textarea
      {
        width:100%;
        height:100%;
        display: block;
        font-size: 15px;
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
	
	<body onload="getStudentTest();">
		<table id="studentScore" width="1500">
		
			<tr>
				<th align="left" width="25%"> Prompt</th>
				<th align="left" width="25%"> Your Code </th>
				<th align="left" width="20%"> Autograde Comments </th>
                <th align="left" width="20%"> Instructor Comments </th>
				<th align="left" width="10%"> Grade</th>
			</tr>
		
		
		</table>
		
		<p id="test"> </p>
		<div id="total"> </div>
		
		<button id="logout" onclick="logout();"> Logout </button>
	
	</body>

</html>