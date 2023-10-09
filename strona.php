<!DOCTYPE html>
<html lang="en">

<head>
<?php

// sprawdź czy użytkownik jest zalogowany
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // jeśli nie przekieruj na stronę logowania
    header("Location: login.php");
    exit;
}



?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Gralapagos</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
</head>

<body>
    <div class="column">
        <a href="strona.html"><img src="img/logo.png" title="Gralapagos"></a>
        <br>
        <ul>

            <li style="--i:7;"><a href="profil.php">Profil</a></li>
            <li style="--i:6;"><a href="programy.php">Programy</a></li>
            <li style="--i:5;"><a href="komentarze.php">Forum</a></li>
            <li style="--i:4;"><a href="onas.html">O nas</a></li>
            <li style="--i:3;"><a href="czlonkowie.html">Twórcy</a></li>
            <li style="--i:2;"><a href="regulamin.html">Regulamin</a></li>
            <li style="--i:1;"><a href="kontakt.html">Kontakt</a></li>
            <li style="--i:0;"><a href="logout.php">Wyloguj</a></li>
        </ul>   
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <hr style="height: 1px; background: gray; border: 0px;">
        <br>
        <p>Copyright © 2023 GRALAPAGOS</p>
    </div>  

</body>

</html>
	