<?php 
  session_start();
  include_once "connection.php";

  $username = $_POST["username"];
  $password = $_POST["password"];
    
  $stmt = $conn->prepare('SELECT * FROM foretag WHERE namn = ? AND losenord = ?');
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $exist = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

  if($exist) {
    session_start();

    $_SESSION["username"] = $username;
    header('Location: narvaro/reportForm.php');

  } else {
      header("location: form.php");
  }
?>