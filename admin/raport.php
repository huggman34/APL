<?php
require_once "../connection.php";

function narvaroRap($conn,$fdatum,$sdatum) {
    $sql = "SELECT dag.datum,plats.elevID, plats.periodNamn, narvaro.narvaro, narvaro.narvaroID,elev.klass
    FROM narvaro
    INNER JOIN plats ON plats.platsID = narvaro.platsID
    INNER JOIN foretag ON foretag.foretagID = plats.foretagID
    INNER JOIN handledare ON handledare.handledarID = plats.handledarID
    INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
    INNER JOIN dag ON dag.dagID = perioddag.dagID
    INNER JOIN elev ON elev.elevID=plats.elevID
    WHERE dag.datum >= ? AND dag.datum <= ? AND narvaro.narvaro IS NOT NULL ORDER BY klass";
  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fdatum,$sdatum);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}
echo'<form action="raport.php" method="post">
<input type="date" name="fdatum">
<input type="date" name="sdatum">
<input type="submit" name="submit" value="få raport">
</form>';
if (isset($_POST['submit'])) {

$elevNarvaro=narvaroRap($conn,$_POST['fdatum'],$_POST['sdatum']);
    echo "<table>";
    echo "<thead><tr><th>Elev</th><th>Klass</th><th>Period</th><th>Datum</th><th>Närvaro</th><th></th></tr></thead><tbody>";

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
        echo $column['elevID'];
        echo "</td><td>";
        echo $column['klass'];
        echo "</td><td>";
        echo $column['periodNamn'];
        echo "</td><td>";
        echo $column['datum'];
        echo "</td><td>";
        echo $column2['narvaro'];
        echo "</td></tr>";
    }
    echo "</tbody></table>";
}
?>