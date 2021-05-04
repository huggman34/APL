<?php
/**
 * Denna filen används för att kunna uppdatera företags tabellen utan att behöva uppdatera webbsidan.
 * företags data hämtas från databasen med hjälp av foretag funktionen i ViewFunctions.php
 * Sedan skriver den ut datan i en tabell. Denna tabellen visas upp genom att ladda in filen i en div
 * med hjälp av Jquery load()
 */
    require_once "../connection.php";
    require_once "../ViewFunctions.php";
                            
    $data = foretag($conn);
                        
    echo "<table class='foretagTable'>";
    echo "<thead><tr><th>Företag</th><th>Adress</th><th></th></tr></thead><tbody>";
                        
    foreach ($data as $row) {
        $foretagID = $row['foretagID'];
        $namn = $row['namn'];
        $adress = $row['adress'];

        echo "<tr><td>";
        echo $row['namn'];
        echo "</td><td>";
        echo $row['adress'];
        echo "</td><td>";
        echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
        echo "<div class='foretagMenu'>";
            echo "<button type='button' onclick=\"updateForetag('$foretagID', '$namn', '$adress');\" >Uppdatera</button>";
            echo "<button type='button' onclick=\"event.stopPropagation(); deleteForetag('$foretagID', '$namn');\" >Radera</button>";
        echo "</div>";
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>