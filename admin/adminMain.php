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
        deleteElev($conn,$_POST['ID']);
    }
    if (isset($_POST['deletforetag'])) {
        deleteForetag($conn,$_POST['ID']);
    }
    if (isset($_POST['deletplats'])) {
        deletePlats($conn,$_POST['ID']);
    }
    if (isset($_POST['deletperiod'])) {
        deletePeriod($conn,$_POST['ID']);
    }
    if (isset($_POST['deletklass'])) {
        deleteKlass($conn,$_POST['ID']);
    }
    if (isset($_POST['delethandledare'])) {
        deleteHandledare($conn,$_POST['ID']);
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
        <title>Admin</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    <body onload="donutChart(); elever();">
        <div id="wrapper">
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
                <div class="registerKlass">
                    <svg id="classIcon" xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 35.5 35.5">
                        <path d="M3.65,21.88a.73.73,0,0,1-.73-.73V8A3.64,3.64,0,0,1,6.56,4.38H12.4a.73.73,0,1,1,0,1.45H6.56A2.19,2.19,0,0,0,4.38,8V21.15A.73.73,0,0,1,3.65,21.88ZM25.52,19A9.48,9.48,0,1,1,35,9.48,9.49,9.49,0,0,1,25.52,19Zm0-17.5a8,8,0,1,0,8,8A8,8,0,0,0,25.52,1.46Zm0,13.12a.73.73,0,0,1-.73-.73V5.1a.73.73,0,0,1,1.46,0v8.75A.73.73,0,0,1,25.52,14.58Zm4.38-4.37H21.15a.73.73,0,1,1,0-1.46H29.9a.73.73,0,1,1,0,1.46ZM8.75,35a.75.75,0,0,1-.29-.06.73.73,0,0,1-.38-1l4.37-10.2a.73.73,0,1,1,1.34.57L9.42,34.56A.73.73,0,0,1,8.75,35Zm16,0a.73.73,0,0,1-.67-.44L19.75,24.35a.73.73,0,1,1,1.34-.57L25.46,34a.73.73,0,0,1-.38,1A.72.72,0,0,1,24.79,35Zm-8-2.92a.73.73,0,0,1-.73-.73V24.06a.73.73,0,0,1,1.46,0v7.29A.73.73,0,0,1,16.77,32.08Zm16-7.29H.73A.73.73,0,0,1,0,24.06V21.15a.73.73,0,0,1,.73-.73h19a.73.73,0,0,1,0,1.46H1.46v1.45H32.08V21.15a.73.73,0,0,1,1.46,0v2.91A.73.73,0,0,1,32.81,24.79Z"/>
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
                                echo "<thead><tr><th>Elev</th><th>Företag</th><th>Period</th><th>Narvaro</th></tr></thead><tbody>";

                                foreach ($data as $row => $column) {

                                    if (is_null($column['narvaro'])) {
                                        $column['narvaro'] = "null";
                                    }
                                    
                                    $str = ['null', '1', '2', '3'];
                                    $rplc = ['Oanmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];
                        
                                    $column2 = str_replace($str, $rplc, $column);
                                    
                                    echo "<tr><td>";
                                    echo $column['elevID'];
                                    echo "</td><td>";
                                    echo $column['namn'];
                                    echo "</td><td>";
                                    echo $column['periodNamn'];
                                    echo "</td><td>";
                                    echo $column2['narvaro'];
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
                                    colors: ['#77dd77','#ff6961','#FEFE95','gainsboro'],
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
                <input type="submit" name="deletelev" onclick="return confirm('Är du säker?');" value="submit">
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
                                var pls = $('#platsElev').val();
                                $.ajax({
                                    url: 'periodSelect.php',
                                    type: 'POST',
                                    data: {
                                        platsElev: pls
                                    },

                                    success: function(data) {
                                        periodPlats(data);
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
                        <div class="formHolder">
                            <div class="formSelect">
                                <button class="button">Registrera Elev</button>
                                <button class="button2">Registrera Klass</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="views" id="content3" style='display:none'>
                <form action="adminMain.php" method="post">
                <div id="delet2" class="deletbox">
                <input type="submit" name="deletforetag" onclick="return confirm('Är du säker?');" value="submit">
                </div>
                <div id="delet6" class="deletbox">
                <input type="submit" name="delethandledare" onclick="return confirm('Är du säker?');" value="submit">
                </div>
                </form>
                    <!-- FÖRETAG CONTENT HÄR -->
                    <div class="foretagList">
                        <?php
                            $data = foretag($conn);
                        
                            echo "<table class='foretagTable'>";
                            echo "<thead><tr><th>Företag</th><th>Adress</th></tr></thead><tbody>";
                        
                            foreach ($data as $row) {
                                echo "<tr><td>";
                                echo $row['namn'];
                                echo "</td><td>";
                                echo $row['adress'];
                                echo "</td><td>";
                                $foretagID=$row['foretagID'];
                                echo "<button type='button' onclick=\"deletBoxF('$foretagID');\" >...</button>";
                                echo "</td></tr>";
                            }
                            echo "</tbody></table>";
                            ?>
                    </div>
                    <div class="foretagholder">
                    <div class="foretagView">
                        <h1>Klicka på ett företag</h1>
                    </div>
                        <div class="formHolder">
                            <div class="formSelect">
                                <button class="button3">Registrera Företag</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="views" id="content4" style='display:none'>
                <form action="adminMain.php" method="post">
                <div id="delet4" class="deletbox">
                <input type="submit" name="deletperiod" onclick="return confirm('Är du säker?');" value="submit">
                </div>
                </form>
                    <!-- PERIOD CONTENT HÄR -->
                    <h1>Period content här</h1>
                    <?php
                    $period="period";
                        $data = selectTabel($conn,$period);

                        echo "<table class='elevklassTable'>";
                        echo "<thead><tr><th>Period</th><th>Startdatum</th><th>Slutdatum</th></tr></thead>";

                        foreach($data as $row){
                            echo "<tbody><tr><td>";
                            echo $row['periodNamn'];
                            echo "</td><td>";
                            echo $row['startdatum'];
                            echo "</td><td>";
                            echo $row['slutdatum'];
                            echo "</td><td>";
                            $periodID=$row['periodNamn'];
                            echo "<button type='button' onclick=\"deletBoxPr('$periodID');\" >...</button>";
                            echo "</td></tr></tbody>";
                        }
                        echo "</table>";
                    ?>
                </div>

                <div class="views" id="content5" style='display:none'>
                    <div class="elevklass">
                        <!-- KLASS CONTENT HÄR-->
                        <h1>Klass</h1>
                    <?php

                        $data = elevKlass($conn);

                        echo "<table class='elevklassTable'>";
                        echo "<thead><tr><th>ElevID</th><th>Period</th></tr></thead>";

                        foreach($data as $row){
                            echo "<tbody><tr><td>";
                            echo $row['elevID'];
                            echo "</td><td>";
                            echo $row ['periodNamn'];
                            echo "</td></tr></tbody>";
                        }
                        echo "</table>";
                    ?>
                    </div>
                </div>
                <div class="views" id="content6" style='display:none'>
                <form action="adminMain.php" method="post">
                    <div id="delet3" class="deletbox">
                    <input type="submit" name="deletplats" onclick="return confirm('Är du säker?');" value="submit">
                    </div>
                </form>
                <form class="uppdatebox" id="regPl" action="regPlats.php" method="POST">
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
                                $foretag = foretag($conn);
                                echo "<option disabled selected> Välj Företag </option>";
                                foreach ($foretag as $f) {
                                    echo "<option value='".$f['foretagID']."'> ".$f['namn']." </option>";
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
                            <input id="subPl" type="submit" value="Spara">
                        </form>
                <div class="platsList">
                        <div>
                            <?php
                                $platser = elevPlats($conn);

                                echo "<table class='platsTable'>";
                                echo "<thead><tr><th>Elev</th><th>Företag</th></tr></thead><tbody>";
                            
                                foreach ($platser as $row) {
                                    echo "<tr><td>";
                                    echo $row['elevID'];
                                    echo "</td><td>";
                                    echo $row['namn'];
                                    echo "</td><td>";
                                    $platsID=$row['platsID'];
                                    $elevID=$row['elevID'];
                                    $periodNamn=$row['periodNamn'];
                                    $foretagID=$row['foretagID'];
                                    echo "<button type='button' onclick=\"deletBoxP('$platsID');\" >...</button>";
                                    //echo '<button type="button" onclick="updateBP('.$elevID.',\''.$periodNamn.','.$foretagID.'\');" >uppp</button>';
                                    echo "<button type='button' onclick=\"updateBP('$elevID','$foretagID','$periodNamn');\" >uppp</button>";
                                    echo "</td></tr>";
                                }
                                echo "</tbody></table>";
                            ?>
                        </div>
                    </div>
                        
                    <div class="plats">
                        <!-- PLATS CONTENT HÄR -->
                        <h1>Registrera Plats</h1>
                        
                    </div>
                </div>
                <div class="views" id="content7" style='display:none'>
                    <div class="row1">
                        <!--Row Holder-->
                        <div id="elevReg" class="registerBox">
                            <h1>Register Elev</h1>
                            <div class="formArea" style="display: none">
                                <form id="regElev" action="regElev.php" method="POST">
                                    <input id="namn" type="text" placeholder="Förnamn">
                                    <input id="efternamn" type="text" placeholder="Efternamn">
                                    <input id="epost" type="text" placeholder="E-post">
                                    <input id="nummer" type="tel" placeholder="Nummer">
                                    <input id="elevKlass" type="text" placeholder="Klass">
                                    <input id="subElev" type="submit" namn="sub" value="Spara">
                                    <select id="periodN" name="periodN">
                                <?php
                                $pt="period";
                                $peri = selectTabel($conn,$pt);
                                    foreach ($peri as $p) {
                                        echo "<option value='".$p['periodNamn']."'> ".$p['periodNamn']." </option>";
                                    }
                                ?>
                            </select>
                                </form>
                                <!--<form id="regKlass" action="regKlass.php" method="POST">
                                    <input id="klassNamn" type="text" placeholder="Klass">
                                    <input id="subKlass" type="submit" value="Spara">
                                </form>-->
                            </div>
                        </div>
                        <div id="foretagReg" class="registerBox">
                            <h1>Register Handledare</h1>
                            <div class="formArea2" style="display: none">
                                <form id="regForetag" action="regForetag.php" method="post">
                                    <input id="Hfornamn" type="text" placeholder="Förnamn">
                                    <input id="Hefternamn" type="text" placeholder="Efternamn">
                                    <input id="Hepost" type="text" placeholder="E-post">
                                    <input id="Htelefon" type="tel" placeholder="Telefon">

                                    <input id="Fnamn" type="text" placeholder="Företagsnamn">
                                    <input id="losenord" type="password" placeholder="Lösenord">
                                    <input id="adress" type="text" placeholder="Adress">
                                    <input id="subForetag" type="submit" value="Spara">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row2">
                        <div class="registerBox">
                            <h1>Register Period</h1>
                            <form id="regPeriod" method="post">
                                <input type="text" id="periodnamn" placeholder="namn" required>
                                <input type="date" id="startdatum" required>
                                <input type="date" id="slutdatum" required>
                                <input type="submit" value="submit" id="submin">
                            </form>
                        <div id="dagList"></div>
                        </div>
                        <div class="registerBox">
                            <h1>Register Plats</h1>
                            <form id="regPlats" action="regPlats.php" method="POST">
                            <select id="platsElev" onchange="elevPlatsPeriod();">
                            <?php
                                $allElev = allElev($conn);

                                echo "<option disabled selected> Välj Elev </option>";
                                foreach ($allElev as $e) {
                                    echo "<option value='".$e['elevID']."'> ".$e['elevID']." </option>";
                                }
                            ?>
                            </select>
                            <select id="platsForetag">
                            <?php
                                $foretag = foretag($conn);
                                echo "<option disabled selected> Välj Företag </option>";
                                foreach ($foretag as $f) {
                                    echo "<option value='".$f['foretagID']."'> ".$f['namn']." </option>";
                                }
                            ?>
                            </select>
                            <select id="platsPeriod">
                            <?php
                                $allPeriod = allPeriod($conn);
                                echo "<option disabled selected> Välj Period </option>";
                                foreach ($allPeriod as $p) {
                                    echo "<option value='".$p['periodNamn']."'> ".$p['periodNamn']." </option>";
                                }
                            
                            echo'</select>'
                            ?>
                            <input id="subPlats" type="submit" value="Spara">
                        </form>
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