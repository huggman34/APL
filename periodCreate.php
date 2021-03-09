<?php
/** 
 *  beskrivning 
I den här filen lägger man till perioder tilsammans med dagar och period dagar.
Man kan också välja bort dem dagar som man inte ska ha med i en period som låv dagar och annat. 

Todo
prepared statements på sql statements 
*/

include_once "connection.php";
session_start();
//$username=$_SESSION['username'];


 echo'
 <form action="periodCreate.php" method="post">
 <input type="text" name="periodnamn" requierd>
 <input type="date" name="startdatum">
 <input type="date" name="slutdatum">
 <input type="submit" value="submit" name="submin">
 </form>';

 if (isset($_POST['submin'])) {
    if ($_POST['submin']=="ta bort dagar") {
        $periodD=$_POST['periodDag'];
        $peroidN=$_POST['periodnamn'];
        foreach($periodD as $perioddag){
        $sql = "DELETE FROM perioddag WHERE perioddagID IN(SELECT perioddag.perioddagID FROM perioddag INNER JOIN dag ON dag.dagID=perioddag.dagID INNER JOIN period ON period.periodNamn=perioddag.periodNamn WHERE dag.datum='$perioddag' AND period.periodNamn='$peroidN')";
        $conn->query($sql);
    }
    }else{
        periodgeneration($conn,$_POST['periodnamn'],$_POST['startdatum'],$_POST['slutdatum']);
    }
    if (isset($_POST['periodnamn'])) {
        $periodNamn=$_POST['periodnamn'];
    }
   
     $sql = "SELECT dag.datum, period.periodNamn FROM period
    INNER JOIN perioddag ON period.periodNamn = perioddag.periodNamn
    INNER JOIN dag ON perioddag.dagID = dag.dagID
    WHERE period.periodNamn = '$periodNamn'
    ORDER BY dag.datum";
    $sqldata = mysqli_query($conn, $sql) or die("error");
        
        echo "<table>";
        echo "<tr><th>Dag</th><th>Period</th></tr>
        <form action='periodCreate.php' method='post'>";
        while($row = mysqli_fetch_assoc($sqldata)) {

            $dag=$row['datum'];
            echo "<tr>";
            echo "<td>";
            echo $row['datum'];
            echo "</td><td>";
            echo $row['periodNamn'];
            echo "</td><td>
            <input type='checkbox' name='periodDag[]' value='$dag'>
            </td></tr>";
        }
        
        echo"<input type='hidden' name='periodnamn' value='$periodNamn'>
        <input type='submit' name='submin' value='ta bort dagar'>
        </form>";
        echo "</table>";
        
 }
  
 
 /* beskrivning: skapar perioder och dagar baserar deras periodens start och slutdatum och skapar period dagar så länge dem är inom  
    parametrar: $conn(SQL conection)
                (String)$periodNamn(Namet på en perioden man vill skapa)
                (date)$startdatum(Datumet då en period börjar)
                (date)$slutdatum(Datum då en period)
    returns: inget  
 */
 function periodgeneration($conn,$periodNamn,$startdatum,$slutdatum){
     $sql="INSERT INTO period(periodNamn,startdatum,slutdatum) VALUES('$periodNamn','$startdatum','$slutdatum')";
     $conn->query($sql);

     $start=strtotime($startdatum);
     $slut=strtotime($slutdatum);
     $dagar=ceil(($slut-$start)/60/60/24);
     
     for ($i=0; $i < $dagar; $i++) { 
        
        $gto=strtotime("+$i days",$start);
        $datum=date('Y-m-d',$gto);
        if (("Saturday"==date("l",$gto)) || ("Sunday"==date("l",$gto))) {
            
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
    
     $sql="INSERT INTO perioddag(dagID,periodNamn) SELECT dag.dagID,period.periodNamn FROM dag, period WHERE period.periodNamn='$periodNamn' AND dag.datum>=period.startdatum AND dag.datum<=period.slutdatum";
     $conn->query($sql);

 }
 
 

 ?>