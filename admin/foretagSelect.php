<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    require_once '../ViewFunctions.php';
    require_once '../UpdateFunctions.php';

$platsHandledare=$_POST['platsHandledare'];

function selectForetag($conn,$platsKlass){
$sql = "SELECT * FROM plats INNER JOIN elev ON elev.elevID=plats.elevID
WHERE plats.handledarID IS NULL AND plats.foretagID IS NULL AND elev.klass=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $platsKlass);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

return $data;
}

    $klass=selectTabel($conn,"klass");
    echo'<select id="handKlass" onchange="handledarPlats();">';
    echo "<option disabled selected> Välj klas </option>";
    foreach ($klass as $kls) {
        $kl=$kls['klass'];
        echo"<option value='$kl'>$kl</option>";
    }
    echo"</select>";
    echo "<table>";
    echo "<thead><tr><th>Elev</th><th>Klass</th><th>Period</th></tr></thead><tbody>";

if (isset($_POST['platsKlass'])) {
   $data=selectForetag($conn,$_POST['platsKlass']);    
    foreach ($data as $e) {
        
        $elevID =$e['platsID'];
        echo "<tr><td>";
        echo $e['elevID'];
        echo "</td><td>";
        echo $e['klass'];
        echo "</td><td>";
        echo $e['periodNamn'];
        echo "</td><td>";
        echo"<input id='elevPlats' type='checkbox' name='elevPlats' value='$elevID'>";
        echo "</td></tr>";
        
        
    }
}
    echo "</tbody></table>";