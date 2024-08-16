<?php
$host = 'localhost';
$dbname = 'myfirstdatabase';
$dbusername = 'root';
$dbpassword = '';
$username = $_GET['login'];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());

}

$query = "SELECT speed FROM users WHERE username = :username";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kablammo&family=Playfair:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro&family=EB+Garamond:wght@500&family=Kablammo&family=Lobster&family=Playfair:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Mango Typer</title>
</head>
  <body>
  <!-- I still need to figure out how to keep the username when clicking mango typer logo on left, and when I haven't selected time in the dropdown -->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark" data-bs-theme="dark"">
        <div class="container-fluid">
          

        <!-- Now It works -->
          <a class="navbar-brand" href="http://localhost/firstSight/mangoTyperRemake/typer?login=<?php $username = $_GET['login']; echo $username?>">
            <img src="magoo.png" alt="Logo" height="37" class="d-inline-block align-text">
            Mango Typer
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Themes 
                </a>
                <!-- This sets the initial color when none is chosen -->
                <input type="hidden" value="1" id="color">
                <input type="hidden" value="<?php echo $username;?>" id="userNameInput">
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" onclick="setColour(1)">Mango 🥭</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" onclick="setColour(2)">Shroom 🍄</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" onclick="setColour(3)">Grape 🍇</a></li>
                </ul>
              </li>
             <!-- Get username from the url-->
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page">
                    <?php 
                      $username = $_GET["login"];
                      echo 'You\'re logged in as:  ' . $username;
                    ?>
                    
                  </a>
                </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page">
                  <span>Current max speed: <span id="speed" style="color:green">
                    <?php foreach ($result as $key=>$item){
                      echo "$item";
                      }?>
                      </span></span>
                </a>
            </li>     
            </ul>
            <span class="navbar-text">
                <a href="https://github.com/Vinqueire"><img src="github.png" alt="Logo" width="25" height="25" class="d-inline-block align-text"></a>
            </span>
          </div>
        </div>
    </nav>
    <div style="text-align: center;">
        <form>
            <select id="timeSelect" class="form-select form-select-sm mb-3 bg-dark" aria-label=".form-select-lg example" style="color: aliceblue;">
                <option selected disabled value="10">Select time</option>
                <option value="10">10 sec</option>
                <option value="20">20 sec</option>
                <option value="30">30 sec</option>
                <option value="60">1 min</option>
                <option value="300">5 min</option>
            </select>
        </form>
        <div>
          <!-- This needs to be fixed so that the countdown gets a second argument with the username -->
            <button id="begin" class="btn btn-secondary btn-sm" type="button" onclick="countdown(3);">Start</button>
        </div>    
    </div>
    <div class="container" style="text-align: center;">
        <div id="challengeText" onmousedown='return false;' onselectstart='return false;'></div>
        <input type="text" hidden id="userInput" autocomplete="off" placeholder="Type your text here">
    </div>
    <p id="countdown" hidden>The test will begin in: <span id="countdownTime"></span></p>
    <div style="text-align: center;">
        <p id="timeLeft" hidden>Time left: <span id="timer"></span></p>
        <p id="answer" hidden>You've got: 


        
        <!-- We'll have to keep the wpm in a database -->
        <span id="answerWpm" name="answerWpm"></span> WPM</p>

        <button id="restart" hidden class="btn btn-secondary btn-sm" type="button" onclick="countdown(3);resetInput();">Restart</button>   
    </div>
    <script src="wpmCalculation.js"></script>
    <script src="setColour.js"></script>
    <script src="makeWordList.js"></script>
    <script src="displayer.js"></script>
    <script src="timer.js"></script>
    <script src="startTest.js"></script>
    <script src="countdown.js"></script>

    
        

  </body>
</html>