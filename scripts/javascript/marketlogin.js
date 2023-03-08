function setNullIfEmailEmpty(){
    const marketFieldElement = document.getElementById("market");
    const emailFieldElement = document.getElementById("email");

    if(emailFieldElement.value == null || emailFieldElement.value == ''){
        marketFieldElement.value='';
    }
}

function showEmptyEmailAdvice(){
    const marketFieldElement = document.getElementById("market");
    const emailFieldElement = document.getElementById("email");

    if(emailFieldElement.value == null || emailFieldElement.value == ''){
        marketFieldElement.setCustomValidity('Fill email input first!');
        marketFieldElement.reportValidity();
    }
    else{
        marketFieldElement.setCustomValidity('');
        marketFieldElement.reportValidity();
    }

}

function onEmailInputChange(){
    //validateExistendEmail();
}

function getEmployerMarkets(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        const jsonDoc = JSON.parse(this.responseText);
        console.log(jsonDoc[0]);
    }
    xhttp.open("POST", "../../api/apitest.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email="+document.getElementById("email"));
}
/*
function manageMarketDisable(){
    var marketFieldElement = document.getElementById("market");
    var blankEmailSpanAdvice = document.getElementById("blank-email-advice");
    var emailFieldElement = document.getElementById("email");

    if(emailFieldElement.value == null || emailFieldElement.value == ''){
        marketFieldElement.disabled=true;
        blankEmailSpanAdvice.removeAttribute("hidden");
    }
    else{
        marketFieldElement.disabled=false;
        blankEmailSpanAdvice.setAttribute("hidden", "hidden");
    }

}*/

/*const validityState = emailInput.validity;
if (validityState.valueMissing) {
    emailInput.setCustomValidity("You gotta fill this out, yo!");
} else {
    emailInput.setCustomValidity("");
}*/
