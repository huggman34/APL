<html>
<body>
<?php
    include('connection.php');
?>
    Du har lagt in dagarna: <br>
    <?php echo $_POST["datum"]; ?><br>

<?php
    $sql = "INSERT INTO dag(datum) VALUES('$_POST[datum]')";
    if (mysqli_query($conn, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($conn);
    }
?>
<br><a href="perioddag.php" class="tillbaka2">Gå tillbaka</a>
</body>
</html>