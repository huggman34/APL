<html>
<body>
<?php
/**
 * här bestämmer man viken företags data som ska uppdateras
 */
   


    include '../UpdateFunctions.php';
    include_once '../connection.php';


    //$foretagsID = $_SESSION['id'];

    $namn = '';
    $losenord = '';
    $epost = '';
    $telefon = '';

   $sql = "SELECT * FROM foretag";
   $result = mysqli_query($conn, $sql);

   echo '<form action="foretagredigering.php" method="post">';
   echo '<label for="namn">Välj företag:</label>';
   echo '<select id="foretagID" name="foretagID">';
   while($rev = mysqli_fetch_array($result)){

   echo '<option value="' . $rev["foretagID"] . '" >'. $rev["namn"] .'</option>';
   
   }
   echo '</select>';
?>
   <input type="text" name="namn" value="<?php echo $namn; ?>"placeholder="Ändra namn">
   <input type="password" name="losenord" value="<?php echo $losenord; ?>" placeholder="Skriv nytt lösenord">
   <input type="text" name="epost" value="<?php echo $epost; ?>" placeholder="Skriv ny epost">
   <input type="text" name="telefon" value="<?php echo $telefon; ?>"placeholder="Skriv nytt telefonnummer">
   <button type="submit" name="save">Uppdatera</button>
</form>
<?php
if (isset($_POST['save'])) {
   updateForetag($conn,$_POST['namn'],$_POST['losenord'],$_POST['epost'],$_POST['telefon'],$_POST['foretagID']);
   
}
?>
</body>
</html>