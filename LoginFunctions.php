<?php
/**
 * Denna filen håller på inloggnings funktionen för både företag och admin.
 * Filen inkluderas i inloggnings formulär filen så att den får tillgång till
 * Inloggnings funktionen så att data som matas in i formuläret skickas till denna fil.
 * Som sedan ser om inloggnings uppgifterna är korrekt eller ej.
 * Om uppgifterna är korrekt skickas du vidare till respektive sida.
 * Om de inte är korrekta så skriver den ut att 'Felaktig inloggningsuppgifter'.
 */
    function adminLogin($conn, $username, $password) {
        $stmt = $conn->prepare('SELECT * FROM admin WHERE anvnamn = ? AND losenord = ?');
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $exist = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      
        if($exist) {
          session_start();

          $_SESSION['loggedinAdmin'] = true;
          $_SESSION["username"] = $username;
          header('Location: ../index.php');
        } else {
            echo "Felaktig inloggningsuppgifter";
        }
    }

    function foretagLogin($conn, $username, $password) {
        $stmt = $conn->prepare('SELECT * FROM foretag WHERE namn = ? AND losenord = ?');
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $exist = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        if($exist) {
            session_start();

            $_SESSION['loggedin'] = true;
            $_SESSION["username"] = $username;
            header('Location: ../narvaro/registerNarvaro.php');

        } else {
            echo "Felaktig inloggningsuppgifter";
        }
    }

    function checkForetagLogin() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return true;
        } else {
            false;
        }
    }

    function checkAdminLogin() {
        if (isset($_SESSION['loggedinAdmin']) && $_SESSION['loggedinAdmin'] == true) {
            return true;
        } else {
            false;
        }
    }
?>