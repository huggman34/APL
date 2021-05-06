<?php
/**
 * funktions biblotek för alla delet funktioner.
 * alla funktioner tar bort en rader där tabbelens id är lika med $id.
 */
    function deleteForetag($conn,$id){
        $sql = "SELECT namn FROM foretag WHERE foretagID = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);

        $sql = "DELETE FROM foretag WHERE foretagID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);
                
        if ($stmt->execute()) {
            echo $row[0] . " har raderats";
        } else{
            return "Error deleting record";
        }
    }

    /* beskrivning: raderar perioder och perioddagar där periodNamn är $id */
    function deletePeriod($conn,$id){
        $sql = "DELETE FROM period WHERE periodNamn=?";
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

    function deleteKlass($conn,$id){
        $sql = "DELETE FROM klass WHERE klass = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$id);

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