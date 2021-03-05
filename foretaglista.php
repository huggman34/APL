<html>
<head>
<link rel="stylesheet" href="apl.css">
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
</head>
<body>
<?php
    include('connection.php');

    $sqlget = "SELECT * FROM foretag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>Företagsnamn</th><th>Epost</th><th>Telefonnummer</th><th>Ta bort företag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['namn'];
        echo "</td><td>";
        echo $row['epost'];
        echo "</td><td>";
        echo $row['telefon'];
        echo "</td><td>";
        ?>
        <a href="foretagdelete.php?id=<?php echo $row['foretagsID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";

?>
<a href="test.php" class="tillbaka">Gå tillbaka</a>
</body>
</html>