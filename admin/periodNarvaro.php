<?php
    require_once '../ViewFunctions.php';
    require_once '../connection.php';

    if(isset($_POST['period'])) {
        $period = $_POST['period'];

        $narvaroData = periodNarvaro($conn, $period);

        $narvaro = array_column($narvaroData, 'narvaro');
        $periodNarvaro = array_filter($narvaro);

        function narvaroCount($periodNarvaro) {
        $count = 0;
        foreach ($periodNarvaro as $pN) {
            if(in_array("1", $periodNarvaro)) {
                $count++;
            }
        }
        return $count;
        }
        $narvaroCount = narvaroCount($periodNarvaro);

        function franvaroCount($periodNarvaro) {
            $count = 0;
            foreach ($periodNarvaro as $pN) {
                if(in_array("2", $periodNarvaro)) {
                    $count++;
                }
            }
            return $count;
        }
        $franvaroCount = franvaroCount($periodNarvaro);

        function ogiltigFranvaroCount($periodNarvaro) {
            $count = 0;
            foreach ($periodNarvaro as $pN) {
                if(in_array("3", $periodNarvaro)) {
                    $count++;
                }
            }
            return $count;
        }
        $ogiltigFranvaroCount = ogiltigFranvaroCount($periodNarvaro);

        function nullCount($narvaro) {
            $null = 0;
            foreach ($narvaro as $n) {
                if(is_null($n)) {
                    $null++;
            }
        }
        return $null;
        }
        $nullCount = nullCount($narvaro);

        echo $narvaroCount;
        echo ';';
        echo $ogiltigFranvaroCount;
        echo ';';
        echo $franvaroCount;
        echo ';';
        echo $nullCount;
    }
?>