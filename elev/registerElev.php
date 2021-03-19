<?php
/**
 * Denna filen innehåller formuläret som man använder för att registrera en elev.
 * RegisterFunctions.php inkluderas för att få tillgång till registerElev funktionen som skickar in data
 * som anges i formuläret.
 */
    session_start();

    require_once '../LoginFunctions.php';
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(checkAdminLogin()) {
        $username = $_SESSION['username'];
        echo "Logged in as " . $username . "<br></br>";

        $klass = mysqli_query($conn, "SELECT klass FROM klass");
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
            <h2 class="rubrik">Registrera en elev</h2>
            <form action="registerElev.php" method="post">
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
            <div class="form-group">
                <label>Klass</label> 
                
                <select name="klass" class="form-control">
                    <?php
                        echo "<option disabled selected>".'Välj Klass'."</option>";
                        foreach($klass as $k) {
                            echo "<option value='".$k['klass']."'>".$k['klass']."</option>";
                        }
                    ?>
                </select>
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
                    registerElev($conn, $_POST['fornamn'], $_POST['efternamn'], $_POST['klass']);
                }
            ?>
            <a class="link3" href="../Lists.php">Se registrerade elever</a>
        </body>
        </html>
    <?php
    } else {
        echo "Please log in first to see this page <br></br>";
    }
?>