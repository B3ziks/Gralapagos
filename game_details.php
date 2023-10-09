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
  <link rel="stylesheet" href="stylepro.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <title>Gralapagos</title>
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <style>
  h2{color: white;}
  </style>
</head>

<body>
  <center>

	<a href="programy.php"><img src="img/logo-male.png" title="Gralapagos"></a>
	<a href="programy.php"><button class="powrot">⮜</button></a>

       


    <div class="container">
      <div class="main-card">
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="details">
              </div>
              <div>

</body>

</html>	
<?php

// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'gralapagos');
define('DB_PASSWORD', 'Dzionselka1');
define('DB_NAME', 'gralapagos');

// Create a connection to the database
$conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

// Check if game ID was provided in the URL
if (!isset($_GET['id'])) {
    header("Location: games.php");
    exit();
}

$game_id = $_GET['id'];

// Retrieve game details from the database
$stmt = $conn->prepare("SELECT * FROM games WHERE id = :id");
$stmt->execute(['id' => $game_id]);
$game = $stmt->fetch();

// Check if game exists
if (!$game) {
    header("Location: programy.php");
    exit();
}

// Display the game details
echo "<h2>" . $game['name'] . "</h2>";

// Display the image
if ($game['photo']) {
    $img = base64_encode($game['photo']);
    echo "<img src='data:image/jpeg;base64, " . $img . "' width='100' height='200' />";
} else {
    echo "<img src='default-image.jpg' width='100' height='200' />";
}


        if ($game['sale_price'] != 0.00) {
    echo "<p><strike>" . $game['price'] . "</strike> " . $game['sale_price'] . "zł"."</p>";
} else {
    echo "<p>" . $game['price'] . "zł" ."</p>";
}
  // Display the description and publisher information
  echo "<p>Wydawca: " . $game['publisher'] . "</p>";
  echo "<p>Opis: " . $game['description'] . "</p>";

                                 // Add the game to the cart
                                echo "<form method='post' action='koszyk.php'>";
                                echo "<input type='hidden' name='id' value='" . $game['id'] . "'>";
                                echo "<input type='hidden' name='name' value='" . urlencode($game['name']) . "'>";
                                echo "<input type='hidden' name='price' value='" . urlencode($game['price']) . "'>";
                                echo "<button type='submit'>Kup teraz!</button>";
                                echo "</form>";





        echo "</div>";
?>