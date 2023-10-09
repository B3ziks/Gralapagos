<?php
// zacznij sesję i zdobądź ID użytkownika
session_start();
$user_id = $_SESSION["id"];

// wróć na stronę logowania
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    h2 {
      font-size: 32px;
      line-height: 40px;
      font-weight: 500;
      margin-bottom: 0;
      color: #b58adb;
    }

    button {
      color: #27fefb;
      background-color: #b58adb;
      border-color: #b58adb;
    }

    p {
      color: white;
    }
  </style>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styleko.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <title>Udany zakup</title>
</head>

<body>
  <a href="strona.php"><button class="powrot">⮜</button></a>

  <div class="container">
    <div class="main-card">
      <div class="cards">
        <div class="card">
          <div class="content">
            <div class="details">
              <br>
              <div class="job">Udało Ci się zakupić produkt!</div><br>
              <div class="inputBox">
                <h2>Wygeneruj klucz:</h2>
                <select id="gameSelect" name="gameSelect">
                  <!-- Options will be dynamically populated using JavaScript -->
                </select>
                <input type="text" name="" placeholder="Klucz" id="password" readonly>
                <button onclick="generateKey()">Wygeneruj kod</button>
              </div>
            </div>
          </div>
          <p style="color:white; text-align:center;"><br>Produkt należy aktywować na platformie Steam w zakładce "dodaj grę".</p>
        </div>
      </div>
    </div>
<a href="profil.php"><button class="powrot">Profil</button></a>
  </div>

  <script>
    // Fetch product names from the server
    function fetchProductNames() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "fetch_product_names.php", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var productNames = JSON.parse(xhr.responseText);
            populateProductNames(productNames);
          } else {
            console.log("Error fetching product names: " + xhr.responseText);
          }
        }
      };
      xhr.send();
    }

    // Populate product names in the select element
    function populateProductNames(productNames) {
      var gameSelect = document.getElementById("gameSelect");

      for (var i = 0; i < productNames.length; i++) {
        var gameName = productNames[i];
        var option = document.createElement("option");
        option.value = gameName;
        option.text = gameName;
        gameSelect.appendChild(option);
      }
    }

    // Generate key and update the textbox
    function generateKey() {
      var gameSelect = document.getElementById("gameSelect");
      var gameName = gameSelect.value;

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "generuj_kod.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = xhr.responseText;
            var passwordTextbox = document.getElementById("password");
            passwordTextbox.value = "Pomyślnie wygenerowano kod, znajdziesz go w profilu";
          } else {
            console.log("Error generating key: " + xhr.responseText);
          }
        }
      };

      xhr.send("game_name=" + encodeURIComponent(gameName));
    }

    // Call the fetchProductNames function to populate the select element
    fetchProductNames();
  </script>
</body>

</html>