<?php
/**
 * Denna filen används för att kunna uppdatera dagens närvaro tabellen utan att behöva uppdatera webbsidan.
 * företags data hämtas från databasen med hjälp av foretag funktionen i ViewFunctions.php
 * Sedan skriver den ut datan i en tabell. Denna tabellen visas upp genom att ladda in filen i en div
 * med hjälp av Jquery load()
 */
    require_once "../connection.php";
    require_once "../ViewFunctions.php";

    $data = narvaroIdag($conn);

    echo "<table class='narvaroTable'>";
    echo "<thead><tr><th>Elev</th><th>Företag</th><th>Period</th><th>Närvaro</th><th></th></tr></thead><tbody>";

    foreach ($data as $row => $column) {
        $elevID = $column['elevID'];
        $elev = str_replace(".", " ", $elevID);

        if (is_null($column['narvaro'])) {
            $column['narvaro'] = "null";
        }
                                    
        $str = ['null', '1', '2', '3'];
        $rplc = ['Oanmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];
                        
        $column2 = str_replace($str, $rplc, $column);

        $narvaroID = $column['narvaroID'];
        $narvaro = $column2['narvaro'];
                                    
        echo "<tr><td>";
        echo $elev;
        echo "</td><td>";
        echo $column['namn'];
        echo "</td><td>";
        echo $column['periodNamn'];
        echo "</td><td>";
        echo $column2['narvaro'];
        echo "</td><td>";
        echo "<button type='button' onclick=\"updateElevNarvaroIdag('$narvaroID', '$narvaro');\" >Uppdatera</button>";
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>