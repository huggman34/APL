<?php 

/**
 * Denna fil inneholler alla funktioner som används för att redigera tabeller. 
 * Genom att referera till funktionen kan man uppdatera värdena för en rad i tabbelen baserat på dess ID.
 */

function updatePeriod($conn,$startdatum,$slutdatum,$periodnamn){
        $sql = "UPDATE period SET startdatum=?, slutdatum=? WHERE periodNamn=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dds",$startdatum,$slutdatum,$periodnamn);
    
            
    if ($stmt->execute()){

    }else{
           return "Error"; 
    }
}
function updateForetag($conn,$namn,$losenord,$epost,$telefon,$foretagsID){
    $sql = "UPDATE foretag SET namn=?, losenord=?, epost=?, telefon=? WHERE foretagID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi",$namn,$losenord,$epost,$telefon,$foretagsID);

        
if ($stmt->execute()){

}else{
       return "Error"; 
}
}

function updateDag($conn,$datum,$dagID){
        $sql = "UPDATE dag SET datum=? WHERE dagID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di",$datum,$dagID);
    
            
    if ($stmt->execute()){

    }else{
           return "Error"; 
    }
}

function updateElev($conn,$fornamn,$efternamn,$elevID){
        $sql = "UPDATE elev SET fornamn=?, efternamn=? WHERE elevID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",$fornamn,$efternamn,$elevID);
    
            
    if ($stmt->execute()){

    }else{
           return "Error"; 
    }
}

function updatePeriodDag($conn,$periodNamn,$dagID,$perioddagID){
        $sql = "UPDATE perioddag SET periodNamn=?, dagID=? WHERE periodDagID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii",$periodNamn,$dagID,$perioddagID);
    
            
    if ($stmt->execute()){
            return "";
    }else{
           return "Error"; 
    }
}

function updatePlats($conn,$periodNamn,$elevID,$foretagID){

    $sql = "SELECT platsID FROM plats
    WHERE elevID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $elevID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

        $sql = "UPDATE plats SET periodNamn=?, elevID=?, foretagID=? WHERE platsID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii",$periodNamn,$elevID,$foretagID,$row['platsID']);
    
            
    if ($stmt->execute()){
return "ech";
    }else{
           return "Error"; 
    }
}

?>