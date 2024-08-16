function calculateWpm(){
    document.getElementById("userInput").setAttribute("hidden", "true");
    const words = document.getElementById("userInput").value;
    const randWords = document.getElementById("challengeText").textContent;
    var charAmt = 0;

    for (var i = 0; i < words.length; i++)
    {
        if (words[i] == randWords[i])
            charAmt++;
    }

    var amount = charAmt / 5;
    var wpm = 0;
    switch(document.getElementById("timeSelect").value){
        case "10":
           wpm = amount * 6;
           break;
        case "20":
            wpm = amount * 3;
            break;
        case "30":
            wpm = amount * 2;
            break;
        case "60":
            wpm = amount;
            break;
        case "300":
            wpm = amount / 5;
            break;
    }

    var finalWpm = Math.round(wpm);

    
    document.getElementById("timeLeft").setAttribute("hidden", "true");
    document.getElementById("answerWpm").textContent = finalWpm;
    if (finalWpm > Number(document.getElementById("speed").textContent)){
        document.getElementById("speed").textContent = finalWpm;


        var spanData1 = finalWpm;
        var spanData2 = document.getElementById("userNameInput").value;
        var xhr = new XMLHttpRequest();

        console.log(spanData1);
        console.log(spanData2);

        xhr.open("POST", "update_database.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // You can handle the response here
                console.log(xhr.responseText);
            }

        };

        var data = "data1=" + encodeURIComponent(spanData1) + "&data2=" + encodeURIComponent(spanData2);
        xhr.send(data);
        

        // now we need to call a php function to update a db here, so I need to learn how to do that lol
        // As far as I can see, I need ajax and perhaps also jquery
    }
    document.getElementById("answer").removeAttribute("hidden");
    document.getElementById("restart").removeAttribute("hidden");
    
}