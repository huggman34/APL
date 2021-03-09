<?php
/**
 * Denna filen används så att Admin kan logga in.
 * Den hämtar datan som skrivs in i login formuläret för admin.
 * Sedan så kollar den om anvnamn och lösenord finns i admin tabellen i databasen.
 * Om det stämmer så skickas du vidare.
 * Men om det inte gör det så får du skriva om inloggnings uppgifter.
 */
  session_start();
  include_once "../connection.php";

  $username = $_POST["username"];
  $password = $_POST["password"];
    
  $stmt = $conn->prepare('SELECT * FROM admin WHERE anvnamn = ? AND losenord = ?');
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $exist = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

  if($exist) {
    session_start();

    $_SESSION["username"] = $username;
    header('Location: adminMain.php');
  } else {
      header("location: adminLoginForm.php");
  }
?>