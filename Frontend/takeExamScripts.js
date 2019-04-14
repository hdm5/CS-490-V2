var objs;
function loadPage(js)
{
  var finishButton = document.getElementById("finishTest");
  finishButton.disabled = true;
  finishButton.setAttribute("style", "background-color: #80AAFF;");
  finishButton.setAttribute("onclick", "returnToStudentHome();");
  finishButton.style.width = '200px'; 
  finishButton.style.height = '100px'
  
	objs = JSON.parse(js);

	var q;
	for(var i = 0; i < objs.length; i++)
	{
		q = objs[i];
		
		var tr = document.createElement("tr");
		
		var td1 = document.createElement("td");
		var td2 = document.createElement("td");
		var td3 = document.createElement("td");
		var td4 = document.createElement("td");
		
		
		var ta1 = document.createElement("textarea");
		var ta2 = document.createElement("textarea");
		var ta3 = document.createElement("textarea");
		var bt4 = document.createElement("button");

		
		ta1.setAttribute("rows", "25");
		ta1.innerHTML = q.Q_PROMPT;
		ta1.readOnly = true;

		ta2.setAttribute("rows", "25");
		ta2.setAttribute("cols", "50");
    ta2.setAttribute("id", "Code" + q.QID);
    ta2.setAttribute("onkeydown", "insertTab(this, event);");
		
		ta3.setAttribute("rows", "25");
		ta3.innerHTML = q.Points;
		ta3.readOnly = true;
   
    bt4.setAttribute("style", "background-color: #4CAF50;");
    bt4.setAttribute("id", q.QID);
    bt4.setAttribute("onclick", "submitQuestionCode(this.id);");
    bt4.setAttribute("class", "SubmitButton");	
    bt4.style.width = '100px'; 
    bt4.style.height = '100px';
    bt4.innerHTML = "Submit";
		
		td1.setAttribute("width", "30%");
		td2.setAttribute("width", "40%");
		td3.setAttribute("width", "10%");
		td4.setAttribute("width", "20%");
		
		td1.appendChild(ta1);
		td2.appendChild(ta2);
		td3.appendChild(ta3);
		td4.appendChild(bt4);

		
		tr.appendChild(td1);
		tr.appendChild(td2);
		tr.appendChild(td3);
		tr.appendChild(td4);
		
		document.getElementById("studentTest").appendChild(tr);
	}
	
}

function returnToStudentHome()
{
  window.location.replace("https://web.njit.edu/~bg252/download/Test/Front/studentHome.php");
}

function submitQuestionCode(questionID)
{
  var sCode = document.getElementById("Code" + questionID).value;
  sCode = encodeURIComponent(sCode);
  for(var i = 0; i < objs.length; i++)
  {
    var obj = objs[i];
    if(obj.QID == questionID)
    {
      var sendObj = {"QuestionID": obj.QID};
      
      var constraints;
      if(obj.CONSTRAINTS != null)
      {
        constraints = obj.CONSTRAINTS.split(",");
        sendObj.Constraints = constraints;
      }
      else
       sendObj.Constraints = "NONE";
        
        
        
      var numArgs = obj.TEST_CASES[0].Input.split(",").length;
      
      sendObj.Code = sCode;
      sendObj.FunctionName = obj.FUNCTION_NAME;
      sendObj.UCID = obj.UCID;
      sendObj.TestID = obj.TestID;   
      sendObj.Points = obj.Points;
      sendObj.NumArgs = numArgs;
      
      tc = '[';
      
      for(var j = 0; j < obj.TEST_CASES.length; j++)
      {
        tc += '{"Input":"' + objs[i].TEST_CASES[j].Input + '",';
        tc += '"Output":"' + objs[i].TEST_CASES[j].Output + '"},';
      }
      tc = tc.substring(0, tc.length -1);
      tc += ']';
      console.log(tc);
      
      sendObj.TestCases = JSON.parse(tc);
      
      var objString = JSON.stringify(sendObj); 
      
      var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function()
    	{
    		if(this.readyState == 4 && this.status == 200)
    		{
          var resp = JSON.parse(this.responseText);
          
          if(resp.Submitted == "True")
          {
            document.getElementById(questionID).disabled = true;
            checkAllSubmitted();
          }
    		}
    	};
    	xhttp.open("POST", "submitCode.php",true);
    	xhttp.setRequestHeader("Content-type","application/json");
    	xhttp.send(objString);
    }
  }
}

function getTest() 
{
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			loadPage(this.responseText);
		}
	};
	xhttp.open("POST", "https://web.njit.edu/~bg252/download/Test/Front/getTestQuestions.php",true);
	xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp.send();
	
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
      document.getElementById("finishTest").disabled = false;
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