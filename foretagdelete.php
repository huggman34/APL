<html>
<body>
<?php
    require_once 'foretaglista.php';

    include('connection.php');

?>
<?php
    $id = $_GET['id'];
    $sql = "DELETE FROM foretag WHERE foretagsID = '$id'";

    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:foretaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }


?>
</body>
</html>