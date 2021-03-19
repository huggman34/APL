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
                    <img src="icons/home.svg"></img>
                </div>
                <div class="registerElev">
                    <img src="icons/add-user.svg"></img>
                </div>
                <div class="registerForetag">
                    <img src="icons/supervisor.svg"></img>
                </div>
                <div class="registerPeriod">
                    <img src="icons/add-event.svg"></img>
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

            </div>
        </div>
    </body>
    </html>

    <?php   
} else {
    echo "Please log in first to see this page <br></br>";
}
?>