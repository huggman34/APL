<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    require_once '../ViewFunctions.php';
    require_once '../UpdateFunctions.php';

$platsHandledare=$_POST['foretagPeriod'];

function selectForetag($conn,$period){
$sql = "SELECT * FROM plats INNER JOIN elev ON elev.elevID=plats.elevID
WHERE plats.handledarID IS NULL AND plats.foretagID IS NULL AND plats.periodNamn=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $period);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

return $data;
}

    $period=allHandledare($conn);
    echo "<table>";
    echo "<thead><tr><th>Elev</th><th>Klass</th><th>Period</th></tr></thead><tbody>";


   $data=selectForetag($conn,$platsHandledare);    
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

    echo "</tbody></table>";