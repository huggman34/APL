<html>
<body>
<?php
/**
* I denna fil kan man redigera namnet på elever.
* Den skriver även ut elev tabellen igen för att lättare kunna se vad det är som redigeras.
*/
  session_start();
    //require_once '../Lists.php';
    require_once '../UpdateFunctions.php';
    require_once '../connection.php';
    require_once '../registerFunctions.php';
    require_once '../loginFunctions.php';

    if(checkAdminLogin()) {
        $username = $_SESSION['username'];
        echo "Logged in as " . $username . "<br></br>";
        if(isset($_GET['id'])){
            $id=$_GET['id'];
         }

    

    $sql = "SELECT * FROM foretag";
    $resultForetag = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM elev";
    $resultElev = mysqli_query($conn, $sql); 
  
   $sql = "SELECT * FROM period";
   $resultPeriod = mysqli_query($conn, $sql);

   $sql = "SELECT elevID,foretag.namn, periodNamn FROM plats INNER JOIN foretag ON plats.foretagID=foretag.foretagID WHERE platsID='$id'";
   $resultPlats = mysqli_query($conn, $sql);
   $ren=mysqli_fetch_array($resultPlats);

   $elev=$ren['elevID'];
   $foretag=$ren['namn'];
   $period=$ren['periodNamn'];

   if (isset($_POST['save'])) {
      updatePlats($conn,$_GET['id'],$_POST['periodNamn'],$_POST['elevID'],$_POST['foretagID']);
      header("Location: ../Lists.php");
   }

   echo "<form action='platsRedigering.php?id=$id' method='post'>";
   echo '<label for="fornamn">Välj saker:</label>';
   echo '<select id="periodID" name="periodNamn">';
   echo "<option disabled selected>$period</option>";
   while($rev = mysqli_fetch_array($resultPeriod)){

   echo '<option value="' . $rev["periodNamn"] . '" >'. $rev["periodNamn"] .'</option>';
   
   }
   echo '</select>';
   echo '<select id="foretagID" name="foretagID">';
   echo "<option disabled selected>$foretag</option>";
   while($run = mysqli_fetch_array($resultForetag)){

   echo '<option value="' . $run["foretagID"] . '" >'. $run["namn"] .'</option>';
   
   }
   echo '</select>';
   echo '<select id="elevID" name="elevID">';
   echo "<option disabled selected>$elev</option>";
   while($row = mysqli_fetch_array($resultElev)){

   echo '<option value="' . $row["elevID"] . '" >'. $row["elevID"] .'</option>';
   
   }
   echo '</select>';
?>
   <button type="submit" name="save">Uppdatera</button>
</form>
</body>
</html>
<?php
    } else {
        echo "Please log in first to see this page <br></br>";
    }
?>
