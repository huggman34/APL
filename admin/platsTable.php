<?php
    require_once "../connection.php";
    require_once "../ViewFunctions.php";

    $platser = elevPlats($conn);

    echo "<table class='platsTable'>";
    echo "<thead><tr><th>Elev</th><th>Företag</th><th>Handledare</th><th>Period</th><th></th></tr></thead><tbody>";
                            
    foreach ($platser as $row) {
        $platsID=$row['platsID'];
        $elevID=$row['elevID'];
        $periodNamn=$row['periodNamn'];
        $foretagID=$row['foretagID'];
        $handledarID = $row['handledarID'];
        $handledarFornamn = $row['fornamn'];
        $handledarEfternamn = $row['efternamn'];

        $elev = str_replace(".", " ", $elevID);

        echo "<tr><td>";
        echo $elev;
        echo "</td><td>";
        echo $row['namn'];
        echo "</td><td>";
        echo "$handledarFornamn $handledarEfternamn";
        echo "</td><td>";
        echo "$periodNamn";
        echo "</td><td>";
        echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
        echo "<div class='platsMenu'>";
            echo "<button type='button' onclick=\"updatePlats('$platsID','$handledarID','$periodNamn');\" >Uppdatera</button>";
            echo "<button type='button' onclick=\"deletePlats('$platsID','$elevID');\" >Radera</button>";
        echo "</div>";
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>