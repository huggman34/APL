<?php 
  session_start();
  include_once "db.php";

  $username = $_POST["username"];
  $password = $_POST["password"];
    
  $stmt = $conn->prepare('SELECT * FROM admin WHERE anvnamn = ? AND losenord = ?');
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $exist = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

  if($exist) {
    session_start();

    $_SESSION["username"] = $username;
    header('Location: adminpage.php');
    //echo "<p>inloggad som: $username</p>";

  } else {
      header("location: form.php");
  }
?>