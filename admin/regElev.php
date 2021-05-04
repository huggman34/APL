<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(!empty($_POST['fornamn']) && !empty($_POST['efternamn']) && !empty($_POST['elevKlass']) && !empty($_POST['epost']) && !empty($_POST['nummer'])) {
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $klass = $_POST['elevKlass'];
        $epost = $_POST['epost'];
        $telefon = $_POST['nummer'];

        registerKlass($conn, $klass);
    
        registerElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon);
    }
?>