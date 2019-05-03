<?php include "instructor_navbar.php";?>
<html>

	<head>
		<script src="reviewGradingScripts.js"></script>
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
	</head>
	
	<body onload="loadPage();">
		<table id="revExams" width="1000">
			<tr>
				<th> UCID </th>
				<th> Test ID</th>
				<th> View </th>
			</tr>
		</table>
   
   <div id="testGoesHere">
   </div>
	
	</body>

</html>