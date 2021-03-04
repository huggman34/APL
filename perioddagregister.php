<html>
<body>
<?php
    include('connection.php');
?>
    Du har registerat datumet: <br>
    <?php echo $_POST["dagID"]; ?><br>
    I perioden <?php echo $_POST["periodID"]; ?><br>

<?php
    $sql = "INSERT INTO perioddag(periodID,dagID) VALUES('$_POST[periodID]', '$_POST[dagID]')";
    if (mysqli_query($conn, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Was not able to execute $sql. " . mysqli_error($conn);
    }
?>
</body>
</html>