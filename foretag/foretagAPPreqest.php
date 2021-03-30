<?php
/**
 * Det här filen inneholler alla app reqests.
 *
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
            registerNarvaro($conn,$_GET['perioddag'],$_GET['elevID'],$_GET['narvaro']);
        }
    ?>