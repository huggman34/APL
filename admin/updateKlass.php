<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['klass'], $_POST['nyKlass'])) {
        $klassID = $_POST['klass'];
        $nyKlass = $_POST['nyKlass'];
        
        updateKlass($conn, $nyKlass, $klassID);
    }
?>