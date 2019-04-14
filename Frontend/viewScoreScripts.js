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
		var td5 = document.createElement("td");
		
		
		var ta1 = document.createElement("textarea");
		var ta2 = document.createElement("textarea");
		var ta3 = document.createElement("textarea");
		var ta4 = document.createElement("textarea");
		var ta5 = document.createElement("textarea");
		
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
		ta3.innerHTML = decodeURIComponent(q.CompComments);
		ta3.readOnly = true;
		
		ta4.setAttribute("rows", "25");
		ta4.setAttribute("cols", "50");
		ta4.innerHTML = decodeURIComponent(q.TeacherComments);
		ta4.readOnly = true;
		
		ta5.setAttribute("rows", "25");
		ta5.setAttribute("cols", "10");
		ta5.innerHTML = q.Grade + "/" + q.Total;
		ta5.readOnly = true;
		
		
		td1.setAttribute("width", "20%");
		td2.setAttribute("width", "25%");
		td3.setAttribute("width", "25%");
		td4.setAttribute("width", "25%");
		td5.setAttribute("width", "5%");
		
		td1.appendChild(ta1);
		td2.appendChild(ta2);
		td3.appendChild(ta3);
		td4.appendChild(ta4);
		td5.appendChild(ta5);
		
		tr.appendChild(td1);
		tr.appendChild(td2);
		tr.appendChild(td3);
		tr.appendChild(td4);
    tr.appendChild(td5);
		
		document.getElementById("studentScore").appendChild(tr);
	}
	
	document.getElementById("total").innerHTML = tot + "/" + 100;
}

function getStudentTest() 
{
	
	//var testID = <?php echo $_POST["TID"] ?>;
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
	xhttp.send();
	
}