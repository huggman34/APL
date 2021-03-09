<html>
<body>
<?php
/**
 * Denna filen används för att lägga in elever i elev tabellen i databasen.
 * Den tar emot datan som skickas in via formuläret som finns i 'elev.php'
 * Den gör så att första bokstaven i förnamn och efternamn är stora bokstäver
 * Sedan så skapar den en elevID med förnamnet och efternamnet.
 * Efter det kollar den om elevID redan finns, om den inte finns så sätter
 * den in förnamnet, efternamnet och elevID som skapats i elev tabellen i databasen.
 * Om elevID som skapats redan finns, så kollar den hur många elever som har samma för och efternamn
 * Sedan tar den summan och adderar det med 1, och skapar ett unikt elevID med den siffran.
 * Därefter skickas förnamnet, efternamnet och den unika elevID som skapats.
 */
    include_once '../connection.php';

    $fornamn = ucfirst($_POST['fornamn']);
    $efternamn = ucfirst($_POST['efternamn']);
    $elevID = ucwords("$fornamn.$efternamn", ".");

    echo "Du har registerat eleven: <br>";
    echo $fornamn.' '.$efternamn . "<br>";

    $dupeCheck = "SELECT * FROM elev WHERE fornamn = ? AND efternamn = ?";

    $stmt = $conn->prepare($dupeCheck);
    $stmt->bind_param("ss", $fornamn, $efternamn);
    $stmt->execute();
    $stmt->store_result();
    $result = $stmt->num_rows;

    if($result == 0) {
        $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $elevID, $fornamn, $efternamn);

        if ($stmt->execute()){
            echo "Records added successfully.";
        } else{
            echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
        }
        
    } else {
        $count = $result+1;
        $dupeElevID = $elevID.$count;

        $stmt = $conn->prepare("INSERT INTO elev (elevID, fornamn, efternamn) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $dupeElevID, $fornamn, $efternamn);

        if ($stmt->execute()){
            echo "Records added successfully.";
        } else{
            echo "ERROR: Was not able to execute $stmt. " . mysqli_error($conn);
        }
    }
?>
<br><a href="../elev.php" class="tillbaka2">Gå tillbaka</a>
</body>
</html>