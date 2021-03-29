<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['klassNamn'])) {
        $klass = $_POST['klassNamn'];

        registerKlass($conn, $klass);
    }
?>