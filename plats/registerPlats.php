<?php
/**
 * Denna filen innehåller formuläret som man använder för att en elev en platshos ett företag under en period.
 * registerFunctions.php inkluderas för att få tillgång till registerPlats funktionen som skickar in data
 * som anges i formuläret.
 */
    require_once "../loginFunctions.php";
    require_once "../connection.php";
    require_once '../registerFunctions.php';

    session_start();

    if(checkAdminLogin()) {
        $username = $_SESSION['username'];
        echo "Logged in as " . $username . "<br></br>";

        $elever = mysqli_query($conn, "SELECT elevID FROM elev");
        $foretag = mysqli_query($conn, "SELECT namn, foretagID FROM foretag");
        $perioder = mysqli_query($conn, "SELECT periodNamn FROM period");
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
    <form action="registerPlats.php" method="POST">
        <select name="elevID">
            <?php
                echo "<option disabled selected>".'-- Välj Elev --'."</option>";
                foreach($elever as $e) {
                    echo "<option value='".$e['elevID']."'>".$e['elevID']."</option>";
                }
            ?>
        </select>
        <select name="periodNamn">
            <?php
                echo "<option disabled selected>".'-- Välj Period --'."</option>";
                foreach($perioder as $p) {
                    echo "<option value='".$p['periodNamn']."'>".$p['periodNamn']."</option>";
                }
            ?>
        </select>
        <select name="foretagID">
            <?php
                echo "<option disabled selected>".'-- Välj Företag --'."</option>";
                foreach($foretag as $f) {
                    echo "<option value='".$f['foretagID']."'>".$f['namn']."</option>";
                }
            ?>
        </select>
        <input class="submit" type="submit" name="submit" value="Skicka"/>
    </form>
    <?php
        if(isset($_POST['submit'])) {
            registerPlats($conn, $_POST['elevID'], $_POST['periodNamn'], $_POST['foretagID']);
        }
    ?>
    <?php
    } else {
        echo "Please log in first to see this page <br></br>";
    }
    ?>
    <a class="link2" href="../Lists.php">Se inlagda platser</a>
</body>
</html>