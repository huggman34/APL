<?php 
/**
 * Denna fil inneholler alla funktioner som används för att redigera tabeller. 
 * Genom att referera till funktionen kan man uppdatera värdena för en rad i tabbelen baserat på dess ID.
 */
 
    function updatePeriod($conn,$newperiod,$startdatum,$slutdatum,$periodnamn,$dag) {

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
                $rw = $query->fetch_all(MYSQLI_ASSOC);

                if(!empty($rw)) {
                    foreach($rw as $rew){
                    $platsID=$rew['platsID'];
                    echo $platsID;
                    $sql="INSERT INTO narvaro(perioddagID,platsID) VALUES ('$periodDagID','$platsID')";
                    $conn->query($sql);
                    }
                }
                
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

    function updateElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon, $elevID) {
        //Skapar nytt elevID som består av för och efternamn separerade av en punkt
        $newElevID = ucwords("$fornamn.$efternamn", ".");
        //Tar bort siffror från gammla elevID
        $oldElevID = preg_replace('/\d/', '', $elevID);
        
        //Kollar om elev med samma för och efternamn redan finns
        $dupeCheck = "SELECT * FROM elev WHERE fornamn = ? AND efternamn = ?";
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("ss", $fornamn, $efternamn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        //Om nya elevID är samma som gammla, alltså om elevens för eller efternamn inte har ändrats
        if($newElevID === $oldElevID) {
            //Uppdatera elevens information förutom elevID
            $sql = "UPDATE elev SET fornamn = ?, efternamn = ?, klass = ?, epost = ?, telefon = ? WHERE elevID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $fornamn, $efternamn, $klass, $epost, $telefon, $elevID);

            if ($stmt->execute()) {
                echo "Eleven har uppdaterats";
                header('Location: adminMain.php');
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }

        //Om elevens för eller efternamn har ändrats, men de inte finns någon annan med samma för och efternamn
        } elseif ($result == 0) {
            //Uppdatera elevens info, även elevID
            $sql = "UPDATE elev SET elevID = ?, fornamn = ?, efternamn = ?, klass = ?, epost = ?, telefon = ? WHERE elevID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $newElevID, $fornamn, $efternamn, $klass, $epost, $telefon, $elevID);

            if ($stmt->execute()){
                echo "Eleven har uppdaterats";
                header('Location: adminMain.php');
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }

        //Om elevens för eller efternamn har ändrats, men de inte är unika
        } else {
            //Adderar 1 med antalet elever som har samma för och efternamn
            $count = $result+1;
            //Skapar unik elevID med att lägga till siffran i slutet av det nya elevID
            $dupeElevID = $newElevID.$count;

            //Uppdatera all elevens info, även elevID
            $sql = "UPDATE elev SET elevID = ?, fornamn = ?, efternamn = ?, klass = ?, epost = ?, telefon = ? WHERE elevID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $dupeElevID, $fornamn, $efternamn, $klass, $epost, $telefon, $elevID);

            if ($stmt->execute()){
                echo "Eleven har uppdaterats";
                header('Location: adminMain.php');
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
        }
    }

    function updateElevNarvaro($conn, $narvaro, $narvaroID){
        $sql = "UPDATE narvaro SET narvaro = ? WHERE narvaroID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $narvaro, $narvaroID);

        if ($stmt->execute()){
            $elevID = $conn->query("SELECT plats.elevID FROM narvaro INNER JOIN plats ON plats.platsID = narvaro.platsID WHERE narvaro.narvaroID = $narvaroID")->fetch_object()->elevID;
            echo $elevID;

        } else {
            return "Error"; 
        }
    }

    function updateElevNarvaroAPP($conn, $narvaro, $narvaroID){
        $sql = "UPDATE narvaro SET narvaro = ? WHERE narvaroID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $narvaro, $narvaroID);

        if ($stmt->execute()){
            echo "Elev Narvaro updated";
        } else {
            return "Error"; 
        }
    }

    function updateHandledare($conn, $fornamn, $efternamn, $foretagID, $epost, $telefon, $handledarID){
        $sql = "UPDATE handledare SET fornamn = ?, efternamn = ?, foretagID = ?, epost = ?, telefon = ? WHERE handledarID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissi", $fornamn, $efternamn, $foretagID, $epost, $telefon, $handledarID);

        if ($stmt->execute()){
            echo "Handledare updated";
            header('Location: adminMain.php');
        } else {
            return "Error"; 
        }
    }

    function updatePlatsHand($conn,$handledarID,$platsID){
        
        $sql= "SELECT * FROM handledare WHERE handledarID='$handledarID'";
        $result = mysqli_query($conn, $sql);
        $data =  $result->fetch_assoc();
        $foretagID=$data['foretagID'];

        $sql = "UPDATE plats SET foretagID=?, handledarID=? WHERE platsID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii",$foretagID,$handledarID,$platsID);
        $stmt->execute();
    }

    function updatePlats($conn, $platsID, $handledarID, $periodNamn) {
            
        $sql= "SELECT * FROM handledare WHERE handledarID='$handledarID'";
        $result = mysqli_query($conn, $sql);
        $data =  $result->fetch_assoc();
        $foretagID=$data['foretagID'];

        $sql = "UPDATE plats SET periodNamn=?, foretagID=?, handledarID=? WHERE platsID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siii",$periodNamn, $foretagID, $handledarID, $platsID);
        
        if($stmt->execute()) {
            echo "Records added successfully.";
            echo $foretagID;
        }

        $sql="DELETE FROM narvaro WHERE platsID='$platsID' AND narvaro IS NULL";
        $conn->query($sql);

        
        $sql2 = "SELECT perioddag.perioddagID FROM perioddag
        WHERE perioddag.periodNamn = ?
        ORDER BY perioddag.perioddagID ASC";

        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("s", $periodNamn);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        $periodDag = array_column($data, 'perioddagID');
            
        //Sätter in perioddagar i närvaro tabellen
        foreach ($periodDag as $pDag) {

            $sql= "SELECT * FROM narvaro WHERE perioddagID='$pDag' AND platsID='$platsID'";
            $result = mysqli_query($conn, $sql);
            $row =  $result->fetch_assoc();
            echo $row['perioddagID'];
            
            if (empty($row)) {
                mysqli_query($conn, "INSERT INTO narvaro (platsID, perioddagID)
                VALUES ('$platsID', '$pDag')");
            }          
        }
    }
?>