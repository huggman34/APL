<?php
    require_once "../loginFunctions.php";
    require_once "../connection.php";
    require_once '../RegisterFunctions.php';

    session_start();

if(checkAdminLogin()) {
    $username = $_SESSION['username'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="admin.css">
        
        <title>Admin</title>
    </head>
    <body>
        <div id="wrapper">
            <div class="navbar">
                <div class="logo"></div>
                <div class="home">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="67" height="67" viewBox="0 0 67 67">
                        <image id="Lager_1" data-name="Lager 1" x="6" y="4" width="55" height="59" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADcAAAA7CAYAAADfGRI9AAABxElEQVRoge3ZP07DMBTH8R+IgbEXQarExNRujGyslBvACaAnKDfgCByhNwCOwIoYKEIMSEhBrvIQpHbsl9jxe8VfyarUP7E/StMqCQZqBGAJoKofR5xpq6paD4kZyEMNo/HAARLu95CQDcYC2mASkG2wYKAPlwMaAgsCSsO1wW65QA4uNbANNqvfM+MApeBCYFQwUAKOA2MBc+O6wIKBOXF9YCHA/Vy4GDAf8B7A2dC4mDAf8AvA6VC4FDAf8BPASWpcSlgI8DgVbggY5QJ+AJjGBg4J8wHfARzFwuWAUS7gCsChxj3WzAV8AXDQ9TiTAKNcwGcA59yNSYJRrLMJVxJhVC+gZBjVCagBRrGAmmBUEFAjjPIC75TCKBfQuH4uc2uEUTagcW3gFiKWy2/RxO1aNvEmXeFoY9023NZUcForOK3tJVj3mHtbuM6cXT/GXEhsnPmvuejx+RsAl7EWE/tr2QcW4/N/Kj8oWkuNmwPYaRnzlJOXPae1gtNawWmt4LRWcForOK39u8sMEwDXGdZCdZ170nzChpvWI1dXsebd+mNulXD7T57Xo17tarR2mUtxtttYfcYr425R8+5MjLEEMP4Grqx05eD1igEAAAAASUVORK5CYII="/>
                    </svg>
                </div>
                <div class="registerElev">
                    <img src="icons/add-user.svg"></img>
                </div>
                <div class="registerForetag">
                    <svg id="bold" height="35" viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><circle fill="white" cx="16" cy="17" r="2"/><path fill="white" d="m17.25 20h-2.5c-1.517 0-2.75 1.233-2.75 2.75v.5c0 .414.336.75.75.75h6.5c.414 0 .75-.336.75-.75v-.5c0-1.517-1.233-2.75-2.75-2.75z"/><path fill="white" d="m23.25 17.75h-.5v-.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75v.5h-.5c-.414 0-.75.336-.75.75s.336.75.75.75h.5v.5c0 .414.336.75.75.75s.75-.336.75-.75v-.5h.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"/><path fill="white" d="m1.5 19.5v-3h4 5 1.551c.069-.542.242-1.047.506-1.5h-1.307v-1.75h-2.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h2.5v-1.5h-2.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h2.5v-1.5h-2.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h2.5v-1.5h-2.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h2.5v-2c0-.414-.336-.75-.75-.75h-5c-.414 0-.75.336-.75.75v2h-2c-.414 0-.75.336-.75.75v11.5h-1.25c-.414 0-.75.336-.75.75v4.5c0 .414.336.75.75.75h9.594c.224-.562.552-1.067.961-1.5zm2-15.25h1.25v1.5h-1.25zm0 3h1.25v1.5h-1.25zm0 3h1.25v1.5h-1.25zm0 3h1.25v1.75h-1.25z"/></svg>
                </div>
                <div class="registerPeriod">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                </div>
                <div class="registerKlass">
                    <img src="icons/add-class.svg"></img>
                </div>
                <div class="registerPlats">
                    <img src="icons/add-location.svg"></img>
                </div>
            </div>
            <div class="menu">
                <div class="admin">
                    <img src="icons/user.svg">
                </div>
            </div>
            <div class="views">
                <div class="narvaro">
                    <h1>Närvaro</h1>
                        <?php
                            $sql = "SELECT plats.elevID, foretag.namn, plats.periodNamn, dag.datum, narvaro.narvaro
                            FROM narvaro
                            INNER JOIN plats ON plats.platsID = narvaro.platsID
                            INNER JOIN foretag ON foretag.foretagID = plats.foretagID
                            INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
                            INNER JOIN dag ON dag.dagID = perioddag.dagID
                            WHERE dag.datum = CURRENT_DATE";

                            $result = mysqli_query($conn, $sql);
                            $data = $result->fetch_all(MYSQLI_ASSOC);

                            echo "<table class='narvaroTable'>";
                            echo "<tr><th>Elev</th><th>Period</th><th>Företag</th><th>Narvaro</th></tr>";

                            foreach ($data as $row) {
                                echo "<tr><td>";
                                echo $row['elevID'];
                                echo "</td><td>";
                                echo $row['periodNamn'];
                                echo "</td><td>";
                                echo $row['namn'];
                                echo "</td><td>";
                                echo $row['narvaro'];
                            }
                            echo "</table>";
                        ?>
                </div>
            </div>
        </div>
    </body>
    </html>

    <?php   
} else {
    echo "Please log in first to see this page <br></br>";
}
?>