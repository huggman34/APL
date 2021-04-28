<?php
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $klasser = Allklass($conn);
    foreach ($klasser as $k) {
        echo "<option value='".$k['klass']."'> ".$k['klass']." </option>";
    }
?>