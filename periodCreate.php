<?php
include_once "connection.php";
session_start();
$username=$_SESSION['username'];


 echo'

 <form action="functin.php" method="post">
 <input type="text" name="periodnamn">
 <input type="date" name="startdatum">
 <input type="date" name="slutdatum">
 <input type="submit" value="submit" name="submin">
 </form>';
//select form som används för att välja period
    echo'<form action="functin.php" method="post">
    <select name="period">';
    $sql="SELECT * FROM period";
            $resultt = $conn->query($sql);
            while ($row = $resultt->fetch_assoc()) {
                $period=$row['namn'];
                echo"<option value='$period'>$period</option>";
            }
    echo '</select>
    <input type="submit" value="ta reda på" name="taredapå">
    </form>';
   
 if(isset($_POST['submit'])){
     $fornamn=$_POST['förnamn'];
     $efternamn=$_POST['efternamn'];
     elevRegistreing($conn,$fornamn,$efternamn);

 }
 if (isset($_POST['submin'])) {
     periodgeneration($conn,$_POST['periodnamn'],$_POST['startdatum'],$_POST['slutdatum']);
 }
  
 }
 // skapar perioder och dagar baserar deras periodens start och slutdatum och skapar period dagar så länge dem är inom  
 function periodgeneration($conn,$periodNamn,$startdatum,$slutdatum){
     $sql="INSERT INTO period(namn,startdatum,slutdatum) VALUES('$periodNamn','$startdatum','$slutdatum')";
     $conn->query($sql);

     $start=strtotime($startdatum);
     $slut=strtotime("+1 day",$slutdatum);
     $dagar=ceil(($slut-$start)/60/60/24);
     
     for ($i=0; $i < $dagar; $i++) { 
        
        $gto=strtotime("+$i days",$start);
        $datum=date('Y-m-d',$gto);
        if (("Saturday"==date("l",$gto)) || ("Sunday"==date("l",$gto))) {
            echo "no";
        }else{
        $sql="SELECT * FROM dag WHERE datum='$datum'";
        $query = $conn->query($sql);
        $resultat = $query->fetch_assoc();
        if (empty($resultat)) {
        $sql = "INSERT INTO dag(datum) VALUES('$datum')";
        $conn->query($sql);
        }
        }
     }
    
     $sql="INSERT INTO perioddag(dagID,periodID) SELECT dag.dagID,period.periodID FROM dag, period WHERE period.namn='$periodNamn' AND dag.datum>=period.startdatum AND dag.datum<=period.slutdatum";
     $conn->query($sql);
    

 }
 function deletePeriod($conn){
    $sql = "DELETE FROM  WHERE dagID = '$id'";
}
 if(isset($_POST['taredapå'])){
     $periodNamn=$_POST['period'];
    $sql = "SELECT narvaro.narvaro, dag.datum, elev.fornamn, period.namn, foretag.namn FROM narvaro
    INNER JOIN plats ON narvaro.platsID = plats.platsID
    INNER JOIN elev ON plats.elevID = elev.elevID
    INNER JOIN perioddag ON perioddag.periodDagID = narvaro.periodDagID
    INNER JOIN period ON period.periodID = perioddag.periodID
    INNER JOIN dag ON perioddag.dagID = dag.dagID
    INNER JOIN foretag ON foretag.foretagsID = plats.foretagsID
    WHERE period.namn = '$periodNamn' AND period.periodID=plats.periodID
    ORDER BY elev.elevID";
 }else{
    $sql = "SELECT narvaro.narvaro, dag.datum, elev.fornamn, period.namn, foretag.namn FROM narvaro
    INNER JOIN plats ON narvaro.platsID = plats.platsID
    INNER JOIN elev ON plats.elevID = elev.elevID
    INNER JOIN perioddag ON perioddag.periodDagID = narvaro.periodDagID
    INNER JOIN period ON period.periodID = perioddag.periodID
    INNER JOIN dag ON perioddag.dagID = dag.dagID
    INNER JOIN foretag ON foretag.foretagsID = plats.foretagsID
    WHERE period.periodID=plats.periodID
    ORDER BY elev.elevID";
 } 
    $sqldata = mysqli_query($conn, $sql) or die("error");
if (!($sqldata=="error")) {
    
    echo "<table>";
    echo "<tr><th>Närvaro</th><th>Dag</th><th>Elev</th><th>företag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        switch ($row['narvaro']) {
            case 1:
                echo"närvarande";
            break;
             case 2:
                echo"frånvarande";
            break;
            case 3:
                echo"giltigt frånvarande";
            break;
            
        }
        
        echo "</td><td>";
        echo $row['datum'];
        echo "</td><td>";
        echo $row['fornamn'];
        echo "</td><td>";
        echo $row['namn'];
        echo "</td></tr>";
    }
    echo "</table>";
}

 ?>