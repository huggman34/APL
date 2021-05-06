<?php
/**
 * Denna filen inkluderar alla select funktioner som behövs för att hämta data från databasen.
 * Filen kommer att inkluderas i alla filer som behöver tillgång till dessa funktioner.
 */

    /** Väljer relevant närvaro data som tillhör dagens datum */
    function narvaroIdag($conn) {
        $sql = "SELECT narvaroID, plats.elevID, foretag.namn, plats.periodNamn, dag.datum, narvaro.narvaro
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
    
    /**Väljer alla rader i närvaro tabellen där dagens datum är och där handledarens epost som matas in finns */
    function narvaroIdagForetag($conn,$foretag) {
        $sql = "SELECT narvaro.narvaroID,plats.elevID, plats.periodNamn, narvaro.narvaro,plats.platsID,perioddag.perioddagID
        FROM narvaro
        INNER JOIN plats ON plats.platsID = narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        INNER JOIN handledare ON handledare.handledarID = plats.handledarID
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN dag ON dag.dagID = perioddag.dagID
        WHERE dag.datum = CURRENT_DATE AND handledare.epost=? ORDER BY narvaro.narvaro";
      
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $foretag);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** 
     * Väljer alla rader i närvaro tabellen där datumet som skickas
     * in finns och där handledarens epost som matas in finns 
     */
    function narvaroForetag($conn,$foretag,$dag) {
        $sql = "SELECT narvaro.narvaroID,plats.elevID, plats.periodNamn, narvaro.narvaro,plats.platsID,perioddag.perioddagID
        FROM narvaro
        INNER JOIN plats ON plats.platsID = narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        INNER JOIN handledare ON handledare.handledarID = plats.handledarID
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN dag ON dag.dagID = perioddag.dagID
        WHERE dag.datum = ? AND handledare.epost=? ORDER BY narvaro.narvaro";
      
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$dag, $foretag);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    /** Väljer elev, handledare, företag och period från plats tabellen. */
    function elevPlats($conn) {
        $sql = "SELECT handledare.fornamn, handledare.efternamn, plats.handledarID, plats.foretagID,plats.periodNamn,plats.platsID, plats.elevID, foretag.namn
        FROM plats
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        INNER JOIN handledare ON handledare.handledarID=plats.handledarID
        ORDER BY elevID ASC";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer all närvaro som tillhör en period. */
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

    /** Väljer alla distinkta perioder en gång i närvaro tabellen */
    function period($conn) {
        $sql = "SELECT DISTINCT perioddag.periodNamn
        FROM narvaro
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer all data i period tabellen */
    function allPeriod($conn) {
        $sql = "SELECT * FROM period";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer alla distinkta klasser ifrån select satsen som väljer data ifrån elev tabellen */
    function klass($conn) {
        $sql = "SELECT distinct klass 
        FROM
        (SELECT elev.elevID, elev.fornamn, elev.efternamn, klass.klass, elev.epost, elev.telefon
        FROM elev
        INNER JOIN klass ON klass.klass = elev.klass) T";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer alla klasser från klass tabellen */
    function allKlass($conn) {
        $sql = "SELECT * FROM klass";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer alla företag från företag tabellen */
    function foretag($conn){
        $sql= "SELECT * FROM foretag";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer alla elever */
    function allElev($conn){
        $sql= "SELECT * FROM elev ORDER BY klass";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer all data i handledare tabllen */
    function allHandledare($conn) {
        $sql = "SELECT handledarID, fornamn, efternamn, epost, telefon, namn, handledare.foretagID FROM handledare
        INNER JOIN foretag ON foretag.foretagID = handledare.foretagID
        ORDER BY fornamn ASC";

        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    /** Väljer elever utifrån klassen som matas in, om ingen klass matas in väljer den alla elever. */
    function elev($conn, $klass) {
        if(empty($klass)) {
            $sql = "SELECT elev.elevID, elev.fornamn, elev.efternamn, klass.klass, elev.epost, elev.telefon
            FROM elev
            INNER JOIN klass ON klass.klass = elev.klass";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);

            return $data;

        } else {
            $sql = "SELECT elev.elevID, elev.fornamn, elev.efternamn, klass.klass, elev.epost, elev.telefon
            FROM elev
            INNER JOIN klass ON klass.klass = elev.klass
            WHERE klass.klass = ?";
    
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $klass);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
    
            return $data;
        }
    }

    /** Väljer alla periodagar som är kopplade till perioden och dagen som matas in. */
    function periodDag($conn,$period,$dag){
        $sql= "SELECT * FROM perioddag
        INNER JOIN dag ON dag.dagID=perioddag.dagID
        WHERE perioddag.periodNamn='$period' AND dag.datum='$dag'";

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

    /** Väljer all närvaro som tillhör en elev när elevens ID matas in. */
    function elevNarvaro($conn, $elevID){
        $sql = "SELECT narvaroID, foretag.namn, elev.elevID, narvaro.narvaro, dag.datum FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
        INNER JOIN plats ON plats.platsID = narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        INNER JOIN elev ON elev.elevID = plats.elevID
        INNER JOIN dag ON perioddag.dagID = dag.dagID 
        WHERE elev.elevID = ? ORDER BY dag.datum";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $elevID);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }
?>