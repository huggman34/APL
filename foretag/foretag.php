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
    <h2 class="rubrik">Registrera ett företag</h2>
    <form action="foretagregister.php" method="post">
    <div class="form-group">
        <label>Namn på företaget</label> 
        <input type="text" name ="namn" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Lösenord</label> 
        <input type="password" name ="losenord" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Epost</label> 
        <input type="text" name ="epost" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Telefonnummer</label> 
        <input type="text" name ="telefon" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group2">
        <input type= "submit" class="btn" value="Skicka">
    </div>
</div>
</div>
</form>
<a class="link" href="foretaglista.php">Se registrerade företag</a>
</body>
</html>
