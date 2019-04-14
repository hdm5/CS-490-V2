<html>

	<head>
		<script>
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
					
					
					//ta1.setAttribute("rows", "25");
					//ta1.setAttribute("cols", "50");
					ta1.setAttribute("id", "ucid" + obj.UCID);
					ta1.innerHTML = obj.UCID;
					ta1.readOnly = true;

					//ta2.setAttribute("rows", "25");
					//ta2.setAttribute("cols", "50");
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
				}
			}
			function loadPage()
			{
					var js = generateJSONPOST();
	
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
				console.log(ucid + "\n" + testID);
			}
		
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
	
	</body>

</html>