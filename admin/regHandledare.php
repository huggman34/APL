<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['fornamn'], $_POST['efternamn'], $_POST['epost'], $_POST['telefon'], $_POST['losenord'], $_POST['foretagID'])) {
        $foretagID = $_POST['foretagID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];
        $losenord = $_POST['losenord'];

        registerHandledare($conn, $foretagID, $fornamn, $efternamn, $epost, $telefon, $losenord);
    }
?>