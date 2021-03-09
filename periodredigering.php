<!DOCTYPE html>
<html lang="en">
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
    session_start();
    include_once 'connection.php';

    $sqlget = "SELECT * FROM period";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>periodNamn</th><th>Startdatum</th><th>Slutdatum</th><th>Uppdatera information</th><th>Ta bort period</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['periodNamn'];
        echo "</td><td>";
        echo $row['startdatum'];
        echo "</td><td>";
        echo $row['slutdatum'];
        echo "</td><td>";
        ?>
        <a href="periodredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="perioddelete.php?id=<?php echo $row['periodNamn'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<?php
    
    $periodNamn = $_SESSION['id'];

    $startdatum = '';
    $slutdatum = '';

   $sql = "SELECT * FROM period";
   $result = mysqli_query($conn, $sql);

   echo '<form action="editperiod.php" method="post">';
   echo '<label for="periodNamn">Välj period:</label>';
   echo '<select id="periodNamn" name="periodNamn">';
   while($rev = mysqli_fetch_array($result)){

   echo '<option value="' . $rev["periodNamn"] . '" >'. $rev["periodNamn"] .'</option>';
   
   }
   echo '</select>';
?>
   <input type="date" name="startdatum" value="<?php echo $startdatum; ?>"placeholder="Ändra startdatum">
   <input type="date" name="slutdatum" value="<?php echo $slutdatum; ?>"placeholder="Ändra slutdatum">
   <button type="submit" name="save">Uppdatera</button>
</form>
</body>
</html>