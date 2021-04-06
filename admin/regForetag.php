<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    
    if(isset($_POST['namn'], $_POST['fornamn'], $_POST['efternamn'], $_POST['epost'], $_POST['telefon'])) {
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];
        $foretag = $_POST['namn'];

        $dupeCheck = "SELECT * FROM foretag WHERE namn = ?";
        $stmt = $conn->prepare($dupeCheck);
        $stmt->bind_param("s", $foretag);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        if($result == 0) {
            if(isset($_POST['losenord'], $_POST['adress'])) {
                $losenord = $_POST['losenord'];
                $adress = $_POST['adress'];
    
                $lastID = registerForetag($conn, $foretag, $losenord, $adress);
                registerHandledare($conn, $fornamn, $efternamn, $lastID, $epost, $telefon);
            }
            
        } else {
            $sql="SELECT foretagID FROM foretag WHERE namn='$foretag'";
            $query = $conn->query($sql);
            $resultat = $query->fetch_assoc();

            $sql = "SELECT foretagID FROM foretag WHERE namn = ? limit 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $foretag);
            $stmt->execute();
            $result = $stmt->get_result();
            $value = $result->fetch_object();

            $foretagID = $value->foretagID;

            registerHandledare($conn, $fornamn, $efternamn, $foretagID, $epost, $telefon);
        }
    }
?>