function submitForm()
{
	var p = document.getElementById("PROMPT").value;
	var d = document.getElementById("DIFF").value;
	var t = document.getElementById("TOPIC").value;
	var f = document.getElementById("FNAME").value;
	
	var t1in = document.getElementById("T1IN").value;
	var t2in = document.getElementById("T2IN").value;
	var t3in = document.getElementById("T3IN").value;
	
	var t1out = document.getElementById("T1OUT").value;
	var t2out = document.getElementById("T2OUT").value;
	var t3out = document.getElementById("T3OUT").value;
	
	
	var queryString = "PROMPT=" + p;
	
	queryString+= "&DIFF=" + d;
	queryString+= "&TOPIC=" + t;
	queryString+= "&FNAME=" + f;
	queryString+= "&T1IN=" + t1in;
	queryString+= "&T2IN=" + t2in;
	queryString+= "&T3IN=" + t3in;
	queryString+= "&T1OUT=" + t1out;
	queryString+= "&T2OUT=" + t2out;
	queryString+= "&T3OUT=" + t3out;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var j = JSON.parse(this.responseText);
			if(j.Added == true)
				window.location.replace("https://web.njit.edu/~bg252/download/Test/Front/instructorHome.php");
		}
	};
	xhttp.open("POST", "addQuestion.php",true);
	xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp.send(queryString);

}