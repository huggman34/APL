<?php
/**
 * Denna filen används för att koppla en handledare och företag till elever genom AJAX request via
 * ett formulär som skickar elevID och handledareID, vilket skickar det vidare till
 * updatePlatsHand funktionen från UpdateFunctions.php som sätter in datan i databasen.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['elev'], $_POST['handledare'])) {
        
        $elevID = $_POST['elev'];
        $handledare=$_POST['handledare'];

        foreach ($elevID as $e) {
            updatePlatsHand($conn,$handledare,$e);
        }
    }
?>