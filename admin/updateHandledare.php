<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['handledarID'], $_POST['fornamn'], $_POST['efternamn'], $_POST['foretag'], $_POST['epost'], $_POST['telefon'])) {
        $handledarID = $_POST['handledarID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $foretag = $_POST['foretag'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];

        $sql = "SELECT foretagID FROM foretag WHERE namn = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $foretag);
        $stmt->execute();
        $result = $stmt->get_result();
        $value = $result->fetch_object();

        $arr = (array) $value;
        
        if(!empty($arr)) {
            $foretagID = $arr['foretagID'];
            updateHandledare($conn, $fornamn, $efternamn, $foretagID, $epost, $telefon, $handledarID);
        } else {
            echo "Företaget som angavs finns inte";
        }
    }
?>