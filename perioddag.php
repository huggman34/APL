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

    include('connection.php');

//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
    //echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
    //$_SESSION['password'];

//$API = $_SESSION['API'];
//} else {
//header('Location: login.html');
//}
?>
<div class="container">
<div class="wrapper">
    <h2 class="rubrik">Lägg till dagar i databasen</h2>
    <form action="dagregister.php" method="post">
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
<a class="link2" href="perioddaglista.php">Se inlagda dagar</a>
</body>
</html>
