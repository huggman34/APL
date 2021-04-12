<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    
    if(isset($_POST['namn'], $_POST['adress'])) {
        $foretag = $_POST['namn'];
        $adress = $_POST['adress'];

        registerForetag($conn, $foretag, $adress);
    }
?>