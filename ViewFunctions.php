<?php
    function narvaroIdag($conn) {
        $sql = "SELECT plats.elevID, foretag.namn, plats.periodNamn, dag.datum, narvaro.narvaro
        FROM narvaro
        INNER JOIN plats ON plats.platsID = narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN dag ON dag.dagID = perioddag.dagID
        WHERE dag.datum = CURRENT_DATE
        ORDER BY periodNamn,elevID ASC";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }
    function narvaroIdagForetag($conn,$foretag) {
        $sql = "SELECT plats.elevID, plats.periodNamn, narvaro.narvaro,plats.platsID,perioddag.perioddagID
        FROM narvaro
        INNER JOIN plats ON plats.platsID = narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN dag ON dag.dagID = perioddag.dagID
        WHERE dag.datum = CURRENT_DATE AND foretag.namn=?";
      
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $foretag);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
   
    function elevKlass($conn) {
        $sql = "SELECT plats.elevID, plats.periodNamn
        FROM plats
        ORDER BY periodNamn,elevID ASC";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function elevPlats($conn) {
        $sql = "SELECT plats.platsID, plats.elevID, foretag.namn
        FROM plats
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        ORDER BY elevID ASC";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function periodNarvaro($conn, $period) {
        $sql = "SELECT narvaro.narvaro FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN period ON period.periodNamn = perioddag.periodNamn
        WHERE period.periodNamn = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $period);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function period($conn) {
        $sql = "SELECT DISTINCT perioddag.periodNamn
        FROM narvaro
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function allPeriod($conn) {
        $sql = "SELECT * FROM period";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function klass($conn) {
        $sql = "SELECT DISTINCT elev.klass
        FROM elev";

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

    function allElev($conn){
        $sql= "SELECT * FROM elev";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }


    function elev($conn, $klass) {
        $sql = "SELECT elevID, klass FROM elev
        WHERE klass = '?'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $klass);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    }

function foretagElever($conn,$foretagNamn){
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
    function elevNarvaro($conn, $elevID){

            $sql = "SELECT foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
            INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
            INNER JOIN plats ON plats.platsID=narvaro.platsID
            INNER JOIN foretag ON foretag.foretagID=plats.foretagID
            INNER JOIN elev ON elev.elevID=plats.elevID
            INNER JOIN dag ON perioddag.dagID=dag.dagID 
            WHERE elev.elevID='?' ORDER BY dag.datum";
        
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $elevID);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
    }

?>