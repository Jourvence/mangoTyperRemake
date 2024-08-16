function setColour(value){
    var setup = 1;

    if (value == 1)
        setup = 1;
    else if (value == 2)
        setup = 2;
    else if (value == 3)
        setup = 3;

    document.getElementById("color").value = setup;
}