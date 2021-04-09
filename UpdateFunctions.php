<?php 

/**
 * Denna fil inneholler alla funktioner som används för att redigera tabeller. 
 * Genom att referera till funktionen kan man uppdatera värdena för en rad i tabbelen baserat på dess ID.
 */
 
function updatePeriod($conn,$newperiod,$startdatum,$slutdatum,$periodnamn,$dag){
        $sql = "UPDATE period SET periodNamn=?, startdatum=?, slutdatum=? WHERE periodNamn=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss",$newperiod,$startdatum,$slutdatum,$periodnamn);
        $stmt->execute();


    foreach ($dag as $datum) {

        $sql="SELECT dag.datum,perioddag.perioddagID FROM perioddag INNER JOIN dag ON perioddag.dagID=dag.dagID WHERE perioddag.periodNamn='$newperiod' AND dag.datum='$datum'";
        $query = $conn->query($sql);
        $result = $query->fetch_assoc(); 
        
        if (empty($result)) {
            
        $sql="SELECT * FROM dag WHERE datum='$datum'";
        $query = $conn->query($sql);
        $resultat = $query->fetch_assoc();

        if (empty($resultat)) {
            $sql = "INSERT INTO dag(datum) VALUES('$datum')";
            $conn->query($sql);
        }
           $sql="INSERT INTO perioddag(dagID,periodNamn) SELECT dag.dagID,period.periodNamn FROM dag, period WHERE period.periodNamn='$newperiod' AND dag.datum='$datum'";
           $conn->query($sql);
           $sql="SELECT perioddag.perioddagID FROM perioddag INNER JOIN dag ON perioddag.dagID=dag.dagID WHERE perioddag.periodNamn='$newperiod' AND dag.datum='$datum'";
           $query = $conn->query($sql);
           $row = $query->fetch_assoc();
            
           $periodDagID=$row['perioddagID'];

           $sql="SELECT platsID FROM plats WHERE periodNamn='$newperiod'";
           $query = $conn->query($sql);
           $rw = $query->fetch_assoc();

           $platsID=$rw['platsID'];

           $sql="INSERT INTO narvaro(perioddagID,platsID) VALUES ('$periodDagID','$platsID')";
           $query = $conn->query($sql);
        }else{
            $sql="SELECT perioddag.perioddagID,dag.datum FROM perioddag INNER JOIN dag ON perioddag.dagID=dag.dagID WHERE perioddag.periodNamn='$newperiod'";
            $query = $conn->query($sql);
            $data = $query->fetch_all(MYSQLI_ASSOC);
            foreach ($data as $row) {
                if (!($row['datum']==$datum)) {
                    $perioddagID=$row['perioddagID'];
                    $sql="DELETE FROM perioddag WHERE perioddagID='$perioddagID'";
                    $conn->query($sql);
                }
            }
    }
    }

}

function updateForetag($conn, $namn, $adress, $foretagsID){
    $sql = "UPDATE foretag SET namn=?, adress=? WHERE foretagID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $namn, $adress, $foretagsID);

    if ($stmt->execute()){
        echo "foretag updated";
        header('Location: adminMain.php');
    }else{
       return "Error"; 
    }
}

function updateKlass($conn, $nyKlass, $klassID){
    $sql = "UPDATE klass SET klass = ? WHERE klass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nyKlass, $klassID);

    if ($stmt->execute()){
        echo "klass updated";
        header('Location: adminMain.php');
    }else{
       return "Error"; 
    }
}

function updateDag($conn,$datum,$dagID){
        $sql = "UPDATE dag SET datum=? WHERE dagID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di",$datum,$dagID);
    
            
    if ($stmt->execute()){

    }else{
           return "Error"; 
    }
}

function updateElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon, $elevID){
        $sql = "UPDATE elev SET fornamn = ?, efternamn = ?, klass = ?, epost = ?, telefon = ? WHERE elevID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fornamn, $efternamn, $klass, $epost, $telefon, $elevID);

    if ($stmt->execute()){
        echo "elev updated";
        header('Location: adminMain.php');
    } else{
        return "Error"; 
    }
}

function updatePeriodDag($conn,$periodNamn,$dagID,$perioddagID){
        $sql = "UPDATE perioddag SET periodNamn=?, dagID=? WHERE periodDagID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii",$periodNamn,$dagID,$perioddagID);
    
            
    if ($stmt->execute()){
            return "";
    }else{
           return "Error"; 
    }
}

function updatePlats($conn,$periodNamn,$elevID,$foretagID){

    $sql = "SELECT platsID FROM plats
    WHERE elevID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $elevID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if(empty($row)){
        return "tom";
    }else{
        
        $sql = "UPDATE plats SET periodNamn=?, elevID=?, foretagID=? WHERE platsID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii",$periodNamn,$elevID,$foretagID,$row['platsID']);
    
            
    if ($stmt->execute()){
return "ech";
    }else{
           return "Error"; 
    }}
}

?>