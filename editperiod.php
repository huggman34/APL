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

        $periodID = $_POST['periodID'];
        $namn = '';

        if(isset($_POST['periodID'])){
            $periodID = $_POST['periodID'];
            $namn = $_POST['namn'];


            $sql = "UPDATE period SET namn='$namn' WHERE periodID=$periodID";
            mysqli_query($conn, $sql);
            
        }
        header('location: perioddaglista.php');
    ?>
</body>
</html>