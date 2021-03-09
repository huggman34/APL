<?php
/**
 * Denna filen används så att Företag kan logga in.
 * Den hämtar datan som skrivs in i login formuläret för företag.
 * Sedan så kollar den om namn och lösenord finns i företag tabellen i databasen.
 * Om det stämmer så skickas du vidare.
 * Men om det inte gör det så får du skriva om inloggnings uppgifter.
 */
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