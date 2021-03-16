<?php
    require_once "../loginFunctions.php";
    require_once "../connection.php";
    require_once '../registerFunctions.php';

    session_start();

    if (checkAdminLogin()) {
        $username = $_SESSION['username'];
        echo "Logged in as " . $username . "<br></br>";
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <link rel="stylesheet" href="apl.css">
            <style type="text/css">
                body{ font: 14px sans-serif; }
            </style>
            <title>Document</title>
        </head>
        <body>
            <div class="container">
            <div class="wrapper">
            <h2 class="rubrik">Registrera en klass</h2>
            <form action="registerKlass.php" method="POST">
            <div class="form-group">
                <label>Klass</label> 
                <input type="text" name ="klass" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group2">
                <input type= "submit" name="submit" class="btn" value="Skicka">
            </div>
            </form>
            <?php
                if(isset($_POST['submit'])) {
                    registerKlass($conn, $_POST['klass']);
                }
            ?>
            <a class="link3" href="../Lists.php">Se registrerade klasser</a>
        </body>
        </html>
    <?php
    }
?>