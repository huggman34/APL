<?php
    require_once "../LoginFunctions.php";
    require_once "../connection.php";
    require_once '../RegisterFunctions.php';
    require_once "../ViewFunctions.php";
    require_once "../DeleteFunctions.php";
    //require_once "periodNarvaro.php";

    session_start();

if(checkAdminLogin()) {
    $username = $_SESSION['username'];
    if (isset($_POST['deletelev'])) {
        deleteElev($conn,$_POST['deletelev']);
    }
    if (isset($_POST['deletforetag'])) {
        deleteForetag($conn,$_POST['deletforetag']);
    }
    if (isset($_POST['deletplats'])) {
        deletePlats($conn,$_POST['ID']);
    }
    if (isset($_POST['deletperiod'])) {
        deletePeriod($conn,$_POST['ID']);
    }
    if (isset($_POST['deletklass'])) {
        deleteKlass($conn,$_POST['deletklass']);
    }
    if (isset($_POST['delethandledare'])) {
        deleteHandledare($conn,$_POST['delethandledare']);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
        <title>Admin</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    <body onload="donutChart(); elever();">
        <div id="wrapper">
            <div id="snackbar"></div>
            <div class="navbar">
                <div class="logo"></div>
                <div class="home">
                    <svg id="homeIcon" xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 55 59">
                       <path d="M33.48,9.52,57,32.07V59H41.76V40l-4.07.07L29,40.24l-3.88.07-.05,3.88L24.91,59H10V31.7L33.48,9.52M33.5,4,6,30V63H28.86l.23-18.76,8.67-.15V63H61V30.36L33.5,4Z" transform="translate(-6 -4)"/>
                    </svg>
                </div>
                <div class="registerElev">
                    <svg id="elevIcon" xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 512 511">
                        <path d="M428.16,387.74V303.91H388.24v83.83H304.4v39.93h83.84V511.5h39.92V427.67H512V387.74ZM255.5.5C174.05.5,107.79,66.76,107.79,148.21a147.65,147.65,0,0,0,64.14,121.72A255.92,255.92,0,0,0,0,511.5H39.92c0-118.87,96.71-215.58,215.58-215.58,81.45,0,147.71-66.26,147.71-147.71S337,.5,255.5.5Zm0,255.5A107.79,107.79,0,1,1,363.29,148.21,107.91,107.91,0,0,1,255.5,256Z"/>
                    </svg>
                </div>
                <div class="registerForetag">
                    <svg id="foretagIcon" xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white"  viewBox="0 0 35 35">
                        <path d="M23.33,21.88a2.92,2.92,0,1,1-2.91,2.91A2.91,2.91,0,0,1,23.33,21.88Zm1.83,7.29H21.51a4,4,0,0,0-4,4v.73A1.09,1.09,0,0,0,18.59,35h9.48a1.09,1.09,0,0,0,1.1-1.09v-.73A4,4,0,0,0,25.16,29.17Zm8.75-3.28h-.73v-.73a1.1,1.1,0,1,0-2.19,0v.73h-.73a1.09,1.09,0,0,0,0,2.18H31v.73a1.1,1.1,0,1,0,2.19,0v-.73h.73a1.09,1.09,0,1,0,0-2.18ZM2.19,28.44V24.06H17.57a6,6,0,0,1,.74-2.18h-1.9V19.32H12.76a1.09,1.09,0,1,1,0-2.18h3.65V15H12.76a1.1,1.1,0,0,1,0-2.19h3.65V10.57H12.76a1.09,1.09,0,0,1,0-2.18h3.65V6.2H12.76a1.1,1.1,0,0,1,0-2.19h3.65V1.09A1.09,1.09,0,0,0,15.31,0H8A1.09,1.09,0,0,0,6.93,1.09V4H4A1.09,1.09,0,0,0,2.92,5.1V21.88H1.09A1.09,1.09,0,0,0,0,23v6.56a1.09,1.09,0,0,0,1.09,1.1h14a6.92,6.92,0,0,1,1.41-2.19ZM5.1,6.2H6.93V8.39H5.1Zm0,4.37H6.93v2.19H5.1ZM5.1,15H6.93v2.19H5.1Zm0,4.37H6.93v2.56H5.1Z" transform="translate(0)"/>
                    </svg>
                </div>
                <div class="registerPeriod">
                    <svg id="periodIcon" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="white" class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                </div>
                <div class="registerPlats">
                    <svg id="platsIcon" xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 43.95 50">
                        <path d="M22.07,8.79a10.24,10.24,0,0,0-7.69,17A8.25,8.25,0,0,1,18,21.67a5.32,5.32,0,0,1-1.31-3.51,5.37,5.37,0,1,1,9.44,3.51,8.35,8.35,0,0,1,3.63,4.14,10.24,10.24,0,0,0-7.7-17Zm0,6.93a2.45,2.45,0,1,1-2.44,2.44A2.44,2.44,0,0,1,22.07,15.72Zm0,7.82a5.36,5.36,0,0,0-5.26,4.3,10.21,10.21,0,0,0,10.52,0A5.35,5.35,0,0,0,22.07,23.54Zm16.11,8.78A8.79,8.79,0,1,0,47,41.11,8.8,8.8,0,0,0,38.18,32.32Zm2.93,10.26H39.65V44a1.47,1.47,0,1,1-2.93,0V42.58H35.25a1.47,1.47,0,0,1,0-2.93h1.47V38.18a1.47,1.47,0,0,1,2.93,0v1.47h1.46a1.47,1.47,0,1,1,0,2.93ZM38,29.4a18.92,18.92,0,0,0,3.08-9.12A19.25,19.25,0,0,0,32.35,3,19.08,19.08,0,0,0,3.07,20.28a18.87,18.87,0,0,0,3.71,10l14.11,19.1a1.47,1.47,0,0,0,2.36,0l3.69-5a11.55,11.55,0,0,1-.48-3.3A11.73,11.73,0,0,1,38,29.4ZM22.07,32.23A13.19,13.19,0,1,1,35.26,19,13.2,13.2,0,0,1,22.07,32.23Z" transform="translate(-3.03 0)"/>
                    </svg>
                </div>
                <div class="registerPage">
                    
                </div>
            </div>
            <div class="menu">
                <div class="admin">
                    <img src="icons/user.svg">
                </div>
            </div>
            <div class="content-container">
                <div class="views" id="content1">
                    <!-- STARTSIDA CONTENT HÄR -->
                    <div class="narvaro">
                        <div>
                            <h1>Närvaro</h1>
                            <h3><?php echo date("Y-m-d") ?></h3>
                        </div>
                            <?php
                                $data = narvaroIdag($conn);

                                echo "<table class='narvaroTable'>";
                                echo "<thead><tr><th>Elev</th><th>Företag</th><th>Period</th><th>Närvaro</th><th></th></tr></thead><tbody>";

                                foreach ($data as $row => $column) {

                                    if (is_null($column['narvaro'])) {
                                        $column['narvaro'] = "null";
                                    }
                                    
                                    $str = ['null', '1', '2', '3'];
                                    $rplc = ['Oanmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];
                        
                                    $column2 = str_replace($str, $rplc, $column);

                                    $narvaroID = $column['narvaroID'];
                                    $narvaro = $column2['narvaro'];
                                    
                                    echo "<tr><td>";
                                    echo $column['elevID'];
                                    echo "</td><td>";
                                    echo $column['namn'];
                                    echo "</td><td>";
                                    echo $column['periodNamn'];
                                    echo "</td><td>";
                                    echo $column2['narvaro'];
                                    echo "</td><td>";
                                    echo "<button type='button' onclick=\"updateElevNarvaroIdag('$narvaroID', '$narvaro');\" >Update</button>";
                                    echo "</td></tr>";
                                }
                                echo "</tbody></table>";
                            ?>
                    </div>
                    <div class="periodNarvaro">
                        <?php 
                            $perioder = period($conn);
                        ?>

                        <form method="POST">
                            <select id="sel" name="period" onchange="donutChart();">
                                <?php
                                    foreach ($perioder as $p) {
                                        echo "<option value='".$p['periodNamn']."'> ".$p['periodNamn']." </option>";
                                    }
                                ?>
                            </select>
                        </form>
                        <div id="donutchart" style="width: 100%; height: 100%"></div>
                        <script type="text/javascript">
                            var narvaroCount = 0;
                            var franvaroCount = 0;
                            var ogiltigFranvaroCount = 0;
                            var nullCount = 0;
                            google.charts.load("current", {packages:["corechart"]});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Task', 'Hours per Day'],
                                    ['Närvaro', narvaroCount],
                                    ['Frånvaro', franvaroCount],
                                    ['Ogiltig frånvaro', ogiltigFranvaroCount],
                                    ['Oanmäld', nullCount]
                                ]);
                                    var options = {
                                    pieHole: 0.4,
                                    colors: ['#77dd77','#FEFE95','#ff6961','gainsboro'],
                                    chartArea:{
                                        left:70,
                                        width: '75%',
                                        height: '75%'
                                    },
                                    legend: {
                                        position: 'bottom'
                                    },
                                    pieSliceTextStyle: {color: '#4C4C4C'},
                                    pieSliceBorderColor: {color: '#4C4C4C'},
                                    title:'Period Närvaro',
                                    titleTextStyle: {fontSize: 15, bold: false, fontName: 'sans-serif'},
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                                chart.draw(data, options);
                            }

                            function donutChart() {
                                var dataval;
                                    dataval=$("#sel").val();
                                $.ajax({
                                    url: 'periodNarvaro.php',
                                    type: 'POST',
                                    data: {
                                        period: dataval
                                    },

                                    success: function(data) {
                                        res = data.split(';');
                                        narvaroCount = parseInt(res[0]);
                                        franvaroCount = parseInt(res[1]);
                                        ogiltigFranvaroCount = parseInt(res[2]);
                                        nullCount = parseInt(res[3]);

                                        drawChart();
                                    }
                                });
                            };

                        </script>
                        
                    </div>
                </div>
                <div class="views" id="content2" style='display:none'>
                <form action="adminMain.php" method="post">
                <div id="delet" class="deletbox">
                <input type="submit" name="deletelev" onclick='return confirm("Är du säker?");' value="submit">

                </div>
                <div id="delet5" class="deletbox">
                <input type="submit" name="deletklass" onclick="return confirm('Är du säker?');" value="submit">
                </div>
                </form>
                    <!-- ELEV CONTENT HÄR -->
                    <div class="elevList">
                        <input id="elevSearch" type="text" placeholder="Sök efter elever...">
                        <?php
                            $klasser = klass($conn);
                        ?>
                        <form method="POST">
                            <select id="klass" name="klass" onchange="elever();">
                                <option>All</option>
                                <?php
                                    foreach ($klasser as $k) {
                                        echo "<option value='".$k['klass']."'> ".$k['klass']." </option>";
                                    }
                                ?>
                            </select>
                        </form>
                        <script>
                            function elever() {
                                var klassSel = $('#klass').val();
                                $.ajax({
                                    url: 'elever.php',
                                    type: 'POST',
                                    data: {
                                        klass: klassSel
                                    },

                                    success: function(data) {
                                        $('#elevList').html(data);
                                    }
                                });
                            };

                            function elevPlatsPeriod() {
                                var pls = $('#platsPeriod').val();
                                var plk = $('#platsKlass').val();
                                $.ajax({
                                    url: 'periodSelect.php',
                                    type: 'POST',
                                    data: {
                                        platsPeriod: pls,
                                        platsKlass: plk 
                                    },

                                    success: function(data) {
                                        $('#restElever').html(data);
                                        //klassPlats(plk);
                                    }
                                });
                            };
                            function handledarPlats() {
                                var pls = $('#foretagPeriod').val();
                                $.ajax({
                                    url: 'foretagSelect.php',
                                    type: 'POST',
                                    data: {
                                        foretagPeriod: pls, 
                                    },

                                    success: function(data) {
                                        $('#platsElever').html(data);
                                    }
                                });
                            };
                            function dagPeriod() {
                                var pN = $('#periodnamn').val();
                                var startD = $('#startdatum').val();
                                var slutD = $('#slutdatum').val();
                                $.ajax({
                                    url: 'regPeriod.php',
                                    type: 'POST',
                                    data: {
                                        periodnamn: pN,
                                        startdatum: startD,
                                        slutdatum: slutD
                                    },

                                    success: function(data) {
                                        $('#dagList').html(data);
                                    }
                                });
                            };
                            function UdagPeriod() {
                                var pN = $('#Uperiodnamn').val();
                                var startD = $('#Ustartdatum').val();
                                var slutD = $('#Uslutdatum').val();
                                var pID = $('#periodID').val();
                                $.ajax({
                                    url: 'updatePeriod.php',
                                    type: 'POST',
                                    data: {
                                        periodnamn: pN,
                                        startdatum: startD,
                                        slutdatum: slutD,
                                        periodID: pID
                                    },

                                    success: function(data) {
                                        $('#UdagList').html(data);
                                    }
                                });
                            };
                        </script>
                        <div id="elevList"></div>
                    </div>

                    <div class="elevHolder">
                        <div class="narvaroView">
                            <h1>Klicka på en elev</h1>
                        </div>
                    </div>
                </div>

                <div class="views" id="content3" style='display:none'>
                    <form action="adminMain.php" method="post">
                    <div id="delet2" class="deletbox">
                    <input type="submit" name="deletforetag" onclick="return confirm('Är du säker?'); value="submit">
                    </div>
                    <div id="delet6" class="deletbox">
                    <input type="submit" name="delethandledare" onclick="return confirm('Är du säker?');" value="submit">
                    </div>
                </form>
                    <!-- FÖRETAG CONTENT HÄR -->
                    <div class="foretagList">
                        <div class="foretagListOptions">
                            <button id="viewForetag">Företag</button>
                            <button id="viewHandledare">Handledare</button>
                        </div>
                        <div id="foretagVy">
                            <?php
                            
                                $data = foretag($conn);
                            
                                echo "<table class='foretagTable'>";
                                echo "<thead><tr><th>Företag</th><th>Adress</th><th></th></tr></thead><tbody>";
                            
                                foreach ($data as $row) {
                                    $foretagID = $row['foretagID'];
                                    $namn = $row['namn'];
                                    $adress = $row['adress'];

                                    echo "<tr><td>";
                                    echo $row['namn'];
                                    echo "</td><td>";
                                    echo $row['adress'];
                                    echo "</td><td>";
                                    echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
                                    echo "<div id='foretagMenu'>";
                                        //echo "<button type='button' onclick=\"deletBoxF('$foretagID');\" >Ta bort</button>";
                                        echo "<button type='button' onclick=\"updateForetag('$foretagID', '$namn', '$adress');\" >Update</button>";
                                        echo "<button type='button' onclick=\"event.stopPropagation(); deleteForetag('$foretagID', '$namn');\" >Ta bort</button>";
                                    echo "</div>";
                                    echo "</td></tr>";
                                }
                                echo "</tbody></table>";
                            ?>
                        </div>
                        <div id="handledarVy" style="display:none">
                            <?php
                                $data = allHandledare($conn);
                            
                                echo "<table class='handledarTable'>";
                                echo "<thead><tr><th>Förnamn</th><th>Efternamn</th><th>Företag</th><th>E-post</th><th>Telefon</th><th></th></tr></thead><tbody>";
                            
                                foreach ($data as $row) {
                                    $handledarID = $row['handledarID'];
                                    $fornamn = $row['fornamn'];
                                    $efternamn = $row['efternamn'];
                                    $epost = $row['epost'];
                                    $foretag = $row['namn'];
                                    $telefon = $row['telefon'];

                                    echo "<tr><td>";
                                    echo $fornamn;
                                    echo "</td><td>";
                                    echo $efternamn;
                                    echo "</td><td>";
                                    echo $foretag;
                                    echo "</td><td>";
                                    echo $epost;
                                    echo "</td><td>";
                                    echo $telefon;
                                    echo "</td><td>";
                                    echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
                                    echo "<div id='foretagMenu'>";
                                        echo "<button type='button' onclick=\"updateHandledare('$handledarID', '$fornamn', '$efternamn', '$foretag', '$epost', '$telefon');\" >Update</button>";
                                        echo "<button type='button' onclick=\"deleteHandledare('$handledarID', '$fornamn', '$efternamn');\" >Ta bort</button>";
                                    echo "</div>";
                                    echo "</td></tr>";
                                }
                                echo "</tbody></table>";
                            ?>
                        </div>
                    </div>
                    <div class="foretagholder">
                        <div class="foretagView">
                            <h1>Klicka på ett företag</h1>
                        </div>
                    </div>
                </div>
                <div class="views" id="content4" style='display:none'>
                    <form action="adminMain.php" method="post">
                    <div id="delet4" class="deletbox">
                    <input type="submit" name="deletperiod" onclick="return confirm('Är du säker?');" value="submit">
                    </div>
                    </form>
                    <!--Formen för updatering av period -->
                    <form id='updatePeriod' method='post'>
                        <div id="uppDiv"></div>
                    </form>
                    <!-- PERIOD CONTENT HÄR -->
                    <div class="periodList">
                        <?php
                            $period="period";
                            $data = selectTabel($conn,$period);

                            echo "<table class='elevklassTable'>";
                            echo "<thead><tr><th>Period</th><th>Startdatum</th><th>Slutdatum</th><th></th></tr></thead><tbody>";

                            foreach($data as $row){
                                $periodID=$row['periodNamn'];
                                $slutdatum=$row['slutdatum'];
                                $startdatum=$row['startdatum'];

                                echo "<tr><td>";
                                echo $row['periodNamn'];
                                echo "</td><td>";
                                echo $row['startdatum'];
                                echo "</td><td>";
                                echo $row['slutdatum'];
                                echo "</td><td>";
                                echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
                                echo "<div class='periodMenu'>";
                                    //echo "<button type='button' onclick=\"deletBoxPr('$periodID');\" >Ta bort</button>";
                                    echo "<button type='button' onclick=\"updatePeriod('$periodID','$slutdatum','$startdatum');\" >Update</button>";
                                    echo "<button type='button' onclick=\"deletePeriod('$periodID');\" >Ta bort</button>";
                                echo "</div>";
                                echo "</td></tr>";
                            }
                            echo "</tbody></table>";
                        ?>
                    </div>
                    <div class="klassList">
                        <?php
                            $data = allKlass($conn);

                            echo "<table class='elevklassTable'>";
                            echo "<thead><tr><th>Klass</th><th></th></tr></thead><tbody>";

                            foreach($data as $row){
                                $klass = $row['klass'];

                                echo "<tr><td>";
                                echo $row['klass'];
                                echo "</td><td>";
                                echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
                                echo "<div id='foretagMenu'>";
                                    echo "<button type='button' onclick=\"updateKlass('$klass');\" >Update</button>";
                                    echo "<button type='button' onclick=\"deleteKlass('$klass');\" >Ta bort</button>";
                                echo "</div>";
                                echo "</td></tr>";
                            }
                            echo "</tbody></table>";
                        ?>
                    </div>
                </div>

                <div class="views" id="content6" style='display:none'>
                <form action="adminMain.php" method="post">
                    <div id="delet3" class="deletbox">
                    <input type="submit" name="deletplats" onclick="return confirm('Är du säker?');" value="submit">
                    </div>
                </form>
                <form class="uppdatebox" id="regPl" action="regPlatsHand.php" method="POST">
                            <select id="ep">
                            <?php
                                $allElev = allElev($conn);

                                echo "<option disabled selected> Välj Elev </option>";
                                foreach ($allElev as $e) {
                                    echo "<option value='".$e['elevID']."'> ".$e['elevID']." </option>";
                                }
                            ?>
                            </select>
                            <select id="fp">
                            <?php
                                $foretag = allHandledare($conn);
                                echo "<option disabled selected> Välj Företag </option>";
                                foreach ($foretag as $f) {
                                    echo "<option value='".$f['handledarID']."'> ".$f['fornamn'],$f['efternamn'],$f['namn']." </option>";
                                }
                            ?>
                            </select>
                            <select id="pp">
                            <?php
                                $allPeriod = allPeriod($conn);
                                echo "<option disabled selected> Välj Period </option>";
                                foreach ($allPeriod as $p) {
                                    echo "<option value='".$p['periodNamn']."'> ".$p['periodNamn']." </option>";
                                }
                            
                            echo'</select>'
                            ?>
                            <input type="hidden" id="pl">
                            <input id="subPl" type="submit" value="Spara">
                        </form>
                <div class="platsList">
                        <div>
                            <?php
                                $platser = elevPlats($conn);

                                echo "<table class='platsTable'>";
                                echo "<thead><tr><th>Elev</th><th>Företag</th><th>Handledare</th><th></th></tr></thead><tbody>";
                            
                                foreach ($platser as $row) {
                                    $platsID=$row['platsID'];
                                    $elevID=$row['elevID'];
                                    $periodNamn=$row['periodNamn'];
                                    $foretagID=$row['foretagID'];
                                    $handledarID = $row['handledarID'];
                                    $handledarFornamn = $row['fornamn'];
                                    $handledarEfternamn = $row['efternamn'];

                                    echo "<tr><td>";
                                    echo $row['elevID'];
                                    echo "</td><td>";
                                    echo $row['namn'];
                                    echo "</td><td>";
                                    echo "$handledarFornamn $handledarEfternamn";
                                    echo "</td><td>";
                                    echo "<button type='button' onclick=\"toggleMenu(this);\">...</button>";
                                    echo "<div id='foretagMenu'>";
                                        //echo "<button type='button' onclick=\"deletBoxP('$platsID');\" >Ta bort</button>";
                                        //echo "<button type='button' onclick=\"updateBP('$elevID','$foretagID','$periodNamn');\" >Update</button>";
                                        echo "<button type='button' onclick=\"updatePlats('$platsID','$handledarID','$periodNamn');\" >Update</button>";
                                        echo "<button type='button' onclick=\"deletePlats('$platsID','$elevID');\" >Ta bort</button>";
                                    echo "</div>";
                                    echo "</td></tr>";
                                }
                                echo "</tbody></table>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="views" id="content7" style='display:none'>
                    <div class="regSida">
                        <div class="regContent"></div>
                        <div class="regMenu">
                            <ul>
                                <li><div id="elevReg">Elev registrering</div></li>
                                    <div id="elevForm" class="formArea" style="display: none">
                                        <form id="regElev" action="regElev.php" method="POST">
                                            <input id="namn" type="text" placeholder="Förnamn" required>
                                            <input id="efternamn" type="text" placeholder="Efternamn" required>
                                            <input id="epost" type="email" placeholder="E-post" required>
                                            <input id="nummer" type="tel" placeholder="Nummer" required>
                                            <input id="elevKlass" type="text" placeholder="Klass" required>
                                            <input id="subElev" type="submit" namn="sub" value="Spara">
                                        </form>
                                    </div>
                                <li><div id="foretagReg">Företag registrering</div></li>
                                    <div id="foretagForm" class="formArea2" style="display: none">
                                        <form id="regForetag" action="regForetag.php" method="post">
                                            <input id="Fnamn" type="text" placeholder="Företagsnamn" required>
                                            <input id="adress" type="text" placeholder="Adress" required>
                                            <input id="subForetag" type="submit" value="Spara">
                                        </form>
                                    </div>
                                <li><div id="handledarReg">Handledar registrering</div></li>

                                    <div id="handledarForm" class="formArea2" style="display: none">
                                        <form id="regHandledare" action="regHandledare.php" method="post">
                                            <input id="Hnamn" type="text" placeholder="Förnamn" required>
                                            <input id="Hefternamn" type="text" placeholder="Efternamn" required>
                                            <input id="Hepost" type="email" placeholder="E-post" required>
                                            <input id="telefon" type="text" placeholder="Tel" required>
                                            <input id="losenord" type="password" placeholder="Lösenord" required>
                                            <select id="foretagID" required>
                                                <?php
                                                    $allForetag = foretag($conn);

                                                    echo "<option disabled selected value=''>Välj företag</option>";
                                                    foreach ($allForetag as $f) {
                                                        echo "<option value='".$f['foretagID']."'> ".$f['namn']." </option>";
                                                    }
                                                ?>
                                            </select>
                                            <input id="subHandledare" type="submit" value="Spara">
                                        </form>
                                    </div>

                                <li><div id="periodReg">Period registrering</div></li>

                                    <div id="periodForm" class="formArea" style="display: none">
                                        <form id="regPeriod" method="post">
                                            <input type="text" id="periodnamn" name="periodnamn" placeholder="Period namn" required>
                                            <label for="startDatum">Start Datum</label>
                                            <input type="date" id="startdatum" name="startdatum" required>
                                            <label for="slutDatum">Slut Datum</label>
                                            <input type="date" id="slutdatum" name="slutdatum" onchange="dagPeriod();" required>
                                        
                                            <div id="dagList"></div>
                                        </form>
                                    </div>

                                <li><div id="platsDel1">Koppla period</div></li>

                                <div id="platsDel1Form" class="formArea3" style="display: none">
                                    <form id="regPlats" action="regPlats.php" method="POST">
                                        <div class="periodSelectMenu">
                                            <div class="PeriodP">Period</div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="darkgray" class="arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                            </svg>
                                            <select id="platsKlass" onchange="elevPlatsPeriod();" required>
                                                <option disabled selected value=''> Välj klass </option>
                                                <?php
                                                    $klass=selectTabel($conn,"klass");
                                                    foreach ($klass as $kls) {
                                                        $kl=$kls['klass'];
                                                        echo"<option value='$kl'>$kl</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <select id="platsPeriod" onchange="elevPlatsPeriod();" size="15" required>
                                                <?php
                                                    $allPeriod = allPeriod($conn);
                                                    foreach ($allPeriod as $p) {
                                                        echo "<option value='".$p['periodNamn']."'> ".$p['periodNamn']." </option>";
                                                    }
                                                ?>
                                        </select>
                                        <div id="restElever"></div>
                                        <input id="subPlats" type="submit" value="Spara">
                                    </form>
                                </div>

                                <li><div id="platsDel2">Koppla handledare och företag</div></li>

                                <div id="platsDel2Form" class="formArea" style="display: none">
                                    <form id="regPlatsHand" action="regPlatsHand.php" method="POST">
                                        <select id="foretagPeriod" onchange="handledarPlats();">
                                        <?php
                                            $handledare = allPeriod($conn);
                                            echo "<option disabled selected> Välj Period </option>";
                                            foreach ($handledare as $f) {
                                                echo "<option value='".$f['periodNamn']."'> ".$f['periodNamn']." </option>";
                                            }
                                        ?>
                                        </select>
                                        <div id="platsElever"></div>
                                        <input id="subPlats2" type="submit" value="Spara">
                                    </form>
                                </div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
        <script src="admin.js"></script>
    </html>
    <?php   
} else {
    echo "Please log in first to see this page <br></br>";
}
?>