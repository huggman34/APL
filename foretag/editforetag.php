<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <?php 
    /**
     * Den här filen refererars till om man vill uppdatera datan i foretag tabellen. 
     */
        session_start();
        include_once '../connection.php';

        $foretagsID = $_POST['foretagsID'];
        $namn = '';
        $losenord = '';
        $epost = '';
        $telefon = '';

        if(isset($_POST['foretagsID'])){
            $foretagsID = $_POST['foretagsID'];
            $namn = $_POST['namn'];
            $losenord = $_POST['losenord'];
            $epost = $_POST['epost'];
            $telefon = $_POST['telefon'];


            $sql = "UPDATE foretag SET namn='$namn', losenord='$losenord', epost='$epost', telefon='$telefon' WHERE foretagsID=$foretagsID";
            mysqli_query($conn, $sql);
            
        }
        header('location: ../perioddag/perioddaglista.php');
    ?>
</body>
</html>