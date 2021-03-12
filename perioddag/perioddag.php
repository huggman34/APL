<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link rel="stylesheet" href="apl.css">
<style type="text/css">
        body{ font: 14px sans-serif; }
</style>
</head>
<body>
<?php

/**
 * I denna fil kan man välja vilka dagar man vill lägga in i databasen för att sedan kunna lägga in dem i perioder.
 * När man väljer en dag skickar den vidare till 'perioddagregister.php' där den sedan registrerar det i databasen.
 */

    session_start();
    require_once '../connection.php';
    require_once '../loginFunctions.php';

//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
    //echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
    //$_SESSION['password'];

//$API = $_SESSION['API'];
//} else {
//header('Location: login.html');
//}
if(checkAdminLogin()) {
    $username = $_SESSION['username'];
    echo "Logged in as " . $username . "<br></br>";
?>
<div class="container">
<div class="wrapper">
    <h2 class="rubrik">Lägg till dagar i databasen</h2>
    <form action="../dag/dagregister.php" method="post">
    <div class="form-group">
        <label>Välj dagar</label> 
        <input type="date" name ="datum" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group2">
        <input type= "submit" class="btn" value="Skicka">
    </div>
</div>
</div>
</form>
<a class="link2" href="../Lists.php">Se inlagda dagar</a>
</body>
</html>
<?php
    } else {
        echo "Please log in first to see this page <br></br>";
    }
?>