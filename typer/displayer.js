// Create span for each
// This is very bad code :c
var length = 0;
var clr1 = "rgb(25, 109, 17)";
var clr2 = "rgb(228, 124, 6)";
var tempContainer;
var lengthh = 0;

function displayText(challengeText) {
    let container = document.getElementById("challengeText");
    container.innerHTML = "";

    for (let i = 0; i < challengeText.length; i++) {
      let span = document.createElement("span");
      span.textContent = challengeText[i];
  
      container.appendChild(span);
    }

    color = document.getElementById("color").value;
    console.log(color);
    switch(color){
      case "1":
        clr1 = "rgb(25, 109, 17)";
        clr2 = "rgb(228, 124, 6)";
        break;
      case "2":
        clr1 = "rgb(192, 164, 161)";
        clr2 = "rgb(206, 67, 52)";
        break;
      case "3":
        clr1 = "rgb(24, 112, 24)";
        clr2 = "rgb(102, 9, 110)";
        break;
    }  
    tempContainer = document.querySelectorAll("#challengeText span");
  }
  
document.getElementById("userInput").addEventListener("input", function () {
  const challengeText = document.getElementById("challengeText").textContent;
  const userInput = document.getElementById("userInput").value;
  const userInputLength = userInput.length;
  var cpyLen = userInputLength-1;
  length ++;
  for (cpyLen; cpyLen < userInputLength; cpyLen++) {
      if (userInput[cpyLen] === challengeText[cpyLen]) 
        tempContainer[cpyLen].style.backgroundColor = clr1;
      else
        tempContainer[cpyLen].style.backgroundColor = clr2;
    
    if (userInputLength < length){
      tempContainer[length - 2].style.backgroundColor = "transparent";
      length = userInputLength;
    }
  }
});