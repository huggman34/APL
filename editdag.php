<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <?php 

        session_start();
        require_once 'connection.php';

        $dagID = $_POST['dagID'];
        $datum = '';

        if(isset($_POST['dagID'])){
            $dagID = $_POST['dagID'];
            $datum = $_POST['datum'];


            $sql = "UPDATE dag SET datum='$datum' WHERE dagID=$dagID";
            mysqli_query($conn, $sql);
            
        }
        header('location: perioddaglista.php');
    ?>
</body>
</html>