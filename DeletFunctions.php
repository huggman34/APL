<?php
/**
 * funktions biblotek för alla delet funktioner.
 * alla funktioner tar bort en rader där tabbelens id är lika med $id.
 */
    

function deleteForetag($conn,$id){
    $sql = "DELETE FROM foretag WHERE foretagsID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
    } else{
        echo "Error deleting record";
    }
}

function deleteNarvaro($conn,$id){
    $sql = "DELETE FROM narvaro WHERE narvaroID = '$id'";

    if (mysqli_query($conn, $sql)){
      
    } else{
        echo "Error deleting record";
    }
}
//fungerar inte då period
function deletePeriod($conn,$id){
    $sql = "DELETE FROM period WHERE periodNamn = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        
    } else{
        echo "Error deleting record";
    }
}
function deleteElev($conn,$id){
    $sql = "DELETE FROM elev WHERE elevID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        
    } else{
        echo "Error deleting record";
    }
}
function deleteDag($conn,$id){
    $sql = "DELETE FROM dag WHERE dagID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
    
    } else{
        echo "Error deleting record";
    }
}
function deletePeriodDag($conn,$id){
    $sql = "DELETE FROM perioddag WHERE perioddagID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        
    } else{
        echo "Error deleting record";
    }
}

?>