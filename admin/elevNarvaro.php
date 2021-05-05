<?php
/**
 * Denna filen används för att visa en elevs närvaro data, genom att elevens ID postas via AJAX request
 * Sedan så används elevID i funktionen för att få fram elevens närvaro från databasen.
 * Tillslut skrivs datan ut i en tabell som appendas i en div på hemsidan.
 */
    require_once '../connection.php';
    require_once '../ViewFunctions.php';

    $elevID = $_POST['elevID'];
    
    $elevNarvaro = elevNarvaro($conn, $elevID);

    if(!empty($elevNarvaro)){
        echo "<table class='elevNarvaro'>";
        echo "<thead><tr><th>Företag</th><th>Datum</th><th>Närvaro</th><th></th></tr></thead><tbody>";

        foreach ($elevNarvaro as $row => $column) {

            if (is_null($column['narvaro'])) {
                $column['narvaro'] = "null";
            }
            
            $str = ['null', '1', '2', '3'];
            $rplc = ['Oanmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];

            $column2 = str_replace($str, $rplc, $column);

            $narvaroID = $column['narvaroID'];
            $narvaro = $column2['narvaro'];
            
            echo "<tr><td>";
            echo $column['namn'];
            echo "</td><td>";
            echo $column['datum'];
            echo "</td><td>";
            echo $column2['narvaro'];
            echo "</td><td>";
            echo "<button type='button' onclick=\"updateElevNarvaro('$narvaroID', '$narvaro');\" >Uppdatera</button>";
            echo "</td></tr>";
        }
        echo "</tbody></table>";

    } else {
        echo "Ingen data är tillgänglig";
    }
?>