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
        $stmt = $conn->prepare('SELECT * FROM admin WHERE anvnamn = ?');
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
      
        if(!empty($row['anvnamn']) && password_verify($password, $row['losenord'])) {
          session_start();

          $_SESSION['loggedinAdmin'] = true;
          $_SESSION["username"] = $username;
          header('Location: ../admin/adminMain.php');
        } else {
            echo "Felaktig inloggningsuppgifter";
        }
    }

    function foretagLogin($conn, $username, $password) {

        $stmt = $conn->prepare('SELECT * FROM handledare WHERE epost = ?');
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if(!empty($row['epost']) && password_verify($password, $row['losenord'])) {
            session_start();

            $_SESSION['loggedin'] = true;
            $_SESSION["username"] = $username;
            //header('Location: ../narvaro/registerNarvaro.php');
            return "välkommen $username";
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