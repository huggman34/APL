<?php
/**
 * I denna fil finns alla registrerings funktioner för att registrera företag, elev, narvaro, plats
 * samt period generation som skapar period, dagarna som är mellan periodens start och slutdatum.
 * Den kopplar även dagarna med perioden i perioddags tabellen.
 * Denna filen kommer att inkluderas i alla formulär filer som används för registrering.
 */
    function registerForetag($conn, $namn, $adress) {
        //Kollar om företag med samma namn finns i databasen
        $dupeCheck = "SELECT * FROM foretag WHERE namn = ?";
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("s", $namn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            //Registrerar företaget om det inte redans finns
            $stmt = $conn->prepare("INSERT INTO foretag (namn, adress)
            VALUES (?, ?)");
            $stmt->bind_param("ss", $namn, $adress);
            $stmt->execute();

            echo "$namn har registrerats.";

        } else {
            //Om företaget är redan registrerad så skrivs det ut
            $namnError = "$namn är redan registrerad";
            echo $namnError;
        }
    }

    function registerHandledare($conn, $foretagID, $fornamn, $efternamn, $epost, $telefon, $losenord) {
        //Kollar om handledare med samma förnamn och efternamn finns
        $dupeCheck = "SELECT * FROM handledare WHERE fornamn = ? AND efternamn = ?";
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("ss", $fornamn, $efternamn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        //Om handledaren inte finns
        if($result == 0) {
            //Hashar handledarens lösenord
            $hashed_losenord = password_hash($losenord, PASSWORD_DEFAULT);
            
            //Sätter in handledarens data i databasen
            $stmt = $conn->prepare("INSERT INTO handledare (foretagID, fornamn, efternamn, epost, telefon, losenord) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $foretagID, $fornamn, $efternamn, $epost, $telefon, $hashed_losenord);
            $stmt->execute();

            //Hämtar handledarens ID
            $last_id = mysqli_insert_id($conn);

            echo "$fornamn $efternamn är nu registrerad.";

            echo "$last_id";
            
        } else {
            //Skrivs ut om handledaren redan är registrerad
            $namnError = "$fornamn $efternamn är redan registrerad";
            echo $namnError;
        }
    }

    function registerElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon) {
        $fornamn = ucfirst($fornamn);
        $efternamn = ucfirst($efternamn);
        $elevID = ucwords("$fornamn.$efternamn", ".");
    
        //Kollar om elev med samma för och efternamn redan finns
        $dupeCheck = "SELECT * FROM elev WHERE fornamn = ? AND efternamn = ?";
    
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("ss", $fornamn, $efternamn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;
    
        //Om eleven inte finns
        if($result == 0) {
            //Sätts elevens data i databasen
            $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn, klass, epost, telefon) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $elevID, $fornamn, $efternamn, $klass, $epost, $telefon);
    
            if ($stmt->execute()){
                echo "$fornamn $efternamn har lagts till";
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
            
        } else {
            //Om elev/elever med samma namn och efternamn redan finns plusas antalet med 1
            $count = $result+1;
            
            //Siffran läggs till i slutet av elevID
            $dupeElevID = $elevID.$count;
    
            //Sätter elevens data och unika elevID i databasen
            $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn, klass, epost, telefon) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $dupeElevID, $fornamn, $efternamn, $klass, $epost, $telefon);
    
            if ($stmt->execute()){
                echo "Records added successfully.";
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
        }
    }

    function periodGeneration($conn,$periodNamn,$startdatum,$slutdatum,$dag) {
        $stmt = $conn->prepare("INSERT INTO period(periodNamn,startdatum,slutdatum) VALUES(?,?,?)");
        $stmt->bind_param("sss", $periodNamn, $startdatum, $slutdatum);

        if($stmt->execute()) {
            echo "$periodNamn perioden har skapats";
        } else {
            echo "Något gick fel";
        }
       
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

    function registerPlats($conn, $elevID, $periodNamn) {

        $dupeCheck = "SELECT * FROM plats WHERE elevID = ? AND periodNamn = ?";
    
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("ss", $elevID, $periodNamn);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            $stmt = $conn->prepare("INSERT INTO plats (periodNamn, elevID) VALUES (?, ?)");
            $stmt->bind_param("ss", $periodNamn, $elevID);
            
            if ($stmt->execute()) {
                echo "$elevID har lagts till ";

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
        //Kollar om klassen är redan registrerad
        $dupeCheck = "SELECT * FROM klass WHERE klass = ?";
    
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("s", $klass);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            //Om klassen inte finns registreras klassen
            $stmt = $conn->prepare("INSERT INTO klass (klass) VALUES (?)");
            $stmt->bind_param("s", $klass);

            if($stmt->execute()) {
                echo "Klassen $klass har registrerats. ";
            }
        }
    }
?>