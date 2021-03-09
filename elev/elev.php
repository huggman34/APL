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
 * Denna filen är ett formulär som skickar datan till 'elevRegister.php'
 * Den används för att kunna sätta in elever i databasen. 
 */
session_start();

    include_once '../connection.php';

//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
    //echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
    //$_SESSION['password'];
//} else {
//header('Location: login.html');
//}
?>
<div class="container">
<div class="wrapper">
    <h2 class="rubrik">Registrera en elev</h2>
    <form action="elevregister.php" method="post">
    <div class="form-group">
        <label>Förnamn</label> 
        <input type="text" name ="fornamn" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Efternamn</label> 
        <input type="text" name ="efternamn" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group2">
        <input type= "submit" class="btn" value="Skicka">
    </div>
</div>
</div>
</form>
<a class="link3" href="../perioddag/perioddaglista.php">Se registrerade elever</a>
</body>
</html>