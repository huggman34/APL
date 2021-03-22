<?php
function foretagElever($conn,$foretagNamn){
    $sql = "SELECT foretag.namn, plats.elevID, dag.datum, narvaro.narvaro
    FROM narvaro
    INNER JOIN plats ON plats.platsID = narvaro.platsID
    INNER JOIN foretag ON foretag.foretagID = plats.foretagID
    INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
    INNER JOIN dag ON dag.dagID = perioddag.dagID
    WHERE foretag.namn = ? ORDER BY dag.datum ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $foretagNamn);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    
    return $data;
}
function selectTabel($conn,$tabel){
    $rund= array();
    $sql = "SELECT * FROM $tabel";
    $sqldata = mysqli_query($conn, $sql) or die("error");
    while($row = mysqli_fetch_assoc($sqldata)){
        $rund[]=$row;
    }

    return $rund;
    
}
function elevNarvaro($conn,$elevID){
        $sql = "SELECT foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
        INNER JOIN plats ON plats.platsID=narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID=plats.foretagID
        INNER JOIN elev ON elev.elevID=plats.elevID
        INNER JOIN dag ON perioddag.dagID=dag.dagID 
        WHERE elev.elevID=? ORDER BY dag.datum";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $elevID);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
} 
?>