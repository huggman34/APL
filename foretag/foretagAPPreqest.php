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
        if (isset($_GET['shicka'])) {
            $datum=strtotime($_GET['datum']);
            $idag=date("Y-m-d",$datum);
            $narvaro =narvaroForetag($conn, $_GET['username'],$idag);
            $narv['dagnarvaro'] = array();
            foreach ($narvaro as $varo) {
            
            array_push($narv['dagnarvaro'],$varo);
           
            }
            echo json_encode($narv);
        }
        
        if(isset($_GET['subit'])) {
            $login=foretagLogin($conn, $_GET['username'], $_GET['password']);
            $log['login'] = array();
            $arr= array('svar'=>$login);
            array_push($log['login'],$arr);
            echo json_encode($log);
        }
        if(isset($_GET['sub'])){
            updateElevNarvaroAPP($conn,$_GET['narvaro'],$_GET['narvaroID']);
            
        }
    ?>