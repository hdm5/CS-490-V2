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
		var div3 = document.createElement("div");
		var ta4 = document.createElement("textarea");
		var ta5 = document.createElement("textarea");
		
		ta1.setAttribute("rows", "25");
		ta1.setAttribute("cols", "50");
		var prmt = decodeURIComponent(q.Q_PROMPT);
		ta1.innerHTML = prmt;
		ta1.readOnly = true;

		ta2.setAttribute("rows", "25");
		ta2.setAttribute("cols", "50");
		ta2.innerHTML = decodeURIComponent(q.Code);
		ta2.readOnly = true;
		
		
		
		
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
		
		
		
		
		//ta3.setAttribute("rows", "25");
		//ta3.setAttribute("cols", "50");
		var cComments = q.CompComments;
		comms = JSON.parse(decodeURIComponent(cComments));
		
		for(var j = 0; j < comms.length; j++)
		{
			var comm = comms[j];
			//comm.QuestionID = q.QID;
			//comm.ComNum = j;
			//comm.QuestionTotalComs = comms.length;
			//sendComms.push(comm);
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
		var title1 = document.createElement("b");
		var title2 = document.createElement("b");
		title1.innerHTML = "String Search";
		title2.innerHTML = "Test Cases";
		div3.appendChild(title1);
		div3.appendChild(ssTable);
		div3.appendChild(title2);
		div3.appendChild(tcTable);
		//ta3.innerHTML = decodeURIComponent(cComments);
		//ta3.readOnly = true;
		
		ta4.setAttribute("rows", "25");
		ta4.setAttribute("cols", "50");
		var tcomments = decodeURIComponent(q.TeacherComments)
		ta4.innerHTML = decodeURIComponent(tcomments);
		ta4.readOnly = true;
		/*
		ta5.setAttribute("rows", "25");
		ta5.setAttribute("cols", "10");
		ta5.innerHTML = q.Grade + "/" + q.Total;
		ta5.readOnly = true;
		*/
		
		td5.innerHTML = q.Grade + "/" + q.Total;
		
		td1.setAttribute("width", "20%");
		td2.setAttribute("width", "25%");
		td3.setAttribute("width", "25%");
		td4.setAttribute("width", "25%");
		td5.setAttribute("width", "5%");
		
		td1.appendChild(ta1);
		td2.appendChild(ta2);
		td3.appendChild(div3);
		td4.appendChild(ta4);
		//td5.appendChild(ta5);
		
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