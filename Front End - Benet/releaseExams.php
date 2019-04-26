<?php include "instructor_navbar.php";?>
<html>

	<head>
		<script src="reviewGradingScripts.js">
     /*
			var tests;
			function load(js)
			{
				tests = JSON.parse(js);
				for(var i = 0; i < tests.length; i++)
				{
					var obj = tests[i];
					
					var tr = document.createElement("tr");
		
					var td1 = document.createElement("td");
					var td2 = document.createElement("td");
					var td3 = document.createElement("td");

					var ta1 = document.createElement("textarea");
					var ta2 = document.createElement("textarea");
					var bt3 = document.createElement("button");
					
					

					ta1.setAttribute("id", "ucid" + obj.UCID);
					ta1.innerHTML = obj.UCID;
					ta1.readOnly = true;

					ta1.setAttribute("id", "Test" + obj.TestID);
					ta1.setAttribute("name", obj.TestID);
					ta2.innerHTML = "Test #" + obj.TestID;
					ta2.readOnly = true;
					

					bt3.innerHTML = "Review";
					bt3.setAttribute("id", obj.UCID);
					bt3.setAttribute("name", obj.TestID);
					bt3.setAttribute("onclick", "loadExam(this.id, this.name);");
				
					td1.setAttribute("width", "20%");
					td2.setAttribute("width", "25%");
					td3.setAttribute("width", "25%");
					
					td1.appendChild(ta1);
					td2.appendChild(ta2);
					td3.appendChild(bt3);
                               
					tr.appendChild(td1);
					tr.appendChild(td2);
					tr.appendChild(td3);
          
          document.getElementById("revExams").appendChild(tr);
				}
			}
			function loadPage()
			{
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function()
					{
						if(this.readyState == 4 && this.status == 200)
						{
							var js = (this.responseText)
							load(js);
						}
					};
					xhttp.open("POST", "getTestsToReview.php",true);
					xhttp.setRequestHeader("Content-type","application/json");
					xhttp.send();
			}
			
			function loadExam(ucid, testID)
			{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function()
				{
					if(this.readyState == 4 && this.status == 200)
					{
						var studentTest = (this.responseText)
						loadStudentExam(studentTest);
					}
				};
				xhttp.open("POST", "getAutogradedTest.php",true);
				xhttp.setRequestHeader("Content-type","application/json");
				xhttp.send();
			}
		*/
		</script>
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