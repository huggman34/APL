<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <?php 

        session_start();
        require_once 'connection.php';

        $elevID = $_POST['elevID'];
        $fornamn = '';
        $efternamn = '';

        if(isset($_POST['elevID'])){
            $elevID = $_POST['elevID'];
            $fornamn = $_POST['fornamn'];
            $efternamn = $_POST['efternamn'];


            $sql = "UPDATE elev SET fornamn='$fornamn', efternamn='$efternamn' WHERE elevID=$elevID";
            mysqli_query($conn, $sql);
            
        }
        header('location: elevlista.php');
    ?>
</body>
</html>