<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    
    if(!empty($_POST['fornamn']) && !empty($_POST['efternamn']) && !empty($_POST['epost']) && !empty($_POST['telefon']) && !empty($_POST['losenord']) && !empty($_POST['foretagID'])) {
        $foretagID = $_POST['foretagID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];
        $losenord = $_POST['losenord'];

        registerHandledare($conn, $foretagID, $fornamn, $efternamn, $epost, $telefon, $losenord);

    } else {
        echo "Fyll i alla fält";
    }
?>