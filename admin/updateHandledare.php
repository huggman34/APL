<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['handledarID'], $_POST['fornamn'], $_POST['efternamn'], $_POST['foretagID'], $_POST['epost'], $_POST['telefon'])) {
        $handledarID = $_POST['handledarID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $foretagID = $_POST['foretagID'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];

        updateHandledare($conn, $fornamn, $efternamn, $foretagID, $epost, $telefon, $handledarID);
    }
?>