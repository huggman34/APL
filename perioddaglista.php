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
<div class="container2">
<div class="wrapper">
    <h2 class="rubrik2">Länka dagar till perioder</h2>
    <form action="perioddagregister.php" method="post">
    <div class="form-group3">
        <label>Välj dag genom ID</label> 
        <input type="text" name ="dagID" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group3">
        <label>Välj period genom ID</label>
        <input type="text" name ="periodID" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group4">
        <input type= "submit" class="btn" value="Skicka">
    </div>
</div>
</div>
<?php
    include('connection.php');

    $sqlget = "SELECT * FROM dag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>dagID</th><th>Datum</th><th>Ta bort dag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['dagID'];
        echo "</td><td>";
        echo $row['datum'];
        echo "</td><td>";
        ?>
        <a href="perioddagdelete.php?id=<?php echo $row['dagID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";

$sqlget = "SELECT * FROM period";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>periodID</th><th>Period</th><th>Ta bort period</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['periodID'];
        echo "</td><td>";
        echo $row['namn'];
        echo "</td><td>";
        ?>
        <a href="perioddagdelete.php?id=<?php echo $row['periodID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<a href="perioddag.php" class="tillbaka3">Gå tillbaka</a>
</body>
</html>