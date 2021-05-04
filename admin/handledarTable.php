<?php
    require_once "../connection.php";
    require_once "../ViewFunctions.php";

    $data = allHandledare($conn);
                            
    echo "<table class='handledarTable'>";
    echo "<thead><tr><th>HandledarID</th><th>Handledare</th><th>Företag</th><th>E-post</th><th>Telefon</th><th></th></tr></thead><tbody>";
                            
    foreach ($data as $row) {
        $handledarID = $row['handledarID'];
        $fornamn = $row['fornamn'];
        $efternamn = $row['efternamn'];
        $epost = $row['epost'];
        $foretag = $row['namn'];
        $telefon = $row['telefon'];

        echo "<tr><td>";
        echo "$handledarID";
        echo "</td><td>";
        echo "$fornamn $efternamn";
        echo "</td><td>";
        echo $foretag;
        echo "</td><td>";
        echo $epost;
        echo "</td><td>";
        echo $telefon;
        echo "</td><td>";
        echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
        echo "<div class='handledarMenu'>";
            echo "<button type='button' onclick=\"updateHandledare('$handledarID', '$fornamn', '$efternamn', '$foretag', '$epost', '$telefon');\" >Uppdatera</button>";
            echo "<button type='button' onclick=\"deleteHandledare('$handledarID', '$fornamn', '$efternamn');\" >Radera</button>";
        echo "</div>";
        echo "</td></tr>";
    }
    echo "</tbody></table>";
?>