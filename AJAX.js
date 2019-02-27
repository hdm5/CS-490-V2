function AJAXform( formID, buttonID, resultID, formMethod = 'post' ){
    var selectForm = document.getElementById(formID); // Select the form by ID.
    var selectButton = document.getElementById(buttonID); // Select the button by ID.
    var selectResult = document.getElementById(resultID); // Select result element by ID.
    var formAction = document.getElementById(formID).getAttribute('action'); // Get the form action.
    var formInputs = document.getElementById(formID).querySelectorAll("input"); // Get the form inputs.
 
    function XMLhttp(){
        var httpRequest = new XMLHttpRequest();
        var formData = new FormData();
 
        for( var i=0; i < formInputs.length; i++ ){
            formData.append(formInputs[i].name, formInputs[i].value); // Add all inputs inside formData().
        }
 
        httpRequest.onreadystatechange = function(){
            if ( this.readyState == 4 && this.status == 200 ) {
                selectResult.innerHTML = this.responseText; // Display the result inside result element.
            }
        };
 
        httpRequest.open(formMethod, formAction);
        httpRequest.send(formData);
    }
 
    selectButton.onclick = function(){ // If clicked on the button.
        XMLhttp();
    }
 
    selectForm.onsubmit = function(){ // Prevent page refresh
        return true;
    }
}
