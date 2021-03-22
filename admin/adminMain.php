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
                    <svg xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 55 59">
                       <path d="M33.48,9.52,57,32.07V59H41.76V40l-4.07.07L29,40.24l-3.88.07-.05,3.88L24.91,59H10V31.7L33.48,9.52M33.5,4,6,30V63H28.86l.23-18.76,8.67-.15V63H61V30.36L33.5,4Z" transform="translate(-6 -4)"/>
                    </svg>
                </div>
                <div class="registerElev">
                    <svg xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 512 511">
                        <path d="M428.16,387.74V303.91H388.24v83.83H304.4v39.93h83.84V511.5h39.92V427.67H512V387.74ZM255.5.5C174.05.5,107.79,66.76,107.79,148.21a147.65,147.65,0,0,0,64.14,121.72A255.92,255.92,0,0,0,0,511.5H39.92c0-118.87,96.71-215.58,215.58-215.58,81.45,0,147.71-66.26,147.71-147.71S337,.5,255.5.5Zm0,255.5A107.79,107.79,0,1,1,363.29,148.21,107.91,107.91,0,0,1,255.5,256Z"/>
                    </svg>
                </div>
                <div class="registerForetag">
                    <svg xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white"  viewBox="0 0 35 35">
                        <path d="M23.33,21.88a2.92,2.92,0,1,1-2.91,2.91A2.91,2.91,0,0,1,23.33,21.88Zm1.83,7.29H21.51a4,4,0,0,0-4,4v.73A1.09,1.09,0,0,0,18.59,35h9.48a1.09,1.09,0,0,0,1.1-1.09v-.73A4,4,0,0,0,25.16,29.17Zm8.75-3.28h-.73v-.73a1.1,1.1,0,1,0-2.19,0v.73h-.73a1.09,1.09,0,0,0,0,2.18H31v.73a1.1,1.1,0,1,0,2.19,0v-.73h.73a1.09,1.09,0,1,0,0-2.18ZM2.19,28.44V24.06H17.57a6,6,0,0,1,.74-2.18h-1.9V19.32H12.76a1.09,1.09,0,1,1,0-2.18h3.65V15H12.76a1.1,1.1,0,0,1,0-2.19h3.65V10.57H12.76a1.09,1.09,0,0,1,0-2.18h3.65V6.2H12.76a1.1,1.1,0,0,1,0-2.19h3.65V1.09A1.09,1.09,0,0,0,15.31,0H8A1.09,1.09,0,0,0,6.93,1.09V4H4A1.09,1.09,0,0,0,2.92,5.1V21.88H1.09A1.09,1.09,0,0,0,0,23v6.56a1.09,1.09,0,0,0,1.09,1.1h14a6.92,6.92,0,0,1,1.41-2.19ZM5.1,6.2H6.93V8.39H5.1Zm0,4.37H6.93v2.19H5.1ZM5.1,15H6.93v2.19H5.1Zm0,4.37H6.93v2.56H5.1Z" transform="translate(0)"/>
                    </svg>
                </div>
                <div class="registerPeriod">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="white" class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                </div>
                <div class="registerKlass">
                    <svg xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 35.5 35.5">
                        <path d="M3.65,21.88a.73.73,0,0,1-.73-.73V8A3.64,3.64,0,0,1,6.56,4.38H12.4a.73.73,0,1,1,0,1.45H6.56A2.19,2.19,0,0,0,4.38,8V21.15A.73.73,0,0,1,3.65,21.88ZM25.52,19A9.48,9.48,0,1,1,35,9.48,9.49,9.49,0,0,1,25.52,19Zm0-17.5a8,8,0,1,0,8,8A8,8,0,0,0,25.52,1.46Zm0,13.12a.73.73,0,0,1-.73-.73V5.1a.73.73,0,0,1,1.46,0v8.75A.73.73,0,0,1,25.52,14.58Zm4.38-4.37H21.15a.73.73,0,1,1,0-1.46H29.9a.73.73,0,1,1,0,1.46ZM8.75,35a.75.75,0,0,1-.29-.06.73.73,0,0,1-.38-1l4.37-10.2a.73.73,0,1,1,1.34.57L9.42,34.56A.73.73,0,0,1,8.75,35Zm16,0a.73.73,0,0,1-.67-.44L19.75,24.35a.73.73,0,1,1,1.34-.57L25.46,34a.73.73,0,0,1-.38,1A.72.72,0,0,1,24.79,35Zm-8-2.92a.73.73,0,0,1-.73-.73V24.06a.73.73,0,0,1,1.46,0v7.29A.73.73,0,0,1,16.77,32.08Zm16-7.29H.73A.73.73,0,0,1,0,24.06V21.15a.73.73,0,0,1,.73-.73h19a.73.73,0,0,1,0,1.46H1.46v1.45H32.08V21.15a.73.73,0,0,1,1.46,0v2.91A.73.73,0,0,1,32.81,24.79Z"/>
                    </svg>
                </div>
                <div class="registerPlats">
                    <svg xmlns="http://www.w3.org/2000/svg" height="23" width="23" fill="white" viewBox="0 0 43.95 50">
                        <path d="M22.07,8.79a10.24,10.24,0,0,0-7.69,17A8.25,8.25,0,0,1,18,21.67a5.32,5.32,0,0,1-1.31-3.51,5.37,5.37,0,1,1,9.44,3.51,8.35,8.35,0,0,1,3.63,4.14,10.24,10.24,0,0,0-7.7-17Zm0,6.93a2.45,2.45,0,1,1-2.44,2.44A2.44,2.44,0,0,1,22.07,15.72Zm0,7.82a5.36,5.36,0,0,0-5.26,4.3,10.21,10.21,0,0,0,10.52,0A5.35,5.35,0,0,0,22.07,23.54Zm16.11,8.78A8.79,8.79,0,1,0,47,41.11,8.8,8.8,0,0,0,38.18,32.32Zm2.93,10.26H39.65V44a1.47,1.47,0,1,1-2.93,0V42.58H35.25a1.47,1.47,0,0,1,0-2.93h1.47V38.18a1.47,1.47,0,0,1,2.93,0v1.47h1.46a1.47,1.47,0,1,1,0,2.93ZM38,29.4a18.92,18.92,0,0,0,3.08-9.12A19.25,19.25,0,0,0,32.35,3,19.08,19.08,0,0,0,3.07,20.28a18.87,18.87,0,0,0,3.71,10l14.11,19.1a1.47,1.47,0,0,0,2.36,0l3.69-5a11.55,11.55,0,0,1-.48-3.3A11.73,11.73,0,0,1,38,29.4ZM22.07,32.23A13.19,13.19,0,1,1,35.26,19,13.2,13.2,0,0,1,22.07,32.23Z" transform="translate(-3.03 0)"/>
                    </svg>
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
                            echo "<tr><th>Elev</th><th>Period</th><th>Företag</th><th>Närvaro</th></tr>";

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