<?php
/**
 * funktions biblotek för alla delet funktioner.
 * alla funktioner tar bort en rader där tabbelens id är lika med $id.
 */
    

function deleteForetag($conn,$id){
    $sql = "DELETE FROM foretag WHERE foretagID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    
            
    if ($stmt->execute()){

    } else{
        return "Error deleting record";
    }
}

function deleteNarvaro($conn,$id){
    $sql = "DELETE FROM narvaro WHERE narvaroID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    
            
    if ($stmt->execute()){
        
    } else{
        return "Error deleting record";
    }
}
/* beskrivning: raderar perioder och perioddagar där periodNamn är $id
                 
*/
function deletePeriod($conn,$id){
    $sql = "DELETE period,perioddag FROM period INNER JOIN perioddag ON period.periodNamn = perioddag.periodNamn WHERE period.periodNamn=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$id);
    
            
    if ($stmt->execute()){
       
    } else{
        return "Error deleting record";
    }
}
function deleteElev($conn,$id){
    $sql = "DELETE FROM elev WHERE elevID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$id);
    
            
    if ($stmt->execute()){
        
    } else{
        return "Error deleting record";
    }
}

function deleteDag($conn,$id){
    $sql = "DELETE FROM dag WHERE dagID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    
            
    if ($stmt->execute()){
        
    } else{
        return "Error deleting record";
    }
}
function deleteKlass($conn,$id){
    $sql = "DELETE FROM klass WHERE klass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$id);
    
            
    if ($stmt->execute()){
        
    } else{
        return "Error deleting record";
    }
}
function deletePeriodDag($conn,$id){
    $sql = "DELETE FROM perioddag WHERE perioddagID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    
            
    if ($stmt->execute()){
        
    } else{
        return "Error deleting record";
    }
}
function deletePlats($conn,$id){
    $sql = "DELETE FROM plats WHERE platsID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    
            
    if ($stmt->execute()){
        
    } else{
        return "Error deleting record";
    }
}
function deleteHandledare($conn,$id){
    $sql = "DELETE FROM handledare WHERE handledarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    
            
    if ($stmt->execute()){
        
    } else{
        return "Error deleting record";
    }
}

?>