<html>
<body>
<?php

    /**
     * Denna fil används för att registrera en dag till en period genom att koppla periodnamn och dagID och lägga in det i perioddag tabellen.
     */

    require_once '../connection.php';
?>
    Du har registerat : <br>
    <?php echo $_POST["periodNamn"]; ?><br>
    <?php echo $_POST["dagID"]; ?><br>

<?php
    $sql = "INSERT INTO perioddag(periodNamn, dagID) VALUES('$_POST[periodNamn]', '$_POST[dagID]')";
    if (mysqli_query($conn, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($conn);
    }
?>
<br><a href="perioddaglista.php" class="tillbaka2">Gå tillbaka</a>
</body>
</html>