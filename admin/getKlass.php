<?php
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $klasser = Allklass($conn);
    $data = json_encode($klasser);

    print_r($data);
?>