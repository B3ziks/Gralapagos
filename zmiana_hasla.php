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


?>



<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
</head>
<style>
    body, html {
            background-color: #434750;
            padding: 4% 10% 8% 10%;
            color: #434750;
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
    }

    h2 {
      font-size: 32px;
      line-height: 40px;
      font-weight: 500;
      margin-bottom: 0;
	   color:#b58adb;
    }

    .podsumowanie {
      margin-top: 32px;
    }

    a.bg-primary{
      text-decoration: none;
      color: white !important;
	 
    }
	
	h1 {
	color: #b58adb;
	
	}
	
	label{
	color: #b58adb;
	}
	th{
	color: #b58adb;
	}
	thead{
	color: #b58adb;}
	tbody{
	color: #b58adb;
	}
	button{
	color:#27fefb;
	background-color: #b58adb;
	}
	{
	background-color:#b58adb;
	}
	h3{
		color: #b58adb;
	}
	h4{
		color: #b58adb;
	}

  </style>
<body>
<div class="container">


  <h3>Zmiana hasła</h3>
  <center><form method="post" action="change_password.php">
    <label for="oldPassword">Stare hasło:</label>
    <input type="password" name="oldPassword" id="oldPassword"><br><br>

    <label for="newPassword">Nowe hasło:</label>
    <input type="password" name="newPassword" id="newPassword"><br><br>

    <label  for="confirmPassword">Potwierdź hasło:</label>
    <input  type="password" name="confirmPassword" id="confirmPassword"><br><br>

    <input class="btn btn-primary" style="background-color:#b58adb; color:#27fefb; border-color:#b58adb;" type="submit" value="Zmień hasło">
  </form>
<?php
// Display change password messages if available
if (isset($_SESSION["change_password_error"])) {
    echo "<p>Error: " . $_SESSION["change_password_error"] . "</p>";
    unset($_SESSION["change_password_error"]);
}

if (isset($_SESSION["change_password_success"])) {
    echo "<p>Success: " . $_SESSION["change_password_success"] . "</p>";
unset($_SESSION["change_password_success"]);
}
?>


<br>
<br>

    <form action="profil.php" method="post">
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
    cursor: pointer;"type="submit" value="Cofnij">
    </form>
</body>
</div>
</html>


