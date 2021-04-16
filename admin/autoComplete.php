<?php
    require_once '../connection.php';

    $searchTerm = $_GET["term"];
    $sql = "SELECT `klass` FROM `klass` WHERE klass LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql);

    $json = array();

    if($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
            array_push($json, $row['klass']);
        }
    }

    echo json_encode($json);
?>