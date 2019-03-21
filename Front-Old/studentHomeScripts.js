
function loadPage()
{	
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var objs = JSON.parse(this.responseText);
			var t;
			for(var i = 0; i < objs.length; i++)
			{
				t = objs[i].TID;
				
				var node = document.createElement("LI");
				var btn = document.createElement("button");
				btn.setAttribute("id","T" + t);
				btn.setAttribute("name", t);
				btn.setAttribute("onclick", "takeExam(this.name);");
				btn.innerHTML = "Test #" + t;
				node.appendChild(btn);
				document.getElementById("availableExams").appendChild(node);
			}
		}
	};
	xhttp.open("POST", "requestAvailableTests.php",true);
	xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp.send();
	
	
	var xhttp2 = new XMLHttpRequest();
	xhttp2.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var objs = JSON.parse(this.responseText);
			var t;
			for(var i = 0; i < objs.length; i++)
			{
				t = objs[i].TID;
				
				var node = document.createElement("LI");
				var btn = document.createElement("button");
				btn.setAttribute("id","A" + t);
				btn.setAttribute("name", t);
				btn.setAttribute("onclick", "viewScore(this.name);");
				btn.innerHTML = "Test #" + t;
				node.appendChild(btn);
				document.getElementById("postedScores").appendChild(node);
			}
		}
	};
	xhttp2.open("POST", "requestPostedScores.php",true);
	xhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp2.send();
	
}

function takeExam(tID)
{
	var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "takeExam.php");
	var hiddenField = document.createElement("input");
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "TID");
	hiddenField.setAttribute("value", tID);

	form.appendChild(hiddenField);
	
    document.body.appendChild(form);
    form.submit();
}

function viewScore(tID)
{
	var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "viewScore.php");
	var hiddenField = document.createElement("input");
	hiddenField.setAttribute("type", "hidden");
	hiddenField.setAttribute("name", "TID");
	hiddenField.setAttribute("value", tID);

	form.appendChild(hiddenField);
	
    document.body.appendChild(form);
    form.submit();
}
