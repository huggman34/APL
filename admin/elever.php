<?php
    require_once '../connection.php';

    $klass = $_POST['klass'];

    function elev($conn, $klass) {
        $sql = "SELECT * FROM elev
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
    //echo "<button type='button' onclick=\"deletBoxK('$klass');\" >...</button>";


    echo "<table class='elevTable'>";
    echo "<thead><tr><th>Elev</th><th>Förnamn</th><th>Efternamn</th><th>Klass</th></tr></thead><tbody>";

    foreach ($elever as $row) {
        $elevID = $row['elevID'];
        $fornamn = $row['fornamn'];
        $efternamn = $row['efternamn'];
        $klass = $row['klass'];
        $epost = $row['epost'];
        $telefon = $row['telefon'];

        echo "<tr><td>";
        echo $elevID;
        echo "</td><td>";
        echo $fornamn;
        echo "</td><td>";
        echo $efternamn;
        echo "</td><td>";
        echo $klass;
        echo "</td><td>";
        echo $epost;
        echo "</td><td>";
        echo $telefon;
        echo "<button type='button' onclick=\"deletBoxE('$elevID');\" >...</button>";
        echo "<button type='button' onclick=\"updateElev('$elevID', '$fornamn', '$efternamn', '$klass', '$epost', '$telefon');\" >Update</button>";
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>