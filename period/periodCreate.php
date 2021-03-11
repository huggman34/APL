<?php
/** 
 * Beskrivning: 
 * I den här filen lägger man till perioder tilsammans med dagar och period dagar.
 * Man kan också välja bort dem dagar som man inte ska ha med i en period som låv dagar och annat. 
 * TODO:
 * prepared statements på sql statements 
*/

include_once "../loginFunctions.php";
include_once "../connection.php";
include_once "../DeleteFunctions.php";
include_once "../registerFunctions.php";
session_start();
//$username=$_SESSION['username'];

if(checkAdminLogin()) {
    $username = $_SESSION['username'];
    echo "Logged in as " . $username . "<br></br>";

    echo'
    <form action="periodCreate.php" method="post">
    <input type="text" name="periodnamn" placeholder="namn" requierd>
    <input type="date" name="startdatum" requierd>
    <input type="date" name="slutdatum" requierd>
    <input type="submit" value="submit" name="submin">
    </form>';
    if (isset($_POST['periodnamn'])) {
            $periodNamn=$_POST['periodnamn'];
        }
    if (isset($_POST['submin'])) {
        
        if ($_POST['submin']=="ta bort dagar") {
            if (isset($_POST['periodDag'])) {
                $periodD=$_POST['periodDag'];
            
            

            foreach($periodD as $perioddag){
            deletePeriodDag($conn,$perioddag);
            }
        }
        }else{
            periodGeneration($conn,$_POST['periodnamn'],$_POST['startdatum'],$_POST['slutdatum']);
        }
    
        $sql = "SELECT dag.datum, period.periodNamn, perioddag.perioddagID FROM period
        INNER JOIN perioddag ON period.periodNamn = perioddag.periodNamn
        INNER JOIN dag ON perioddag.dagID = dag.dagID
        WHERE period.periodNamn = '$periodNamn'
        ORDER BY dag.datum";
        $sqldata = mysqli_query($conn, $sql) or die("error");
    
    
        echo "<table>";
        echo "<tr><th>Dag</th><th>Datum</th><th>Period</th></tr>
        <form action='periodCreate.php' method='post'>";

        while($row = mysqli_fetch_assoc($sqldata)) {

            $date=strtotime($row['datum']);
            $dag=$row['perioddagID'];
            echo "<tr>";
            echo "<td>";
            echo date('l',$date);
            echo "</td><td>";
            echo $row['datum'];
            echo "</td><td>";
            echo $row['periodNamn'];
            echo "</td><td>
            <input type='checkbox' name='periodDag[]' value='$dag'>
            </td></tr>";
        }
        
        echo"<input type='hidden' name='periodnamn' value='$periodNamn'>
        <input type='submit' name='submin' onclick=\"return confirm('Du är på väg att ta bort dem markerade datumen, är du säker?');\" value='ta bort dagar'>
        </form>";
        echo "</table>
        
        <form action='periodCreate.php' method='post'>
        <input type='hidden' name='periodnamn' value='$periodNamn'>
        <input type='submit' name='submit' onclick=\"return confirm('Är du säker?');\" value='börja om'>
        </form>";
    }
        if (isset($_POST['submit'])) {
            deletePeriod($conn,$periodNamn);
        }

} else {
    echo "Please log in first to see this page <br></br>";
}
  
 /* beskrivning: skapar perioder och dagar baserar deras periodens start och slutdatum och skapar period dagar så länge dem är inom  
    parametrar: $conn(SQL conection)
                (String)$periodNamn(Namet på en perioden man vill skapa)
                (date)$startdatum(Datumet då en period börjar)
                (date)$slutdatum(Datum då en period slutar)
    returns: inget  
 */
?>