<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(!empty($_POST['namn']) && !empty($_POST['adress'])) {
        $foretag = $_POST['namn'];
        $adress = $_POST['adress'];

        registerForetag($conn, $foretag, $adress);

    } else {
        echo "Fyll i alla fält";
    }
?>