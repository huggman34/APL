<?php
    session_start();
    require_once '../connection.php';
    header('Content-Type: text/html; charset=utf-8');

    if(isset($_POST['klass'])) {

        $klass = $_POST['klass'];

        //$_SESSION['klassNow'] = $klass;
        
        function elev($conn, $klass) {

            if(empty($klass)) {
                $sql = "SELECT * FROM elev";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                return $data;

            } else {
                $sql = "SELECT * FROM elev
                WHERE klass = ?";
        
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $klass);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
        
                return $data;
            }
        }

        $elever = elev($conn, $klass);

        //echo json_encode($elever, JSON_UNESCAPED_UNICODE);

        echo "<table class='elevTable'>";
        echo "<thead><tr><th>Förnamn</th><th>Efternamn</th><th>Klass</th><th>Epost</th><th>Telefon</th><th></th></tr></thead><tbody>";

        foreach ($elever as $row) {
            $elevID = $row['elevID'];
            $fornamn = $row['fornamn'];
            $efternamn = $row['efternamn'];
            $klass = $row['klass'];
            $epost = $row['epost'];
            $telefon = $row['telefon'];

            $elevArr = explode('.', $elevID);

            echo "<tr><td>";
            echo $elevArr[0];
            echo "</td><td>";
            echo $elevArr[1];
            echo "</td><td>";
            echo $klass;
            echo "</td><td>";
            echo $epost;
            echo "</td><td>";
            echo $telefon;
            echo "</td><td>";
            echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
            echo "<div class='elevMenu'>";
                //echo "<button type='button' onclick=\"deletBoxE('$elevID');\" >Ta bort</button>";
                echo "<button type='button' onclick=\"updateElev('$elevID', '$fornamn', '$efternamn', '$klass', '$epost', '$telefon');\" >Uppdatera</button>";
                echo "<button type='button' onclick=\"deleteElev('$elevID');\" >Radera</button>";
            echo "</div>";
            echo "</td></tr>";
        }
        echo "</tbody></table>";
    }
?>