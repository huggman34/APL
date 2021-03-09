<html>
<body>
<?php
    include_once '../connection.php';
?>
    Du har registerat eleven: <br>
    <?php echo $_POST["fornamn"]; ?> <?php echo $_POST["efternamn"]; ?><br>

<?php
    $sql = "INSERT INTO elev(fornamn,efternamn) VALUES('$_POST[fornamn]', '$_POST[efternamn]')";
    if (mysqli_query($conn, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($conn);
    }
?>
<br><a href="../elev.php" class="tillbaka2">Gå tillbaka</a>
</body>
</html>