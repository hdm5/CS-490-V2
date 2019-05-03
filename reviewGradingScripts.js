var tests;
var sExam;
var studentID;
var studentTestID;
var comms;
var sendComms = [];
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
		/*
		ta1.setAttribute("id", "ucid" + obj.UCID);
		ta1.innerHTML = obj.UCID;
		ta1.readOnly = true;

		ta1.setAttribute("id", "Test" + obj.TestID);
		ta1.setAttribute("name", obj.TestID);
		ta2.innerHTML = "Test #" + obj.TestID;
		ta2.readOnly = true;
		*/
		
		td1.setAttribute("id", "Test" + obj.TestID);
		td1.setAttribute("name", obj.TestID);
		td1.innerHTML = obj.UCID;
		
		td2.innerHTML = "Test #" + obj.TestID;
		
		bt3.innerHTML = "Review";
		bt3.setAttribute("id", obj.UCID);
		bt3.setAttribute("name", obj.TestID);
		bt3.setAttribute("onclick", "loadExam(this.id, this.name);");
	
		td1.setAttribute("width", "20%");
		td2.setAttribute("width", "25%");
		td3.setAttribute("width", "25%");
		
		//td1.appendChild(ta1);
		//td2.appendChild(ta2);
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
	tbl.setAttribute("width", "1500");
	
	var row = document.createElement("tr");
	
	
	var th1 = document.createElement("th");
	var th2 = document.createElement("th");
	var th3 = document.createElement("th");
	var th4 = document.createElement("th");
	var th5 = document.createElement("th");
	
	th1.innerHTML = "Prompt";
	th2.innerHTML = "Student Code";
	th3.innerHTML = "Autograde Comments";
	th4.innerHTML = "Your Comments";
	th5.innerHTML = "Score";
	
	row.appendChild(th1);
	row.appendChild(th2);
	row.appendChild(th3);
	row.appendChild(th4);
	row.appendChild(th5);
	
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

		var ta1 = document.createElement("textarea");
		var ta2 = document.createElement("textarea");
		var div3 = document.createElement("div");
		var ta4 = document.createElement("textarea");
		var bt5 = document.createElement("button");
		var div5 = document.createElement("div");
		
		var ssTable = document.createElement("table");
		var ssRow = document.createElement("tr");
		var ssTH1 = document.createElement("th");
		var ssTH2 = document.createElement("th");
		ssTH1.innerHTML = "Message";
		ssTH2.innerHTML = "Points";
		ssRow.appendChild(ssTH1);
		ssRow.appendChild(ssTH2);
		ssTable.setAttribute("width", "350");
		ssTable.appendChild(ssRow);
		
		var tcTable = document.createElement("table");
		var tcRow = document.createElement("tr");
		var tcTH1 = document.createElement("th");
		var tcTH2 = document.createElement("th");
		var tcTH3 = document.createElement("th");
		var tcTH4 = document.createElement("th");
		tcTH1.innerHTML = "Input";
		tcTH2.innerHTML = "Output";
		tcTH3.innerHTML = "Expected";
		tcTH4.innerHTML = "Points";
		tcRow.appendChild(tcTH1);
		tcRow.appendChild(tcTH2);
		tcRow.appendChild(tcTH3);
		tcRow.appendChild(tcTH4);
		tcTable.setAttribute("width", "350");
		tcTable.appendChild(tcRow);
		
		comms = JSON.parse(q.AutoGrade)
		for(var j = 0; j < comms.length; j++)
		{
			comm = comms[j];
			comm.QuestionID = q.QID;
			comm.ComNum = j;
			comm.QuestionTotalComs = comms.length;
			sendComms.push(comm);
			if(comm.T == "SS")
			{
				var trow = document.createElement("tr");
				var data1 = document.createElement("td");
				var data2 = document.createElement("td");
				var inp = document.createElement("input");
				
				inp.setAttribute("type", "text");
				inp.setAttribute("size", "1");
				inp.setAttribute("value", comm.V);
				inp.setAttribute("class", "COM" + q.QID);
				inp.setAttribute("onkeyup", "adjustSum(" + q.QID + ", " + j + ", this.value)");
				
				data1.innerHTML = comm.M;
				data2.setAttribute("width", "20");
				
				if(comm.V > 0)
				{
					inp.setAttribute("readOnly", true);
					data2.setAttribute("bgcolor", "#70ff70");
				}
				else
				{
					data2.setAttribute("bgcolor", "#ff7070");
				}
				
				
				
				data2.appendChild(inp);
				
				trow.appendChild(data1);
				trow.appendChild(data2);
				
				ssTable.appendChild(trow);
			}
			else
			{
				var trow = document.createElement("tr");
				var data1 = document.createElement("td");
				var data2 = document.createElement("td");
				var data3 = document.createElement("td");
				var data4 = document.createElement("td");
				var inp = document.createElement("input");
				
				data1.innerHTML = comm.I;
				data2.innerHTML = comm.O;
				data3.innerHTML = comm.E;
				data4.setAttribute("width", "20");
				
				inp.setAttribute("type", "text");
				inp.setAttribute("size", "1");
				inp.setAttribute("value", comm.V);
				inp.setAttribute("class", "COM" + q.QID);
				inp.setAttribute("onkeyup", "adjustSum(" + q.QID + ", " + j + ", this.value)");
				
				if(comm.V > 0)
				{
					inp.setAttribute("readOnly", true);
					data4.setAttribute("bgcolor", "#70ff70");
				}
				else
				{
					data4.setAttribute("bgcolor", "#ff7070");
				}
				
				data4.appendChild(inp);
				
				trow.appendChild(data1);
				trow.appendChild(data2);
				trow.appendChild(data3);
				trow.appendChild(data4);
				
				tcTable.appendChild(trow);
			}
		}
		
		ta1.innerHTML = decodeURIComponent(q.Q_PROMPT);
		ta1.readOnly = true;
		ta1.setAttribute("rows", "25");
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
		ta2.setAttribute("rows", "25");
		ta2.setAttribute("cols", "30");
		
		var title1 = document.createElement("b");
		var title2 = document.createElement("b");
		title1.innerHTML = "String Search";
		title2.innerHTML = "Test Cases";
		div3.appendChild(title1);
		div3.appendChild(ssTable);
		div3.appendChild(title2);
		div3.appendChild(tcTable);
		
		ta4.setAttribute("rows", "25");
		ta4.setAttribute("cols", "20");
		ta4.setAttribute("id", "TeacherComments" + q.QID);
		
		div5.innerHTML = decodeURIComponent(q.Earned) + "/" + decodeURIComponent(q.Total) ;
		div5.setAttribute("id", "Earned" + q.QID);
		div5.setAttribute("name", decodeURIComponent(q.Total));
		div5.setAttribute("style", "font-size:20px");

		bt5.innerHTML = "Release";
		bt5.setAttribute("id", q.QID);
		bt5.setAttribute("onclick", "releaseScore(this.id);");
		bt5.setAttribute("class", "SubmitButton");

		td1.appendChild(ta1);
		td2.appendChild(ta2);
		td3.appendChild(div3);
		td4.appendChild(ta4);
		td5.appendChild(div5);
		td5.appendChild(bt5);
		
		tr.appendChild(td1);
		tr.appendChild(td2);
		tr.appendChild(td3);
		tr.appendChild(td4);
		tr.appendChild(td5);

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
	var total = parseInt(document.getElementById("Earned" + qID).getAttribute("name"));
	var score = total;
	var sendComments = [];
	for(var i = 0; i < sendComms.length; i++)
	{
		if(sendComms[i].QuestionID == qID)
		{
			sendComments.push(sendComms[i]);
			var v = sendComms[i].V;
			if(v < 0)
			{
				score = score + v;
			}
		}
	}
	
	
	var send = JSON.parse('{}');
	if(score > total)
		alert("Maximum score exceeded");
	else
	{
		send.QID = qID;
		send.TestID = sExam[0].TestID;
		send.UCID = sExam[0].UCID;
		send.TeacherComments = encodeURIComponent(document.getElementById("TeacherComments" + qID).value);
		send.NewGrade = score;
		send.AutoGrade = sendComments;
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

function adjustSum(qid, commID, newVal)
{
	console.log(qid);
	var elementList = document.querySelectorAll(".COM" + qid);
	var tot = 0;

    for (var i = 0; i < elementList.length; i++) {
        var e = elementList[i];
		var pointVal = parseInt(e.value);
		if(pointVal < 0)
			tot += pointVal;
    }
	var e = parseInt(document.getElementById("Earned" + qid).getAttribute("name"));
	console.log("" + e);
	
	
	for(var i = 0; i < sendComms.length; i++)
	{
		if(sendComms[i].ComNum == commID && sendComms[i].QuestionID == qid)
			sendComms[i].V = parseInt(newVal);
	}
	document.getElementById("Earned" + qid).innerHTML =  (e+ tot) + "/" + e;
}