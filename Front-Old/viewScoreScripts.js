//var js = '[{"QID":"1", "Code":"This is my code", "Grade":"20","Q_PROMPT":"This is the prompt", "Total":"25", "Comments":"these are comments"}, {"QID":"2", "Code":"This is my code", "Grade":"75", "Total":"75", "Q_PROMPT":"This is the prompt", "Comments":"these are comments"}] ';

var objs;
function loadPage(js)
{
	objs = JSON.parse(js);

	var q;
	var tot = 0; 
	for(var i = 0; i < objs.length; i++)
	{
		q = objs[i];
		tot += parseInt(q.Grade);
		
		var tr = document.createElement("tr");
		
		var td1 = document.createElement("td");
		var td2 = document.createElement("td");
		var td3 = document.createElement("td");
		var td4 = document.createElement("td");
		
		var ta1 = document.createElement("textarea");
		var ta2 = document.createElement("textarea");
		var ta3 = document.createElement("textarea");
		var ta4 = document.createElement("textarea");

		ta1.setAttribute("rows", "25");
		ta1.setAttribute("cols", "50");
		ta1.innerHTML = q.Q_PROMPT;
		ta1.readOnly = true;

		ta2.setAttribute("rows", "25");
		ta2.setAttribute("cols", "50");
		ta2.innerHTML = decodeURIComponent(q.Code);
		ta2.readOnly = true;
		
		ta3.setAttribute("rows", "25");
		ta3.setAttribute("cols", "50");
		ta3.innerHTML = q.Comments;
		ta3.readOnly = true;
		
		ta4.setAttribute("rows", "25");
		ta4.setAttribute("cols", "10");
		ta4.innerHTML = q.Grade + "/" + q.Total;
		ta4.readOnly = true;
		
		
		td1.setAttribute("width", "30%");
		td2.setAttribute("width", "30%");
		td3.setAttribute("width", "30%");
		td4.setAttribute("width", "10%");
		
		td1.appendChild(ta1);
		td2.appendChild(ta2);
		td3.appendChild(ta3);
		td4.appendChild(ta4);
		
		tr.appendChild(td1);
		tr.appendChild(td2);
		tr.appendChild(td3);
		tr.appendChild(td4);
		
		document.getElementById("studentScore").appendChild(tr);
	}
	
	document.getElementById("total").innerHTML = tot + "/" + 100;
}

function getStudentTest() 
{
	
	var testID = '<?php echo $_POST["TID"] ?>';
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			loadPage(this.responseText);
		}
	};
	xhttp.open("POST", "https://web.njit.edu/~bg252/download/Test/Front/getGradedTest.php",true);
	xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp.send('TID=' + testID);
	
}