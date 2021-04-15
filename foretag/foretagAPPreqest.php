<?php
/**
 * Det här filen inneholler alla app reqests.
 *
 */
    require_once "../connection.php";
    require_once "../LoginFunctions.php";
    require_once "../ViewFunctions.php";
    require_once "../RegisterFunctions.php";
    require_once "../UpdateFunctions.php";

    
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
            echo $login;
        }
        if(isset($_GET['sub'])){
            updateNarvaro($conn,$_GET['narvaroID'],$_GET['narvaro']);
        }
    ?>