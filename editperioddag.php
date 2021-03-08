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

        $periodDagID = $_POST['periodDagID'];
        $periodID = '';
        $dagID = '';

        if(isset($_POST['periodDagID'])){
            $periodDagID = $_POST['periodDagID'];
            $periodID = $_POST['periodID'];
            $dagID = $_POST['dagID'];


            $sql = "UPDATE perioddag SET periodID='$periodID', dagID='$dagID' WHERE periodDagID=$periodDagID";
            mysqli_query($conn, $sql);
            
        }
        header('location: perioddaglista.php');
    ?>
</body>
</html>