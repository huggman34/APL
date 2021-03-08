<?php
session_start();
$username=$_SESSION['username'];

$conn = new mysqli('localhost', 'root','','apl');
$conn->set_charset("utf8");
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 } 
 echo'
 <form action="hugo functions.php" method="post">
 <input type="text" name="förnamn">
 <input type="text" name="efternamn">
 <input type="submit" value="läggtill" name="submit">
 </form>
 <form action="hugo functions.php" method="post">
 <input type="text" name="periodnamn">
 <input type="date" name="startdatum">
 <input type="date" name="slutdatum">
 <input type="submit" value="submit" name="submin">
 </form>';
 if(isset($_POST['submit'])){
     $fornamn=$_POST['förnamn'];
     $efternamn=$_POST['efternamn'];
     elevRegistreing($conn,$fornamn,$efternamn);

 }
 if (isset($_POST['submin'])) {
     periodgeneration($conn,$_POST['periodnamn'],$_POST['startdatum'],$_POST['slutdatum']);

     $t=strtotime($_POST['startdatum']);
     $g=strtotime($_POST['slutdatum']);
     echo ceil(($g-$t)/60/60/24);
 }

 function elevRegistreing($conn,$fornamn,$efternamn){
     
$sql="INSERT INTO elev(fornamn,efternamn) VALUES('$fornamn','$efternamn')";  

$conn->query($sql);
return "har lagts till";
     
 }
 function periodgeneration($conn,$startdatum,$slutdatum){
    /*$sql="INSERT INTO period(namn,startdatum,slutdatum) VALUES('$periodNamn','$startdatum','$slutdatum')";
     $conn->query($sql);*/
     $t=strtotime($startdatum);
     $g=strtotime($slutdatum);
     $pp=ceil(($g-$t)/60/60/24);
     $j=0;
     for ($i=0; $i < $pp; $i++) { 
         $b=strtotime($i);
          date($startdatum,$b);
          $j++;
     }
     
     /*$sql="INSERT INTO perioddag(dagID,periodID) SELECT dag.dagID,period.periodID FROM dag, period WHERE dag.datum>=period.startdatum AND dag.datum<=period.slutdatum";
     $conn->query($sql);
     return"sos";*/
     
     
 }

 ?>