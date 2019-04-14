var objs;

function loadPage()
{
	objs = JSON.parse(js);

	var q;
	for(var i = 0; i < objs.length; i++)
	{
		q = objs[i];
		
		var tr = document.createElement("tr");
		var td1 = document.createElement("td");
		var td2 = document.createElement("td");
		var ta1 = document.createElement("textarea");
		var ta2 = document.createElement("textarea");
		
		ta1.setAttribute("id", "PROMPT" + q.QID);
		ta1.setAttribute("rows", "25");
		ta1.setAttribute("cols", "40");
		ta1.innerHTML = q.Q_PROMPT;
		ta1.readOnly = true;
		
		ta2.setAttribute("id", "CODE" + q.QID);
		ta2.setAttribute("rows", "25");
		ta2.setAttribute("cols", "100");
		ta2.setAttribute("onkeydown", "insertTab(this, event);");
		
		td1.setAttribute("width", "30%");
		td2.setAttribute("width", "70%");
		
		td1.appendChild(ta1);
		td2.appendChild(ta2);
		tr.appendChild(td1);
		tr.appendChild(td2);
		
		document.getElementById("studentExam").appendChild(tr);
	}
}

function insertTab(o, e)
{		
	var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;
	if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey)
	{
		var oS = o.scrollTop;
		if (o.setSelectionRange)
		{
			var sS = o.selectionStart;	
			var sE = o.selectionEnd;
			o.value = o.value.substring(0, sS) + "\t" + o.value.substr(sE);
			o.setSelectionRange(sS + 1, sS + 1);
			o.focus();
		}
		else if (o.createTextRange)
		{
			document.selection.createRange().text = "\t";
			e.returnValue = false;
		}
		o.scrollTop = oS;
		if (e.preventDefault)
		{
			e.preventDefault();
		}
		return false;
	}
	return true;
}

function generateJSON()
{
	var st = '[';
	for(var i = 0; i < objs.length; i++)
	{
		
		var qID = objs[i].QID; 

		var code = document.getElementById("CODE" + qID).value;
		code = code.trim();
		code = encodeURIComponent(code);
		objs[i].Q_CODE = code;
		st += JSON.stringify(objs[i]) + ',';
		console.log(JSON.stringify(objs[i]));
	}
	
	st = st.substr(0, st.length -1) + ']';
	
	return st;
}

function submitTest()
{
	var sendString = generateJSON();
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var resp = JSON.parse(this.responseText);
			if(resp.Submitted == true) 
				window.location.replace("https://web.njit.edu/~bg252/download/Test/Front/studentHome.php");
		}
	};
	xhttp.open("POST", "submitExam.php",true);
	xhttp.setRequestHeader("Content-type","application/json");
	xhttp.send(sendString);
}
