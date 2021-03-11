<?php
/**
 * funktions biblotek för alla delet funktioner.
 * alla funktioner tar bort en rader där tabbelens id är lika med $id.
 */
    

function deleteForetag($conn,$id){
    $sql = "DELETE FROM foretag WHERE foretagID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:Lists.php');
    } else{
        echo "Error deleting record";
    }
}

function deleteNarvaro($conn,$id){
    $sql = "DELETE FROM narvaro WHERE narvaroID = '$id'";

    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:Lists.php');
    } else{
        echo "Error deleting record";
    }
}
/* beskrivning: raderar perioder och perioddagar där periodNamn är $id
                 
*/
function deletePeriod($conn,$id){
    $sql = "DELETE period,perioddag FROM period INNER JOIN perioddag ON period.periodNamn = perioddag.periodNamn WHERE period.periodnamn='$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:Lists.php');
    } else{
        echo "Error deleting record";
    }
}
function deleteElev($conn,$id){
    $sql = "DELETE FROM elev WHERE elevID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:Lists.php');
    } else{
        echo "Error deleting record";
    }
}

function deleteDag($conn,$id){
    $sql = "DELETE FROM dag WHERE dagID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:Lists.php');
    } else{
        echo "Error deleting record";
    }
}
function deletePeriodDag($conn,$id){
    $sql = "DELETE FROM perioddag WHERE perioddagID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:Lists.php');
    } else{
        echo "Error deleting record";
    }
}
function deletePlats($conn,$id){
    $sql = "DELETE FROM plats WHERE platsID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:Lists.php');
    } else{
        echo "Error deleting record";
    }
}

?>