<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="apl.css?version=2">
</head>
<body>
<?php
require_once "LoginFunctions.php";
require_once "connection.php";
require_once 'RegisterFunctions.php';

session_start();

if(checkAdminLogin()) {
    $username = $_SESSION['username'];
        //echo "Logged in as " . $username . "<br></br>";
?>
    <div class="container3">
        <div class="menu">
            <a class="tabell" href="Lists.php">Se tabeller</a>
            <a class="registrera" href="RegisterLinks.php">Registration</a>
            <div class="background"></div><br></br>
        
    <?php
    $sqlget = "SELECT * FROM foretag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");
    echo'<form action="Index.php" method="post">';
    while($row = mysqli_fetch_assoc($sqldata)) {
        $namn=$row['namn'];
        echo"<input type='submit' name='foretag' value='$namn'>";
    }
    echo'</form>';
     if (isset($_POST['elev'])) {
        
        $eleID = $_POST['elev'];

        $sql = "SELECT foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
        INNER JOIN plats ON plats.platsID=narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID=plats.foretagID
        INNER JOIN elev ON elev.elevID=plats.elevID
        INNER JOIN dag ON perioddag.dagID=dag.dagID 
        WHERE elev.elevID=? ORDER BY dag.datum";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $eleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        //print_r($data);
    
        if (empty($data)) {
            echo "$elevID kan inte hittas i nogra register";
        } else {
            echo "<table>";
            echo "<tr><th>Dag</th><th>Narvaro</th><th>Ta bort narvaro</th></tr>";
            foreach ($data as $row => $column) {
    
                if (is_null($column['narvaro'])) {
                    $column['narvaro'] = "null";
                }
                
                $str = ['null', '1', '2', '3'];
                $rplc = ['icke anmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];
    
                $column2 = str_replace($str, $rplc, $column);
                
                echo "<tr><td>";
                echo $column['datum'];
                echo narvaroColor($column['narvaro']);               
            }
            echo "</table>";
        }
    }elseif (isset($_POST['foretag'])) {
        
    } else{
        $sql3 = "SELECT klass FROM klass";
    $result3 = mysqli_query($conn, $sql3);
    $data3 = $result3->fetch_all(MYSQLI_ASSOC);
    
    echo "<form action='Index.php' method='POST'>";
    echo "<select name='klass'>";
        foreach ($data3 as $row) {
            echo "<option value='".$row['klass']."'> ".$row['klass']." </option>";
        }
    echo "</select>";
    echo "<input type='submit' name='submitKlass'/>";
    echo "</form>";
    if(isset($_POST['submitKlass'])) {
        $klass = $_POST['klass'];
    
        $sql = "SELECT elev.elevID, plats.periodNamn, foretag.namn
        FROM elev
        LEFT JOIN plats ON plats.elevID = elev.elevID
        LEFT JOIN foretag ON plats.foretagID = foretag.foretagID
        WHERE elev.klass = ?
        ORDER BY elevID ASC";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $klass);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        if(empty($data)) {
            echo "Ingen elev i $klass har fått en plats";
        } else {
            echo "<table>";
            echo "<tr><th>Elev</th><th>Period</th><th>Företag</th></tr>";
            echo'<form action="Index.php" method="post">';
            foreach ($data as $row) {
                echo "<tr><td>"; 
                $elevID=$row['elevID'];
                echo "<input type='submit' name='elev' value='$elevID'>";
                echo "</td><td>";
                echo $row['periodNamn'];
                echo "</td><td>";
                echo $row['namn'];
            }
            echo "</table>";
            echo"</form>";
        }
    }
    $sql2 = "SELECT periodNamn FROM period";
    $result = mysqli_query($conn, $sql2);
    $data2 = $result->fetch_all(MYSQLI_ASSOC);
    
    echo "<h3>värj period för att se närvro status för dem elever somm jobbar idag</h3>
    <form action='Index.php' method='POST'>";
    echo "<select name='Pnarvaro'>";
        foreach ($data2 as $row) {
            echo "<option value='".$row['periodNamn']."'> ".$row['periodNamn']." </option>";
        }
    echo "</select>";
    echo "<input type='submit' name='submt'/>";
    echo "</form>";
    
    
    if(isset($_POST['submt'])) {
        $periodNamn = $_POST['Pnarvaro'];
    
        $sql = "SELECT elev.klass,foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
        INNER JOIN plats ON plats.platsID=narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID=plats.foretagID
        INNER JOIN elev ON elev.elevID=plats.elevID
        INNER JOIN dag ON perioddag.dagID=dag.dagID
        INNER JOIN period ON plats.periodNamn=period.periodNamn 
        WHERE period.periodNamn=? AND dag.datum='2021-03-01' ORDER BY elev.klass";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $periodNamn);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        //print_r($data);
   
        if (empty($data)) {
            echo "Ingen har praktiserat hos $periodNamn";
        } else {
            echo "<table>";
            echo date("Y M d");
            echo "<tr><th>Företag</th><th>Klass</th><th>Elev</th><th>Dag</th><th>Narvaro</th><th>Ta bort narvaro</th></tr>";
            echo'<form action="Index.php" method="post">';
            foreach ($data as $row => $column) {
    
                if (is_null($column['narvaro'])) {
                    $column['narvaro'] = "null";
                }
                
                $str = ['null', '1', '2', '3'];
                $rplc = ['icke anmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];
    
                $column2 = str_replace($str, $rplc, $column);
                
                echo "<tr><td>";
                echo $column['namn'];
                echo "</td><td>";
                echo $column['klass'];
                echo "</td><td>";
                $elevID=$column['elevID'];
                echo "<input type='submit' name='elev' value='$elevID'>";
                echo narvaroColor($column['narvaro']);
            }
            echo "</table>";
        }
        echo"</form>";
    }
    
}
} else {
    echo "Please log in first to see this page <br></br>";

}
function narvaroColor($column){
    switch ($column) {
        case '1':
            return "</td><td class='narvaro1'>Närvarande</td>";
            break;
        case '3':
            return"</td><td class='narvaro2'>Frånvarande</td>";
            break;
        case '2':
            return "</td><td class='narvaro3'>Giltigt frånvarande</td>";
            break;
        case 'null':
            return "</td><td>Icke anmäld</td>";
            break; 
    }
}
    ?>
    </div>
    </div>
</body>
</html>