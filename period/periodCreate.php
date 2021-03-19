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

require_once "../connection.php";
require_once "../DeleteFunctions.php";
require_once "../RegisterFunctions.php";
require_once "../LoginFunctions.php";
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
        $startdatum=$_POST['startdatum'];
        $slutdatum=$_POST['slutdatum'];
    }
 if (isset($_POST['submin'])) {
    
    if ($_POST['submin']=="klar") {
        if (isset($_POST['periodDag'])) {
            periodGeneration($conn,$_POST['periodnamn'],$startdatum,$slutdatum,$_POST['periodDag']);
            header("Location: ../Lists.php");
        }
        }
        echo $periodNamn;
        echo "<table>";
        echo "<tr><th>Vecka</th><th>Dag</th><th>Datum</th><th>Period</th></tr>
        <form action='periodCreate.php' method='post'>";
        $start=strtotime($startdatum);
        $slut=strtotime($slutdatum);
        $dagar=ceil(($slut-$start)/60/60/24);
        
        for ($i=0; $i < $dagar+1; $i++) { 
           
           $gto=strtotime("+$i days",$start);
           $datum=date('Y-m-d',$gto);

           
           echo "<tr>";
           echo "<td>";
           echo date('W',$gto);
           echo "</td><td>";
           echo date('l',$gto);
           echo "</td><td>";
           echo $datum;
           echo "</td><td>";
           echo $periodNamn;
           echo "</td><td>";
           if (("Saturday"==date("l",$gto)) || ("Sunday"==date("l",$gto))) {
            echo"<input type='checkbox' name='periodDag[]' value='$datum'>";
        }else {
            echo"<input type='checkbox' name='periodDag[]' value='$datum' checked>";
        }
           
           echo"</td></tr>";
       }
       
       echo"<input type='hidden' name='periodnamn' value='$periodNamn'>
       <input type='hidden' name='startdatum' value='$startdatum'>
       <input type='hidden' name='slutdatum' value='$slutdatum'>
       <input type='submit' name='submin' onclick=\"return confirm('Är du säker?');\" value='klar'>
       </form>";
       echo "</table>";
     
    echo"<form action='periodCreate.php' method='post'>
    <input type='submit' name='submit' onclick=\"return confirm('Är du säker?');\" value='börja om'>
    </form>";
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