<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <form action="adminLogin.php" method="POST">
        <input class="input-box" type="text" name="username" placeholder="Admin användarnamn"/>
        <input class="input-box" type="password" name="password" placeholder="Admin lösenord"/>
        <input class="submit" type="submit" name="submit" value="Logga in"/>
    </form>
</body>
</html>