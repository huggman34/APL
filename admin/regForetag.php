<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    /*if(isset($_POST['fornamn'], $_POST['efternamn'], $_POST['epost'], $_POST['telefon'])) {
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];
        
        registerHandledare($conn, $fornamn, $efternamn, $epost, $telefon);
    }*/

    if(isset($_POST['namn'], $_POST['losenord'], $_POST['adress'])) {
        $namn = $_POST['namn'];
        $losenord = $_POST['losenord'];
        $adress = $_POST['adress'];
        
        registerForetag($conn, $namn, $losenord, $adress);
    }
?>