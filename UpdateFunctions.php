<?php 

/**
 * Denna fil används för att redigera period tabellen. 
 * Genom att skicka in periodnamnet kan man redigera startdatum och slutdatum för perioden.
 */


    


function updatePeriod($conn,$startdatum,$slutdatum,$periodnamn){
        $sql = "UPDATE period SET startdatum='$startdatum', slutdatum='$slutdatum' WHERE periodNamn=$periodNamn";
        mysqli_query($conn, $sql);
}
function updateForetag($conn,$namn,$losenord,$epost,$telefon,$foretagsID){
    $sql = "UPDATE foretag SET namn='$namn', losenord='$losenord', epost='$epost', telefon='$telefon' WHERE foretagID=$foretagsID";
            mysqli_query($conn, $sql);
}  
function updateDag($conn,$datum,$dagID){
        $sql = "UPDATE dag SET datum='$datum' WHERE dagID=$dagID";
        mysqli_query($conn, $sql);
}
function updateElev($conn,$fornamn,$efternamn,$elevID){
        $sql = "UPDATE elev SET fornamn='$fornamn', efternamn='$efternamn' WHERE elevID=$elevID";
        mysqli_query($conn, $sql);
}
function updatePeriodDag($conn,$periodNamn,$dagID,$perioddagID){
        $sql = "UPDATE perioddag SET periodNamn='$periodNamn', dagID='$dagID' WHERE periodDagID=$perioddagID";
        mysqli_query($conn, $sql);
}

?>