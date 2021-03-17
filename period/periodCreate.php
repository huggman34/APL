<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
/** 
 * Beskrivning: 
 * I den här filen lägger man till perioder tilsammans med dagar och period dagar.
 * Man kan också välja bort dem dagar som man inte ska ha med i en period som låv dagar och annat. 
 * TODO:
 * prepared statements på sql statements 
*/

require_once "../loginFunctions.php";
require_once "../connection.php";
require_once "../DeleteFunctions.php";
require_once "../registerFunctions.php";
require_once "../loginFunctions.php";
session_start();



if(checkAdminLogin()) {
    $username = $_SESSION['username'];
    echo "Logged in as " . $username . "<br></br>";
 echo'
 <form action="periodCreate.php" method="post">
 <input type="text" name="periodnamn" placeholder="namn" required>
 <input type="date" name="startdatum" required>
 <input type="date" name="slutdatum" required>
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
    WHERE period.periodNamn = ?
    ORDER BY dag.datum";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $periodNamn);
    $stmt->execute();
    $result = $stmt->get_result();
    

    
        echo "<table>";
        echo "<tr><th>Vecka</th><th>Dag</th><th>Datum</th><th>Period</th></tr>
        <form action='periodCreate.php' method='post'>";

        while($row = $result->fetch_assoc()) {

            $date=strtotime($row['datum']);
            $dag=$row['perioddagID'];
            $week=strtotime($row['datum']);
            echo "<tr>";
            echo "<td>";
            echo date('W',$week);
            echo "</td><td>";
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
<a class="link2" href="../Lists.php">Se inlagda perioder</a>
</body>
</html>