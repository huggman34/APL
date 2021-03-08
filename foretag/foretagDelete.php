<html>
<body>
<?php
    require_once 'foretaglista.php';
    include_once 'connection.php';
?>
<?php

    $id = $_POST['foretagsID'];

    if(isset($_POST['foretagsID'])){
        $id = $_POST['foretagsID'];

    $sqlget = "DELETE FROM foretag WHERE foretagsID = '$id'";
    if (mysqli_query($conn, $sqlget)){
        mysqli_close($conn);
        header('location:foretaglista.php');
    } else{
        echo "Error deleting record";
    }    
    }


?>
</body>
</html>