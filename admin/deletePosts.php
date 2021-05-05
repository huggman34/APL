<?php
/**
 * Denna filen används för att kunna radera saker i databasen genom de olika delete funktionerna som finns
 * i DeleteFunctions.php
 * Ett ID skickas till filen via AJAX request som sedan sätter in ID:et i rätt funktion.
 */
    require_once "../connection.php";
    require_once "../DeleteFunctions.php";

    if (isset($_POST['deleteElev'])) {
        deleteElev($conn,$_POST['deleteElev']);
    }

    if (isset($_POST['deleteForetag'])) {
        deleteForetag($conn,$_POST['deleteForetag']);
    }

    if (isset($_POST['deletePlats'])) {
        deletePlats($conn,$_POST['deletePlats']);
    }

    if (isset($_POST['deletePeriod'])) {
        deletePeriod($conn, $_POST['deletePeriod']);
    }

    if (isset($_POST['deleteKlass'])) {
        deleteKlass($conn,$_POST['deleteKlass']);
    }

    if (isset($_POST['deleteHandledare'])) {
        deleteHandledare($conn,$_POST['deleteHandledare']);
    }
?>