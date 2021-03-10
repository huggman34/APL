<html>
<body>
<?php
/**
* I denna fil kan man redigera namnet på elever.
* Den skriver även ut elev tabellen igen för att lättare kunna se vad det är som redigeras.
*/
  
    //require_once '../Lists.php';
    include '../UpdateFunctions.php';
    include_once '../connection.php';


    //$elevID = $_SESSION['id'];

    $fornamn = '';
    $efternamn = '';

   $sql = "SELECT * FROM elev";
   $result = mysqli_query($conn, $sql);

   if (isset($_POST['save'])) {
      updateElev($conn,$_POST['fornamn'],$_POST['efternamn'],$_POST['elevID']);
   }
   echo '<form action="elevRedigering.php" method="post">';
   echo '<label for="fornamn">Välj elev:</label>';
   echo '<select id="elevID" name="elevID">';
   while($rev = mysqli_fetch_array($result)){

   echo '<option value="' . $rev["elevID"] . '" >'. $rev["fornamn"] .'</option>';
   
   }
   echo '</select>';
?>
   <input type="text" name="fornamn" value="<?php echo $fornamn; ?>"placeholder="Ändra förnamn">
   <input type="text" name="efternamn" value="<?php echo $efternamn; ?>" placeholder="Ändra efternamn">
   <button type="submit" name="save">Uppdatera</button>
</form>
</body>
</html>