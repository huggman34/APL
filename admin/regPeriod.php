<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
   
    if (isset($_POST['periodnamn'])) {
        $periodNamn=$_POST['periodnamn'];
        $startdatum=$_POST['startdatum'];
        $slutdatum=$_POST['slutdatum'];
    }

 //if (isset($_POST['submin'])) {
    
    
        if (isset($_POST['submin'])) {
            periodGeneration($conn,$_POST['periodnamn'],$startdatum,$slutdatum,$_POST['periodDag']);
        }else{
            
        //echo $periodNamn;
        echo "<table class='dagTable'>";
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
           if (("Saturday"==date("l",$gto)) || ("Sunday"==date("l",$gto))) {
            echo"<input id='periodDag' type='checkbox' name='periodDag' value='$datum'>";
        }else {
            echo"<input id='periodDag' type='checkbox' name='periodDag' value='$datum' checked>";
        }
           echo"</td></tr>";
       }
       
       //echo'<input type="submit" value="submit" id="submin">';
       echo "</tbody></table>";
     
    /*echo"<form method='post'>
    <input type='submit' name='submit' value='börja om'>
    </form>";*/
    }
    

    /*if(isset($_POST['periodnamn'], $_POST['slutdatum'], $_POST['startdatum'],$_POST['perioddag'])) {
        $periodNamn = $_POST['periodnamn'];
        $slutdatum = $_POST['slutdatum'];
        $startdatum = $_POST['startdatum'];
        $periodDag = $_POST['perioddag'];
     onclick=\"return confirm('Är du säker?');\"
        periodGeneration($conn, $periodNamn, $startdatum, $slutdatum, $periodDag);
    }*/
?>