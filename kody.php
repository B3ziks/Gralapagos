<?php
// Start the session and retrieve the user ID
session_start();
$user_id = $_SESSION["id"];

// Redirect to the login page if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Connect to the database
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch used codes from the user_games table
$query = "SELECT game_name, game_code FROM user_games WHERE user_id = ? AND used = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($game_name, $code); // Update the bind_result to include both game_name and code

?>

<!DOCTYPE html>
<html>
<head>
  <title>View Codes</title>
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
        background-color: #2e3133;
        padding: 24px;
        border-radius: 20px;
        margin: 0 auto;
        text-align: center;
        color: black;
    }

    h1 {
        color: #b58adb;
    }

    table {
        width: 100%;
        margin-top: 32px;
        color: #b58adb;
    }

    th, td {
        padding: 8px;
        text-align: center;
    }

    thead {
        background-color: #b58adb;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: #ebebeb;
    }

    a.btn-primary {
        text-decoration: none;
        color: white !important;
    }
  </style>
<body>
<div class="container">
  <h1>Twoje Dostępne Kody</h1>

  <?php
  // Display the codes if any are found
  if ($stmt->num_rows > 0) {
      echo "<table>";
      echo "<thead><tr><th>Code</th><th>Name</th></tr></thead>";
      echo "<tbody>";
      while ($stmt->fetch()) {
          echo "<tr><td>$code</td><td>$game_name</td></tr>";
      }
      echo "</tbody>";
      echo "</table>";
  } else {
      echo "Brak kodów";
  }
  ?>

  <br>
  <br>
  <a class="btn btn-primary" style="background-color:#434750; color:#27fefb; border-color:#b58adb;" href="profil.php">Wróć do profilu</a>
</div>
</body>
</html>