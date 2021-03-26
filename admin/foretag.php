<?php
    require_once '../connection.php';

    $namn = $_POST['namn'];

    function foretag($conn, $namn) {
        $sql = "SELECT namn, epost, telefon FROM foretag
        WHERE namn = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $namn);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    $foretag = foretag($conn, $namn);


    echo "<table class='foretagTable'>";
    echo "<thead><tr><th>Företag</th><th>Epost</th><th>Telefonnummer</th></tr></thead><tbody>";

    foreach ($foretag as $row) {
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