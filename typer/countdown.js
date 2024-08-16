function countdown(timeVal)
{
    document.getElementById("countdown").removeAttribute("hidden");
    document.getElementById("begin").setAttribute("hidden", "true");
    document.getElementById("answer").setAttribute("hidden", "true");
    if (timeVal == 0)
    {
        document.getElementById("answer").setAttribute("hidden", "true");
        startTest();
        displayText(document.getElementById("challengeText").textContent);
    }
    else 
    {
    document.getElementById("countdownTime").textContent = timeVal;
    setTimeout(countdown, 1000, --timeVal);
    }
}

function resetInput(){
    document.getElementById("userInput").value = "";
    document.getElementById("restart").setAttribute("hidden", "true");
}