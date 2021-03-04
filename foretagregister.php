<html>
<body>
<?php
    include('connection.php');
?>
    Du har registerat företaget: <br>
    <?php echo $_POST["namn"]; ?><br>
    Lösenord: <?php echo $_POST["losenord"]; ?><br>
    Epost: <?php echo $_POST["epost"]; ?><br>
    Telefonnummer: <?php echo $_POST["telefon"]; ?><br>

<?php
    $sql = "INSERT INTO foretag(namn,losenord,epost,telefon) VALUES('$_POST[namn]', '$_POST[losenord]', '$_POST[epost]', '$_POST[telefon]')";
    if (mysqli_query($conn, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($conn);
    }
?>
<br><a href="test.php" class="tillbaka2">Gå tillbaka</a>
</body>
</html>