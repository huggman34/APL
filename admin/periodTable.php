<?php
    require_once "../connection.php";
    require_once "../ViewFunctions.php";

    $period="period";
    $data = selectTabel($conn,$period);

    echo "<table class='elevklassTable'>";
    echo "<thead><tr><th>Period</th><th>Startdatum</th><th>Slutdatum</th><th></th></tr></thead><tbody>";

    foreach($data as $row){
        $periodID=$row['periodNamn'];
        $slutdatum=$row['slutdatum'];
        $startdatum=$row['startdatum'];

        echo "<tr><td>";
        echo $row['periodNamn'];
        echo "</td><td>";
        echo $row['startdatum'];
        echo "</td><td>";
        echo $row['slutdatum'];
        echo "</td><td>";
        echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
        echo "<div class='periodMenu'>";
            //echo "<button type='button' onclick=\"deletBoxPr('$periodID');\" >Ta bort</button>";
            echo "<button type='button' onclick=\"updatePeriod('$periodID','$slutdatum','$startdatum'); UdagPeriod()\" >Uppdatera</button>";
            echo "<button type='button' onclick=\"deletePeriod('$periodID');\" >Radera</button>";
        echo "</div>";
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>