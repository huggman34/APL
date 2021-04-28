<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['elevID'], $_POST['fornamn'], $_POST['efternamn'], $_POST['klass'], $_POST['epost'], $_POST['telefon'])) {
        $elevID = $_POST['elevID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $klass = $_POST['klass'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];

        updateElev2($conn, $fornamn, $efternamn, $klass, $epost, $telefon, $elevID);
    }
?>