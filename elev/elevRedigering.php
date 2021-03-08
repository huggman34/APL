<html>
<body>
<?php
    require_once 'elevlista.php';
    include_once 'connection.php';


    $elevID = $_SESSION['id'];

    $fornamn = '';
    $efternamn = '';

   $sql = "SELECT * FROM elev";
   $result = mysqli_query($conn, $sql);

   echo '<form action="editelev.php" method="post">';
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