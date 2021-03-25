<?php
    require_once '../connection.php';

    $klass = $_POST['klass'];

    function elev($conn, $klass) {
        $sql = "SELECT elevID, fornamn, efternamn FROM elev
        WHERE klass = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $klass);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    $elever = elev($conn, $klass);

    /*foreach ($elever as $e) {
        echo $e['elevID'];
        echo ';';
    }*/
    //print_r($elever);

    echo "<table class='elevTable'>";
    echo "<thead><tr><th>Elev</th><th>Förnamn</th><th>Efternamn</th></tr></thead><tbody>";

    foreach ($elever as $row) {
        echo "<tr><td>";
        echo $row['elevID'];
        echo "</td><td>";
        echo $row['fornamn'];
        echo "</td><td>";
        echo $row['efternamn'];
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>