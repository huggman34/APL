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
/**
 * Denna filen gör så att vi kan uppdatera dagarna som finns i dag tabellen i databasen
 * Den uppdatera dagen genom dagID som skickas in.
 */
session_start();
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../LoginFunctions.php';

    if(checkAdminLogin()) {
        $username = $_SESSION['username'];
        echo "Logged in as " . $username . "<br></br>";

    $sqlget = "SELECT * FROM dag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>Datum</th><th>Uppdatera information</th><th>Ta bort dag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['datum'];
        echo "</td><td>";
        ?>
        <a href="dagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="dagdelete.php?id=<?php echo $row['dagID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<?php

    //$dagID = $_SESSION['id'];

    $datum = '';

    if (isset($_POST['save'])) {
        updateDag($conn,$_POST['datum'],$_POST['dagID']);
        header("Location: ../Lists.php");
    }
   $sql = "SELECT * FROM dag";
   $result = mysqli_query($conn, $sql);

   echo '<form action="dagredigering.php" method="post">';
   echo '<label for="datum">Välj datum:</label>';
   echo '<select id="dagID" name="dagID">';
   while($rev = mysqli_fetch_array($result)){

   echo '<option value="' . $rev["dagID"] . '" >'. $rev["datum"] .'</option>';
   
   }
   echo '</select>';
?>
   <input type="date" name="datum" value="<?php echo $datum; ?>"placeholder="Ändra datum">
   <button type="submit" name="save">Uppdatera</button>
</form>
</body>
</html>
<?php
    } else {
        echo "Please log in first to see this page <br></br>";
    }
?>