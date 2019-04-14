
var selectedQIDS = [];
var selectedPointVals = [];

function getQuestions()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			console.log(this.responseText);
			loadQuestionBank(this.responseText);
		}
	};
	xhttp.open("POST", "requestQuestionBank.php",true);
	xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp.send();
}

function loadQuestionBank(s)
{
	var obj = JSON.parse(s);
	
	var q;
	for(var i = 0; i < obj.length; i++)
	{
		q = obj[i];
		var node = document.createElement("LI");
		var textnode = document.createTextNode(q.Q_ID + ": " + q.Q_prompt);
		var chk = document.createElement("input");
		chk.setAttribute("type", "checkbox");
		chk.setAttribute("name",q.Q_ID);
		chk.setAttribute("id", q.Q_ID);
		chk.setAttribute("onclick","selectQ(this.name);");
		node.appendChild(chk);
		node.appendChild(textnode);
		document.getElementById("QuestBank").appendChild(node);
	}
	
}

function selectQ(name)
{
	var checked = document.getElementById(name).checked;
	if(checked)
	{
		var row = document.createElement("TR");
		var questBox = document.createElement("TD");
		var questValue = document.createElement("TD");
		var inBox = document.createElement("input");
		questBox.appendChild(document.createTextNode(name));
		inBox.setAttribute("type", "number");
		inBox.setAttribute("class", "points");
		inBox.setAttribute("onkeyup", "updateTotalPoints();");
		inBox.setAttribute("id",name + "Box");
		row.setAttribute("id", "Sel_" + name);
		questValue.appendChild(inBox);
		row.appendChild(questBox);
		row.appendChild(questValue);
		document.getElementById("SelQuest").appendChild(row);
		
		selectedQIDS.push(name);

		
		
	}
	else
	{
		var element = document.getElementById("Sel_" + name);
		element.parentNode.removeChild(element);
		
		var index = selectedQIDS.indexOf(name);
		if (index > -1) 
		  selectedQIDS.splice(index, 1);
	}
}

function updateTotalPoints()
{
	var elementList = document.querySelectorAll(".points");
	var tot = 0;

    for (var i = 0; i < elementList.length; i++) {
        var e = elementList[i];
		var pointVal = parseInt(e.value);
		tot += pointVal;
    }
	
	document.getElementById("total").innerHTML = tot;
	if(tot == 100)
	{
		document.getElementById("total").style.borderColor = "green";
		document.getElementById("submit").disabled = false;
	}
	else
	{
		document.getElementById("total").style.borderColor = "red";
		document.getElementById("submit").disabled = true;
	}
	
	
}

function createExam()
{
	var js = generateJSONPOST();
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var obj = JSON.parse(this.responseText);
			if(obj.Added == true)
					window.location.replace("https://web.njit.edu/~bg252/download/Test/Front/instructorHome.php");
			
		}
	};
	xhttp.open("POST", "createExam.php",true);
	xhttp.setRequestHeader("Content-type","application/json");
	xhttp.send(js);

}

function generateJSONPOST()
{
	var jsString = '['
	for(var i = 0; i < selectedQIDS.length; i++)
	{
		jsString += '{"Q":' + selectedQIDS[i] + ',"Val":' + document.getElementById(selectedQIDS[i] + "Box").value + '},';
	}
	jsString = jsString.substring(0, jsString.length -1);
	
	jsString += ']';
	
	return jsString;
	
}

function showArray()
{
		document.getElementById("test").innerHTML = JSON.stringify(selectedQIDS);
}