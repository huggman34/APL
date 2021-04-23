<?php
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $klasser = klass($conn);
    $data = json_encode($klasser);

    print_r($data);
?>