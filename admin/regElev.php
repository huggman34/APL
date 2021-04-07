<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['fornamn'], $_POST['efternamn'], $_POST['elevKlass'], $_POST['epost'], $_POST['nummer'])) {
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $klass = $_POST['elevKlass'];
        $epost = $_POST['epost'];
        $telefon = $_POST['nummer'];
        $periodNamn = $_POST['periodN'];
        $foretag = 0;

        registerKlass($conn, $klass);
     
        $elevID=registerElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon);        
        registerPlats($conn,$elevID,$periodNamn,$foretag);

    }
?>