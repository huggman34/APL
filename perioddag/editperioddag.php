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

        $periodDagID = $_POST['perioddagID'];
        $periodNamn = '';
        $dagID = '';

        if(isset($_POST['perioddagID'])){
            $perioddagID = $_POST['perioddagID'];
            $periodNamn = $_POST['periodNamn'];
            $dagID = $_POST['dagID'];


            $sql = "UPDATE perioddag SET periodNamn='$periodNamn', dagID='$dagID' WHERE periodDagID=$perioddagID";
            mysqli_query($conn, $sql);
            
        }
        header('location: perioddaglista.php');
    ?>
</body>
</html>