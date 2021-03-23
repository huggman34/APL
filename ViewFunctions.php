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

    function elevKlass($conn, $klass) {
        $sql = "SELECT elev.elevID
        FROM elev
        WHERE elev.klass = ?
        ORDER BY elevID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $klass);
        $stmt->execute();
        $result = $stmt->get_result();
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

?>