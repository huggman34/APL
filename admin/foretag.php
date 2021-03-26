<?php
    require_once '../connection.php';

    $foretag = $_POST['foretag'];

    function foretags($conn, $foretag) {
        $sql = "SELECT namn, epost, telefon FROM foretag
        WHERE namn = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $foretag);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    $foretags = foretags($conn, $foretag);

    /*foreach ($elever as $e) {
        echo $e['elevID'];
        echo ';';
    }*/
    //print_r($elever);

    echo "<table class='foretagTable'>";
    echo "<thead><tr><th>Företag</th><th>Epost</th><th>Telefonnummer</th></tr></thead><tbody>";

    foreach ($foretags as $row) {
        echo "<tr><td>";
        echo $row['namn'];
        echo "</td><td>";
        echo $row['epost'];
        echo "</td><td>";
        echo $row['telefon'];
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>