<?php
require_once '../connection.php';
$platsElev=$_POST['platsElev'];
$sql = "SELECT periodNamn FROM plats
WHERE elevID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $platsElev);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

foreach ($data as $row) {
    echo $row['periodNamn'];
}

?>