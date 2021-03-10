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
* I denna fil väljer man vilken dag som tillhör vilken period genom att välja namnet på perioden och ID på dagen.
* Den skriver även ut perioddag tabellen igen för att lättare kunna se vad det är som redigeras.
*/

    include_once '../connection.php';
    include '../UpdateFunctions.php';

    $sqlget = "SELECT * FROM perioddag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>perioddagID</th><th>periodNamn</th><th>dagID</th><th>Uppdatera information</th><th>Ta bort period</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['perioddagID'];
        echo "</td><td>";
        echo $row['periodNamn'];
        echo "</td><td>";
        echo $row['dagID'];
        echo "</td><td>";
        ?>
        <a href="perioddagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="perioddagdelete.php?id=<?php echo $row['perioddagID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<?php
    session_start();

    $perioddagID = $_SESSION['id'];

    $periodNamn = '';
    $dagID = '';

    if (isset($_POST['save'])) {
        //refererar till funktion
        updatePeriodDag($conn,$_POST['periodNamn'],$_POST['dagID'],$_POST['perioddagID']);
        header("Location: ../Lists.php");
    }
   $sql = "SELECT * FROM perioddag";
   $result = mysqli_query($conn, $sql);

   echo '<form action="perioddagredigering.php" method="post">';
   echo '<label for="periodNamn">Välj period:</label>';
   echo '<select id="perioddagID" name="perioddagID">';
   while($rev = mysqli_fetch_array($result)){

   echo '<option value="' . $rev["perioddagID"] . '" >'. $rev["perioddagID"] .'</option>';
   
   }
   echo '</select>';
?>
   <input type="text" name="periodNamn" value="<?php echo $periodNamn; ?>"placeholder="Ändra period">
   <input type="text" name="dagID" value="<?php echo $dagID; ?>"placeholder="Ändra dagID">
   <button type="submit" name="save">Uppdatera</button>
</form>
</body>
</html>