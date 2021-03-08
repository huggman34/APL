<?php 
    include_once '../connection.php';

    $result = $_POST['elev'];

    $result_explode = explode('|', $result);
    
    $platsID = $result_explode[0];
    $periodDagID = $result_explode[1];
    $narvaro = $_POST['narvaro'];

    $dupeCheck = mysqli_query($conn ,"SELECT * FROM narvaro WHERE (platsID = '$platsID' AND periodDagID = '$periodDagID')");

    $result = $dupeCheck->num_rows;

    if($result == 0) {
        $stmt = $conn->prepare("INSERT INTO narvaro (platsID, periodDagID, narvaro) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $platsID, $periodDagID, $narvaro);

        if ($stmt->execute()) {
            echo "Närvaro har lagts till";
            header('Location:../reportForm.php');
        } else {
            echo "Något gick fel";
        }
    } else {
        echo "Eleven har redan registrerats närvaro";
    }
?>