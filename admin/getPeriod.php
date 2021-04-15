<?php
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $allPeriod = allPeriod($conn);
    $data = json_encode($allPeriod);

    print_r($data);
?>