var tests;
var sExam;
var studentID;
var studentTestID;
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
	studentID = ucid;
	studentTestID = testID;
	
	console.log(ucid);
	
	var queryString = "UCID=" + ucid;
	
	queryString+= "&TID=" + testID;
	
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
	xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp.send(queryString);
}

function loadStudentExam(studentTest)
{
	document.getElementById("revExams").innerHTML = "";
	sExam = JSON.parse(studentTest);
	
	var tbl = document.createElement("table");
	tbl.setAttribute("id", "myTest");
	tbl.setAttribute("width", "1000");
	
	var row = document.createElement("tr");
	
	
	var th1 = document.createElement("th");
	var th2 = document.createElement("th");
	var th3 = document.createElement("th");
	var th4 = document.createElement("th");
	var th5 = document.createElement("th");
	var th6 = document.createElement("th");
	var th7 = document.createElement("th");
	
	th1.innerHTML = "Prompt";
	th2.innerHTML = "Student Code";
	th3.innerHTML = "Autograde Comments";
	th4.innerHTML = "Your Comments";
	th5.innerHTML = "Earned";
	th6.innerHTML = "Total";
	th7.innerHTML = "Release";
	
	row.appendChild(th1);
	row.appendChild(th2);
	row.appendChild(th3);
	row.appendChild(th4);
	row.appendChild(th5);
	row.appendChild(th6);
	row.appendChild(th7);
	
	tbl.appendChild(row);
	
	document.getElementById("testGoesHere").appendChild(tbl);
	
	for(var i = 0; i < sExam.length; i++)
	{
		var q = sExam[i];
		
		console.log(i);
		
		var tr = document.createElement("tr");

		var td1 = document.createElement("td");
		var td2 = document.createElement("td");
		var td3 = document.createElement("td");
		var td4 = document.createElement("td");
		var td5 = document.createElement("td");
		var td6 = document.createElement("td");
		var td7 = document.createElement("td");

		var ta1 = document.createElement("textarea");
		var ta2 = document.createElement("textarea");
		var ta3 = document.createElement("textarea");
		var ta4 = document.createElement("textarea");
		var ta5 = document.createElement("textarea");
		var ta6 = document.createElement("textarea");
		var bt7 = document.createElement("button");
		
		
		ta1.innerHTML = decodeURIComponent(q.Q_PROMPT);
		ta1.readOnly = true;
		ta1.setAttribute("rows", "15");
		ta1.setAttribute("cols", "30");
		try
		{
			ta2.innerHTML = decodeURIComponent(q.StudentCode);
		}
		catch(ex)
		{
			ta2.innerHTML = q.StudentCode;
		}
		ta2.readOnly = true;
		ta2.setAttribute("rows", "15");
		ta2.setAttribute("cols", "30");
		
		ta3.innerHTML = decodeURIComponent(q.AutoGrade);
		ta3.readOnly = true;
		ta3.setAttribute("rows", "15");
		ta3.setAttribute("cols", "30");
		
		
		ta4.setAttribute("rows", "15");
		ta4.setAttribute("cols", "20");
		ta4.setAttribute("id", "TeacherComments" + q.QID);
		
		ta5.innerHTML = decodeURIComponent(q.Earned);
		ta5.setAttribute("id", "Earned" + q.QID);
		
		ta6.innerHTML = decodeURIComponent(q.Total);
		ta6.readOnly = true;
		ta6.setAttribute("id", "Total" + q.QID);
		
		bt7.innerHTML = "Release";
		bt7.setAttribute("id", q.QID);
		bt7.setAttribute("onclick", "releaseScore(this.id);");
		bt7.setAttribute("class", "SubmitButton");
		
		
		td1.setAttribute("width", "20%");
		td2.setAttribute("width", "20%");
		td3.setAttribute("width", "20%");
		td4.setAttribute("width", "20%");
		td5.setAttribute("width", "5%");
		td6.setAttribute("width", "5%");
		td7.setAttribute("width", "10%");
		
		td1.appendChild(ta1);
		td2.appendChild(ta2);
		td3.appendChild(ta3);
		td4.appendChild(ta4);
		td5.appendChild(ta5);
		td6.appendChild(ta6);
		td7.appendChild(bt7);
		
		tr.appendChild(td1);
		tr.appendChild(td2);
		tr.appendChild(td3);
		tr.appendChild(td4);
		tr.appendChild(td5);
		tr.appendChild(td6);
		tr.appendChild(td7);
		
		
		document.getElementById("myTest").appendChild(tr);
	}
	var btnFinish = document.createElement("button");
	btnFinish.setAttribute("id", "finishReview");
	btnFinish.setAttribute("onclick", "reloadPage();");
	btnFinish.disabled = true;
	btnFinish.innerHTML = "Finish";
	document.getElementById("testGoesHere").appendChild(btnFinish);
}

function releaseScore(qID)
{
	var score = parseInt(document.getElementById("Earned" + qID).value);
	var total = parseInt(document.getElementById("Total" + qID).value);
	var send = JSON.parse('{}');
	if(score > total)
		alert("Maximum score exceeded");
	else
	{
		send.QID = qID;
		send.TestID = sExam[0].TestID;
		send.UCID = sExam[0].UCID;
		send.TeacherComments = encodeURIComponent(document.getElementById("TeacherComments" + qID).value);
		send.NewGrade = document.getElementById("Earned" + qID).value;
		var sendString = JSON.stringify(send);
		console.log(sendString);
		
				
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{
				var ob = JSON.parse(this.responseText);
				if(ob.Added == true)
				{
					document.getElementById(qID).disabled = true;
					checkAllSubmitted();
				}
			}
		};
		xhttp.open("POST", "updateRelease.php",true);
		xhttp.setRequestHeader("Content-type","application/json");
		xhttp.send(sendString);
	}
}

function checkAllSubmitted()
{
  	var elementList = document.querySelectorAll(".SubmitButton");
    var allSubmitted = true;
    for (var i = 0; i < elementList.length; i++) 
    {
      var e = elementList[i];
  		if(e.disabled == false)
       allSubmitted = false;
    }
    if(allSubmitted)
      document.getElementById("finishReview").disabled = false;
}

function reloadPage()
{
	window.location.replace("https://web.njit.edu/~bg252/download/Test/Front/releaseExams.php");
}










