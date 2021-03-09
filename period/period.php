<?php

$startDatum = new DateTime('2021-03-01');
$slutDatum= new DateTime('2021-03-10');
$slutDatum = $slutDatum->modify('+1 day');

$interval = new DateInterval('P1D');
$period = new DatePeriod($startDatum, $interval, $slutDatum);

$dagar = [];
$data = "7.5";

foreach($period as $date) {
    //echo $date->format("Y-m-d");
    $dag_num = $date->format("N");
    if($dag_num < 6) {
        $datum[$date->format("Y-m-d")] = $data;
    }
    //array_push($dagar, $date->format("Y-m-d"));
}

print_r($datum);
?>