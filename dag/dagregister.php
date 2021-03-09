<html>
<body>
<?php
/**
 * Denna filen används för att kunna sätta in dagar i dag tabellen i databasen
 * Du matar in vilket datum som ska sättas in från formuläret sedan så sätts dagen in.
 */
    include_once '../connection.php';
?>
    Du har registerat datumet: <br>
    <?php echo $_POST["datum"]; ?><br>

<?php
    $sql = "INSERT INTO dag(datum) VALUES('$_POST[datum]')";
    if (mysqli_query($conn, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($conn);
    }
?>
<br><a href="../perioddag/perioddag.php" class="tillbaka2">Gå tillbaka</a>
</body>
</html>