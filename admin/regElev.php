<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['fornamn'], $_POST['efternamn'], $_POST['elevKlass'])) {
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $klass = $_POST['elevKlass'];
     
        registerElev($conn, $fornamn, $efternamn, $klass);
    }
?>