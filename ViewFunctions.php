<?php
    function narvaroIdag($conn) {
        $sql = "SELECT plats.elevID, foretag.namn, plats.periodNamn, dag.datum, narvaro.narvaro
        FROM narvaro
        INNER JOIN plats ON plats.platsID = narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN dag ON dag.dagID = perioddag.dagID
        WHERE dag.datum = CURRENT_DATE";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function elevKlass($conn) {
        $sql = "SELECT plats.elevID, plats.periodNamn, foretag.namn
        FROM plats
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        WHERE plats.periodNamn = '?'
        ORDER BY elevID ASC";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function periodNarvaro($conn) {
        $sql = "SELECT narvaro.narvaro FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN period ON period.periodNamn = perioddag.periodNamn
        WHERE period.periodNamn = '?'";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

function foretagElever($conn){
    $sql = "SELECT foretag.namn, plats.elevID, dag.datum, narvaro.narvaro
    FROM narvaro
    INNER JOIN plats ON plats.platsID = narvaro.platsID
    INNER JOIN foretag ON foretag.foretagID = plats.foretagID
    INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
    INNER JOIN dag ON dag.dagID = perioddag.dagID
    WHERE foretag.namn = '?' ORDER BY dag.datum ASC";
   $result = mysqli_query($conn, $sql);
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
function elevNarvaro($conn){
        $sql = "SELECT foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
        INNER JOIN plats ON plats.platsID=narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID=plats.foretagID
        INNER JOIN elev ON elev.elevID=plats.elevID
        INNER JOIN dag ON perioddag.dagID=dag.dagID 
        WHERE elev.elevID='?' ORDER BY dag.datum";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $data;
} 
function foretag($conn){
    $sql= "SELECT * FROM foretag";

    $result = mysqli_query($conn, $sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}
?>