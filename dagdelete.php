<html>
<body>
<?php
    require_once 'perioddaglista.php';

    include('connection.php');

?>
<?php
    $id = $_GET['id'];
    $sql = "DELETE FROM dag WHERE dagID = '$id'";

    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:perioddaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }


?>
</body>
</html>