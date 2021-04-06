<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['fornamn'], $_POST['efternamn'], $_POST['elevKlass'], $_POST['epost'], $_POST['nummer'])) {
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $klass = $_POST['elevKlass'];
        $epost = $_POST['epost'];
        $telefon = $_POST['nummer'];

        registerKlass($conn, $klass);
     
        registerElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon);
    }
?>