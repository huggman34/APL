<?php
    require_once "../connection.php";
    require_once "../DeleteFunctions.php";

    if (isset($_POST['deleteElev'])) {
        deleteElev($conn,$_POST['deleteElev']);
        header('Location: adminMain.php');
    }
    if (isset($_POST['deleteForetag'])) {
        deleteForetag($conn,$_POST['deleteForetag']);
        header('Location: adminMain.php');
    }
    if (isset($_POST['deletePlats'])) {
        deletePlats($conn,$_POST['deletePlats']);
        header('Location: adminMain.php');
    }
    if (isset($_POST['deletePeriod'])) {
        deletePeriod($conn, $_POST['deletePeriod']);
        header('Location: adminMain.php');
    }
    if (isset($_POST['deleteKlass'])) {
        deleteKlass($conn,$_POST['deleteKlass']);
        header('Location: adminMain.php');
    }
    if (isset($_POST['deleteHandledare'])) {
        deleteHandledare($conn,$_POST['deleteHandledare']);
        header('Location: adminMain.php');
    }
?>