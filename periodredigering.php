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
    include_once 'connection.php';

    $sqlget = "SELECT * FROM period";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>periodID</th><th>Period</th><th>Uppdatera information</th><th>Ta bort period</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['periodID'];
        echo "</td><td>";
        echo $row['namn'];
        echo "</td><td>";
        ?>
        <a href="periodredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="perioddelete.php?id=<?php echo $row['periodID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<?php
    session_start();

    $periodID = $_SESSION['id'];

    $namn = '';

   $sql = "SELECT * FROM period";
   $result = mysqli_query($conn, $sql);

   echo '<form action="editperiod.php" method="post">';
   echo '<label for="namn">Välj datum:</label>';
   echo '<select id="periodID" name="periodID">';
   while($rev = mysqli_fetch_array($result)){

   echo '<option value="' . $rev["periodID"] . '" >'. $rev["namn"] .'</option>';
   
   }
   echo '</select>';
?>
   <input type="text" name="namn" value="<?php echo $namn; ?>"placeholder="Ändra period">
   <button type="submit" name="save">Uppdatera</button>
</form>
</body>
</html>