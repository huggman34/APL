<?php
/**
 * Denna filen används för att kunna filtrera elev tabellen genom AJAX request utan att behöva
 * uppdatera webbsidan. Beroende på vilket värde som skickas in så skriver den ut tabllen
 * med eleverna som ska visas upp. Som sedan appendas till en div på hemsidan.
 */
    require_once '../connection.php';

    if(isset($_POST['klass'])) {

        $klass = $_POST['klass'];
        
        function elev($conn, $klass) {

            if(empty($klass)) {
                $sql = "SELECT elev.elevID, elev.fornamn, elev.efternamn, klass.klass, elev.epost, elev.telefon
                FROM elev
                INNER JOIN klass ON klass.klass = elev.klass";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                return $data;

            } else {
                $sql = "SELECT elev.elevID, elev.fornamn, elev.efternamn, klass.klass, elev.epost, elev.telefon
                FROM elev
                INNER JOIN klass ON klass.klass = elev.klass
                WHERE klass.klass = ?";
        
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $klass);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
        
                return $data;
            }
        }

        $elever = elev($conn, $klass);

        echo "<table class='elevTable'>";
        echo "<thead><tr><th>Förnamn</th><th>Efternamn</th><th>Klass</th><th>Telefon</th><th></th></tr></thead><tbody>";

        foreach ($elever as $row) {
            $elevID = $row['elevID'];
            $fornamn = $row['fornamn'];
            $efternamn = $row['efternamn'];
            $klass = $row['klass'];
            $epost = $row['epost'];
            $telefon = $row['telefon'];

            echo "<tr><td>";
            echo $fornamn;
            echo "</td><td>";
            echo $efternamn;
            echo "</td><td>";
            echo $klass;
            echo "</td><td>";
            echo $telefon;
            echo "</td><td>";
            echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
            echo "<div class='elevMenu'>";
                echo "<button type='button' onclick=\"updateElev('$elevID', '$fornamn', '$efternamn', '$klass', '$epost', '$telefon');\" >Uppdatera</button>";
                echo "<button type='button' onclick=\"deleteElev('$elevID');\" >Radera</button>";
            echo "</div>";
            echo "</td></tr>";
            echo "<tr class='secondRow'><td>";
            echo $elevID;
            echo "</td><td style='width: 50%'>";
            echo $epost;
            echo "</td></tr>";
        }
        echo "</tbody></table>";
    }
?>