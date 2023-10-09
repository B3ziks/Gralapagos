<?php
// zacznij sesję i zdobądź ID użytkownika
session_start();
$user_id = $_SESSION["id"];

// wróć na stronę logowania
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Połącz z bazą danych
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Sprawdź połaczenie
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user details from database
$query = "SELECT username, email, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($username, $email, $profile_picture);
$stmt->fetch();

if ($stmt->num_rows > 0) {
    $stmt->fetch();
} else {
    echo "No results found.";
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Profil</title>
    
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styleo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link rel="icon" href="img/logo.png" type="image/x-icon">

</head>
<style>
    body, html {
        background-color: #434750;
        padding: 4% 10% 8% 10%;
        color: #434750;
        font-family: 'Josefin Sans';
    }

    .container {
        display: flex;
        flex-direction: column;
        background-color: #2e3133 	;
        padding: 24px;
        border-radius: 20px;
        margin: 0 auto;
        text-align: center;
        color:black;
        font-family: 'Josefin Sans';
    }

    h2 {
        font-size: 32px;
        line-height: 40px;
        font-weight: 500;
        margin-bottom: 0;
        color:#b58adb;
        font-family: 'Josefin Sans';
    }

    .podsumowanie {
        margin-top: 32px;
    }

    a.bg-primary {
        text-decoration: none;
        color: white !important;
        font-family: 'Josefin Sans';
    }

    h1 {
        color: #b58adb;
        font-family: 'Josefin Sans';
    }

    label {
        color: #b58adb;
        font-family: 'Josefin Sans';
    }

    th {
        color: #b58adb;
        font-family: 'Josefin Sans';
    }

    thead {
        color: #b58adb;
        font-family: 'Josefin Sans';
    }

    tbody {
        color: #b58adb;
        font-family: 'Josefin Sans';
    }

    button {
        color:#27fefb;
        background-color: #b58adb;
        font-family: 'Josefin Sans';
    }

    h3 {
        color: #b58adb;
        font-family: 'Josefin Sans';
    }

    h4 {
        color: #b58adb;
        font-family: 'Josefin Sans';
    }

</style>
<body>
<div class="container">
  <h1>Profil</h1><br>
  <div>
    <h3>
      Login: <?php echo $username; ?><br><br>
      E-mail: <?php echo $email; ?><br><br>
    </h3>

    <?php
    // Check if profile picture is available
    if (!empty($profile_picture)) {
        echo "<img src='data:image/jpeg;base64," . base64_encode($profile_picture) . "' alt='Profile Picture' style='width: 300px; height: 300px;' />";
    } else {
        echo "<h4></h4><br>";
    }
    ?>


    <form action="zmiana_hasla.php" method="post">
    <input class="btn btn-dark" style="  border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #27fefb;
    padding: 14px 40px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    font-family: 'Josefin Sans';
    cursor: pointer;"type="submit" value="Zmiana Hasła">
    </form>


 <form action="kody.php" method="post">
    <input class="btn btn-dark" style="  border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #27fefb;
    padding: 14px 40px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    font-family: 'Josefin Sans';
    cursor: pointer;"type="submit" value="Twoje Kody">
    </form>
 <form action="zakup.php" method="post">
    <input class="btn btn-dark" style="  border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #27fefb;
    padding: 14px 40px;
    outline: none;
    font-family: 'Josefin Sans';
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer;"type="submit" value="Wygeneruj nieużyte kody">
    </form>

  <a class="btn btn-primary" style="background-color:#434750; color:#27fefb; border-color:#b58adb; font-family: 'Josefin Sans';"  href="logout.php">Wyloguj</a> </center>
      <br>
    <form action="strona.php" method="post">
    <input class="btn btn-dark" style="  border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #27fefb;
    padding: 14px 40px;
    outline: none;
    font-family: 'Josefin Sans';
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer;"type="submit" value="Cofnij">
    </form>
<br><br>
</body>
</div>
</html>







