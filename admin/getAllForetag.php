<?php
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $foretag = foretag($conn);
    $data = json_encode($foretag);

    print_r($data);
?>