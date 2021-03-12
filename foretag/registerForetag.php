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
/**
 * här skriver admin in värdena för att registrera ett nytt företag.
 * 
 */
    require_once '../connection.php';
    require_once '../registerFunctions.php';
    require_once '../loginFunctions.php';

if(checkAdminLogin()) {
    $username = $_SESSION['username'];
    echo "Logged in as " . $username . "<br></br>";
?>
<div class="container">
<div class="wrapper">
    <h2 class="rubrik">Registrera ett företag</h2>
    <form action="registerForetag.php" method="post">
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
        <input type= "submit" name="submit" class="btn" value="Skicka">
    </div>
</div>
</div>
</form>
<?php 
    if(isset($_POST['submit'])) {
        registerForetag($conn, $_POST['namn'], $_POST['losenord'], $_POST['epost'], $_POST['telefon']);
    }
?>
<a class="link" href="../Lists.php">Se registrerade företag</a>
</body>
</html>
<?php
    } else {
        echo "Please log in first to see this page <br></br>";
    }
?>
