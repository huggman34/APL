<?php
/**
 * Detta är en inloggnings formulär för att logga in som företag, datan skickas
 * till 'loginFunctions.php' där den granskas för att se om inloggnings uppgifter är korrekt eller ej
 */
    require_once "../connection.php";
    require_once "../loginFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <form action="foretagLoginForm.php" method="POST">
        <input class="input-box" type="text" name="username" placeholder="Företag namn"/>
        <input class="input-box" type="password" name="password" placeholder="Lösenord"/>
        <input class="submit" type="submit" name="submit" value="Logga in"/>
    </form>
    <?php
        if(isset($_POST['submit'])) {
            foretagLogin($conn, $_POST['username'], $_POST['password']);
        }
    ?>
</body>
</html>