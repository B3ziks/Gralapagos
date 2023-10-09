<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Database credentials
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'gralapagos');
    define('DB_PASSWORD', 'Dzionselka1');
    define('DB_NAME', 'gralapagos');

    // Attempt to connect to MySQL database
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Define variable to hold games
    $games = array();

    // Get games from database
    $sql = "SELECT id, name, photo, price, description, publisher, sale_price FROM games";

    if ($result = mysqli_query($link, $sql)) {
        // Fetch games from result set
        while ($row = mysqli_fetch_assoc($result)) {
            $games[] = $row;
        }

        // Free result set
        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
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
        h5 {
            color: #b58adb;
            display: flex;
            flex-direction: column;
            background-color: #2e3133;
            padding: 24px;
            border-radius: 20px;
            margin: 0 auto;
            text-align: center;
            color: black;
        }

        h2 {
            color: white;
        }
    </style>
</head>

<body>
    <center>

        <a href="strona.php"><img src="img/logo-male.png" title="Gralapagos"></a>
        <a href="strona.php"><button class="powrot">⮜</button></a>

        
                                    <?php
                                    // Start the session
                                    session_start();

                                    // Check if the user is logged in
                                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                        // Get the user role from the session
                                        $user_role = $_SESSION["role"];


    // Check if the user is an admin
    if ($user_role === "admin") {
// Display the admin form
echo '
<h5>
            <div class="container">
                <div class="main-card">
                    <div class="cards">
                        <div class="card">
                            <div class="content">
                                <div class="details">
<h5>
<form action="add_game.php" method="post" enctype="multipart/form-data">
<label style="color:#b58adb;" for="name">Nazwa:</label>
<input type="text" name="name" id="name"><br><br>

                                    <label style="color:#b58adb;" for="photo">Zdjęcie:</label>
                                <input type="file" name="photo" id="photo"><br><br>

                                <label style="color:#b58adb;" for="publisher">Wydawca:</label>
                                <input type="text" name="publisher" id="publisher"><br><br>

                                <label style="color:#b58adb;" for="description">Opis:</label>
                                <input type="text" name="description" id="description"><br><br>

                                <label style="color:#b58adb;" for="price">Cena:</label>
                                <input type="text" name="price" id="price"><br><br>

                                <label style="color:#b58adb;" for="sale_price">Cena (promocja):</label>
                                <input type="text" name="sale_price" id="sale_price"><br><br>

                                <input class="btn btn-primary" style="background-color:#b58adb; color:#27fefb; border-color:#b58adb;" type="submit" value="Dodaj grę">
                            </form>
    </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </h5>';
                                    } else {
                                         echo' <form action="koszyk.php" method="post">
            <input class="btn btn-dark" style="border: 0;
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
            cursor: pointer;" type="submit" value="Przejdź do koszyka">
        </form>';

                                    }
}


                                ?>
        

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <h1>Nasze oferty!</h1>
	
		<!-- GRA NASZA -->
	<div class="container">
      <div class="main-card">
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="details">
              </div>
              <div>
			  <!--tutaj dać link do gry !WAZNE! -->
                <a href="gra11.html" title="Oskar runner">
				<p>Wypróbuj demo gry studia AMOFW</p>
				<!-- Dodać zdjęcie gry !WAZNE! -->
                  <img class="zdjecie" src="img/gra-oskar.png">
                </a>
                <b>Oskar Runner</b>
                <br>
				<!--tutaj dać link do gry !WAZNE! -->
                <a href="gra11.html"><button>Wypróbuj za darmo</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="main-card">
        <div class="cards">
          <div class="card">
            <div class="content">
              <div class="details">
              </div>
              <div>
<?php
// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'gralapagos');
define('DB_PASSWORD', 'Dzionselka1');
define('DB_NAME', 'gralapagos');

// Create a connection to the database
$conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

// Check if there are games
if (count($games) > 0) {
    // Loop through games and display them
    foreach ($games as $game) {
        echo "<div>";
        echo "<h2>" . $game['name'] . "</h2>";

 // Select the image data from the database
        $stmt = $conn->prepare("SELECT photo, description, publisher FROM games WHERE id = :id");
        $stmt->execute(['id' => $game['id']]);
        $result = $stmt->fetch();

        // Check if image data exists
        if ($result && $result['photo']) {
            // Display the image
            $img = base64_encode($result['photo']);
            echo "<img src='data:image/jpeg;base64, " . $img . "' style=' width: 100px; height: 150px;' />";

        } else {
            // Display a default image
            echo "<img src='default-image.jpg' />";
        }

  // Display the description and publisher information
  echo "<p>Wydawca: " . $result['publisher'] . "</p>";
        if ($game['sale_price'] != 0.00) {
    echo "<p><strike>" . $game['price'] . "</strike> " . $game['sale_price'] . "zł"."</p>";
} else {
    echo "<p>" . $game['price'] . "zł" ."</p>";
}
       echo "<a href='game_details.php?id=" . $game['id'] . "'><button>Kup teraz!</button></a>";


        echo "</div>";
    }
} else {
    echo "<p>No games found.</p>";
}
?>
</body>

</html>		