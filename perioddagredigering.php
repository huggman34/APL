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

    $sqlget = "SELECT * FROM perioddag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>perioddagID</th><th>periodID</th><th>dagID</th><th>Uppdatera information</th><th>Ta bort period</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['periodDagID'];
        echo "</td><td>";
        echo $row['periodID'];
        echo "</td><td>";
        echo $row['dagID'];
        echo "</td><td>";
        ?>
        <a href="perioddagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="perioddagdelete.php?id=<?php echo $row['periodID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<?php
    session_start();

    $periodDagID = $_SESSION['id'];

    $periodID = '';
    $dagID = '';

   $sql = "SELECT * FROM perioddag";
   $result = mysqli_query($conn, $sql);

   echo '<form action="editperioddag.php" method="post">';
   echo '<label for="namn">Välj periodID:</label>';
   echo '<select id="periodDagID" name="periodDagID">';
   while($rev = mysqli_fetch_array($result)){

   echo '<option value="' . $rev["periodDagID"] . '" >'. $rev["dagID"] .'</option>';
   
   }
   echo '</select>';
?>
   <input type="text" name="periodID" value="<?php echo $periodID; ?>"placeholder="Ändra periodID">
   <input type="text" name="dagID" value="<?php echo $dagID; ?>"placeholder="Ändra dagID">
   <button type="submit" name="save">Uppdatera</button>
</form>
</body>
</html>