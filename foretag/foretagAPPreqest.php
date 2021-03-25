<?php
/**
 * Detta är en inloggnings formulär för att logga in som företag, datan skickas
 * till 'LoginFunctions.php' där den granskas för att se om inloggnings uppgifter är korrekt eller ej
 */
    require_once "../connection.php";
    require_once "../LoginFunctions.php";
    require_once "../ViewFunctions.php";
    require_once "../RegisterFunctions.php";

    
        if(isset($_GET['submit'])) {
            $narvaro =narvaroIdagForetag($conn, $_GET['username']);
            $narv['dagnarvaro'] = array();
            foreach ($narvaro as $varo) {
            
           
            array_push($narv['dagnarvaro'],$varo);
           
            }
            echo json_encode($narv);
        }
        
        if(isset($_GET['subit'])) {
            $login=foretagLogin($conn, $_GET['username'], $_GET['password']);
            echo json_encode($login);
        }
        if(isset($_GET['sub'])){
            registerNarvaro($conn,$_GET['elevID'],$_GET['narvaro']);
        }
    ?>