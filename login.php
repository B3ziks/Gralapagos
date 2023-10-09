<!DOCTYPE html>
<html>
<head>
<?php
// Rozpocznij sesję
session_start();
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link rel="icon" href="img/logo.png" type="image/x-icon">
</head>
	<style>
	* {
    font-family: 'Josefin Sans', sans-serif;
}

body {
    margin: 0;
    padding: 0;
    font-family: sans-serify;
    background: #434750;
}

.box {
    width: 300px;
    padding: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #3e3f46;
    text-align: center;
}

.box h1 {
    color: white;
    text-transform: uppercase;
    font-weight: 500;
}


.box input[type="text"],
.box input[type="password"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #9669be;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
}

.box input[type="text"]:focus,
.box input[type="password"]:focus {
    width: 280px;
    border-color: #27fefb;
}

.box button[type="button"] {
    border: 0;
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
    cursor: pointer;
}

.box button[type="button"]:hover {
    background: #27fefb;
}

.powrot {
    border: 0;
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
    cursor: pointer;
}

p {
color: white;
}
h2{
color: #27fefb;
}
	</style>
	
	
<body>
<center>

<div class="box">
<h2>Zaloguj się</h2><br>
<form action="login.php" method="post">
<br>
<div class="form-group">
    <br><br>
    <label for="login"><p>Login</p></label><br>
    <input type="text" class="form-control" id="username" placeholder="Wpisz login" name="username" required><br>
</div>

<div class="form-group">
    <label for="password"><p>Hasło</p></label><br>
    <input type="password" class="form-control" id="password" placeholder="Wpisz hasło" name="password" required><br>
</div>

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
    cursor: pointer;"type="submit" value="Zaloguj">
     

</form>

      <br>
    <form action="index.html" method="post">
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



<?php



// Connect to the database
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie z bazą danych
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obsługa przesyłania formularzy
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Pobierz dane użytkownika z bazy danych
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Sprawdź hasło użytkownika
if (password_verify($password, $row["password"])) {
    echo "Pomyślnie zalogowano jako " . $row["username"];
    // Set session variable and redirect to user's dashboard
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $row["email"];  // Corrected line
    $_SESSION["id"] = $row["id"];        // Corrected line
    $_SESSION["role"] = $row["role"];    // Corrected line
    header("Location: strona.php");
    exit;
    } else {
      echo "Nieprawidłowe hasło";
    }
  } else {
    echo "Nie znaleziono użytkownika o podanym loginie";
  }

  $stmt->close();
  $conn->close();
}

?>

</div>
</center>
</body>
</html>				