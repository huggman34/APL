<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    require_once '../ViewFunctions.php';
    require_once '../UpdateFunctions.php';

$platsPeriod=$_POST['platsPeriod'];

function selectPeriod($conn,$platsPeriod,$elevID){
$sql = "SELECT * FROM elev INNER JOIN plats ON elev.elevID=plats.elevID
WHERE plats.periodNamn=? AND plats.elevID=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $platsPeriod,$elevID);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

return $data;
}
    
    $elev=selectTabel($conn,"elev");
    $klass=selectTabel($conn,"klass");
    echo'<select id="platsKlass" onchange="elevPlatsPeriod();">';
    echo "<option disabled selected> Välj klas </option>";
    foreach ($klass as $kls) {
        $kl=$kls['klass'];
        echo"<option value='$kl'>$kl</option>";
    }
    echo"</select>";
    echo "<table>";
    echo "<thead><tr><th>Elev</th><th>Klass</th></tr></thead><tbody>";

    
    foreach ($elev as $e) {
        if (isset($_POST['platsKlass'])) {
                $platsKlass=$_POST['platsKlass'];
                $elevID=$e['elevID'];

                $data=selectPeriod($conn,$platsPeriod,$elevID);

        if (empty($data) && $platsKlass==$e['klass']) {

        
        echo "<tr><td>";
        echo $e['elevID'];
        echo "</td><td>";
        echo $e['klass'];
        echo "</td><td>";
        echo"<input id='elevPeriod' type='checkbox' name='elevPeriod' value='$elevID'>";
        echo "</td></tr>";
        }
        
        }

    }
    echo "</tbody></table>";

?>