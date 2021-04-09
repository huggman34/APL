<?php
/**
 * I denna fil finns alla registrerings funktioner för att registrera företag, elev, narvaro, plats
 * samt period generation som skapar period, dagarna som är mellan periodens start och slutdatum.
 * Den kopplar även dagarna med perioden i perioddags tabellen.
 * Denna filen kommer att inkluderas i alla formulär filer som används för registrering.
 */
    function registerForetag2($conn, $namn, $losenord, $adress) {

        $dupeCheck = "SELECT * FROM foretag WHERE namn = ?";
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("s", $namn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            $hashed_losenord = password_hash($losenord, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO foretag (namn, losenord, adress)
            VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $namn, $hashed_losenord, $adress);

            if ($stmt->execute()){
                echo "Records added successfully.";
                $lastID = $conn->insert_id;
                return $lastID;
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
        } else {
            $namnError = "Företaget är redan registrerad";

            echo $namnError;
        }
    }

    function registerForetag($conn, $namn, $adress) {

        $dupeCheck = "SELECT * FROM foretag WHERE namn = ?";
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("s", $namn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            $stmt = $conn->prepare("INSERT INTO foretag (namn, adress)
            VALUES (?, ?)");
            $stmt->bind_param("ss", $namn, $adress);
            $stmt->execute();

            echo "Records added successfully.";

        } else {
            $namnError = "Företaget är redan registrerad";
            echo $namnError;
        }
    }

    function registerHandledare($conn, $foretagID, $fornamn, $efternamn, $epost, $telefon, $losenord) {

        $dupeCheck = "SELECT * FROM handledare WHERE fornamn = ? AND efternamn = ?";
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("ss", $fornamn, $efternamn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            
            $hashed_losenord = password_hash($losenord, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO handledare (foretagID, fornamn, efternamn, epost, telefon, losenord) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $foretagID, $fornamn, $efternamn, $epost, $telefon, $hashed_losenord);
            $stmt->execute();

            echo "Records added successfully.";
            
        } else {
            $namnError = "Handledare är redan registrerad";

            echo $namnError;
        }
    }

    function registerElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon) {
        $fornamn = ucfirst($fornamn);
        $efternamn = ucfirst($efternamn);
        $elevID = ucwords("$fornamn.$efternamn", ".");
    
        $dupeCheck = "SELECT * FROM elev WHERE fornamn = ? AND efternamn = ?";
    
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("ss", $fornamn, $efternamn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;
    
        if($result == 0) {
            $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn, klass, epost, telefon) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $elevID, $fornamn, $efternamn, $klass, $epost, $telefon);
    
            if ($stmt->execute()){
                return $elevID;
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
            
        } else {
            $count = $result+1;
            $dupeElevID = $elevID.$count;
    
            $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn, klass, epost, telefon) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $dupeElevID, $fornamn, $efternamn, $klass, $epost, $telefon);
    
            if ($stmt->execute()){
                echo "Records added successfully.";
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
        }
    }

    function registerAdmin($conn, $namn, $losenord) {
        $hashed_losenord = password_hash($losenord, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admin (anvnamn, losenord)
        VALUES (?, ?)");
        $stmt->bind_param("ss", $namn, $hashed_losenord);

        if ($stmt->execute()){
            echo "Records added successfully.";
        } else{
            echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
        }
    }

    function registerNarvaro($conn, $periodDagID,$platsID, $narvaro) {
        /*
        $result = $elevID;

        $result_explode = explode('|', $result);
        
        $platsID = $result_explode[0];
        $periodDagID = $result_explode[1];
        $narvaro = $_POST['narvaro'];

        $dupeCheck = mysqli_query($conn ,"SELECT * FROM narvaro WHERE (platsID = '$platsID' AND periodDagID = '$periodDagID')");

        $result = $dupeCheck->num_rows;

        if($result == 0) {
            $stmt = $conn->prepare("INSERT INTO narvaro (platsID, periodDagID, narvaro) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $platsID, $periodDagID, $narvaro);

            if ($stmt->execute()) {
                echo "Närvaro har lagts till";
            } else {
                echo "Något gick fel";
            }
        } else {
            echo "Eleven har redan registrerats närvaro";
        }

        $result = $elevID;

        $result_explode = explode('|', $result);
        
        $platsID = $result_explode[0];
        $periodDagID = $result_explode[1];*/
        //$narvaro = $_GET['narvaro'];

        $stmt = $conn->prepare("UPDATE narvaro SET narvaro = ? WHERE platsID = ? AND periodDagID = ?");
        $stmt->bind_param("iii", $narvaro, $platsID, $periodDagID);

        if ($stmt->execute()) {
            echo "Närvaro har lagts till";
        } else {
            echo "Något gick fel";
        }
    }

    function periodGeneration($conn,$periodNamn,$startdatum,$slutdatum,$dag) {
        $stmt = $conn->prepare("INSERT INTO period(periodNamn,startdatum,slutdatum) VALUES(?,?,?)");
        $stmt->bind_param("sss", $periodNamn, $startdatum, $slutdatum);
        $stmt->execute();
       
        foreach ($dag as $datum) { 
           
                $sql="SELECT * FROM dag WHERE datum='$datum'";
                $query = $conn->query($sql);
                $resultat = $query->fetch_assoc();
                    
                if (empty($resultat)) {
                $sql = "INSERT INTO dag(datum) VALUES('$datum')";
                $conn->query($sql);
                }
                $sql="INSERT INTO perioddag(dagID,periodNamn) SELECT dag.dagID,period.periodNamn FROM dag, period WHERE period.periodNamn='$periodNamn' AND dag.datum='$datum'";
                $conn->query($sql);
            }
        
       
        
    }

    function registerPlats($conn, $elevID, $periodNamn, $foretagID) {

        $dupeCheck = "SELECT * FROM plats WHERE elevID = ?";
    
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("s", $elevID);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            $stmt = $conn->prepare("INSERT INTO plats (periodNamn, foretagID, elevID) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $periodNamn, $foretagID, $elevID);
            
            if ($stmt->execute()) {
                echo "Plats har lagts till";

                $sql = "SELECT platsID, periodNamn FROM plats WHERE periodNamn IS NOT NULL ORDER BY platsID DESC LIMIT 1";
                $result = $conn->query($sql) or die($conn->error);
                $row = $result->fetch_assoc();

                $lastPlatsID = $row['platsID'];

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
                    mysqli_query($conn, "INSERT INTO narvaro (platsID, perioddagID)
                    VALUES ('$lastPlatsID', '$pDag')");
                }

            } else {
                echo "Något gick fel";
            }
        } else {
            echo "Eleven har redan en plats";
        }
    }

    function registerKlass($conn, $klass) {
        $dupeCheck = "SELECT * FROM klass WHERE klass = ?";
    
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("s", $klass);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            $stmt = $conn->prepare("INSERT INTO klass (klass) VALUES (?)");
            $stmt->bind_param("s", $klass);

            if($stmt->execute()) {
                echo "Klassen har lagts till";
            }
        } else {
            echo "Klassen är redan registrerad";
        }
    }
?>