<?php
/**
 * I denna fil finns alla registrerings funktioner för att registrera företag, elev och narvaro.
 * Denna filen kommer att inkluderas i alla formulär filer som används för registrering.
 */
    function registerForetag($conn, $foretagNamn, $losenord, $epost, $telefon) {

        $stmt = $conn->prepare("INSERT INTO foretag (namn, losenord, epost, telefon)
        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $foretagNamn, $losenord, $epost, $telefon);

        if ($stmt->execute()){
            echo "Records added successfully.";
        } else{
            echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
        }
    }

    function registerElev($conn, $fornamn, $efternamn) {
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
            $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $elevID, $fornamn, $efternamn);
    
            if ($stmt->execute()){
                echo "Records added successfully.";
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
            
        } else {
            $count = $result+1;
            $dupeElevID = $elevID.$count;
    
            $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $dupeElevID, $fornamn, $efternamn);
    
            if ($stmt->execute()){
                echo "Records added successfully.";
            } else{
                echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
            }
        }
    }

    function registerNarvaro($conn, $elevID, $narvaro) {
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
    }

    function periodGeneration($conn,$periodNamn,$startdatum,$slutdatum) {
        $sql="INSERT INTO period(periodNamn,startdatum,slutdatum) VALUES('$periodNamn','$startdatum','$slutdatum')";
        $conn->query($sql);
   
        $start=strtotime($startdatum);
        $slut=strtotime($slutdatum);
        $dagar=ceil(($slut-$start)/60/60/24);
        
        for ($i=0; $i < $dagar; $i++) { 
           
           $gto=strtotime("+$i days",$start);
           $datum=date('Y-m-d',$gto);
           if (("Saturday"==date("l",$gto)) || ("Sunday"==date("l",$gto))) {
               
           }else {
                $sql="SELECT * FROM dag WHERE datum='$datum'";
                $query = $conn->query($sql);
                $resultat = $query->fetch_assoc();
                    
                if (empty($resultat)) {
                $sql = "INSERT INTO dag(datum) VALUES('$datum')";
                $conn->query($sql);
                }
            }
        }
       
        $sql="INSERT INTO perioddag(dagID,periodNamn) SELECT dag.dagID,period.periodNamn FROM dag, period WHERE period.periodNamn='$periodNamn' AND dag.datum>=period.startdatum AND dag.datum<=period.slutdatum";
        $conn->query($sql);
   
    }
?>