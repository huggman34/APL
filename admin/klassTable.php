<?php
    require_once "../connection.php";
    require_once "../ViewFunctions.php";

    $data = allKlass($conn);

    echo "<table class='elevklassTable'>";
    echo "<thead><tr><th>Klass</th><th></th></tr></thead><tbody>";

    foreach($data as $row){
        $klass = $row['klass'];

        echo "<tr><td>";
        echo $row['klass'];
        echo "</td><td>";
        echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
        echo "<div class='klassMenu'>";
            echo "<button type='button' onclick=\"updateKlass('$klass');\" >Uppdatera</button>";
            echo "<button type='button' onclick=\"deleteKlass('$klass');\" >Radera</button>";
        echo "</div>";
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>