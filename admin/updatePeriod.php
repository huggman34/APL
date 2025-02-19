<?php
/**
 * Denna fil används för att uppdatera periodtabellen. 
 * När man klickar på en period för att uppdatera den så skickar den med periodID för att man enkelt ska kunna välja vad man vill uppdatera.
 * Sedan väljer man start och slutdatum och kryssar i dagarna som man vill ska vara med i perioden.
 */
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    require_once '../ViewFunctions.php';
    require_once '../UpdateFunctions.php';
      
    if (isset($_POST['Uperiodnamn'])) {
        $periodNamn=$_POST['Uperiodnamn'];
        $startdatum=$_POST['Ustartdatum'];
        $slutdatum=$_POST['Uslutdatum'];
    }
    if (isset($_POST['periodnamn'])) {
        $periodNamn=$_POST['periodID'];
        $startdatum=$_POST['startdatum'];
        $slutdatum=$_POST['slutdatum'];
    }

    if (isset($_POST['submin'])) {
        updatePeriod($conn,$_POST['periodnamn'],$startdatum,$slutdatum,$_POST['periodID'],$_POST['periodDag']);
    } else {
         
        echo "<table class='UdagTable'>";
        echo "<thead><tr><th>Vecka</th><th>Dag</th><th>Datum</th><th></th></tr></thead><tbody>";
        $start=strtotime($startdatum);
        $slut=strtotime($slutdatum);
        $dagar=ceil(($slut-$start)/60/60/24);
        
        for ($i=0; $i < $dagar+1; $i++) {

            $gto=strtotime("+$i days",$start);
            $datum=date('Y-m-d',$gto);


            echo "<tr><td>";
            echo date('W',$gto);
            echo "</td><td>";
            echo date('l',$gto);
            echo "</td><td>";
            echo $datum;
            echo "</td><td>";
            if (!empty(periodDag($conn,$periodNamn,$datum))) {
            echo"<input id='UperiodDag' type='checkbox' name='UperiodDag' value='$datum' checked>";

            } else {
            echo"<input id='UperiodDag' type='checkbox' name='UperiodDag' value='$datum'>";
            }
            echo"</td></tr>";
        }

       echo "</tbody></table>";
    }
?>