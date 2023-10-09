<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style-rejestracja.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Rejestracja</title>

  <style>
  * {
    font-family: 'Josefin Sans', sans-serif;
}

 
      .container {
          display: flex;
          flex-direction: column;
          padding: 10px;
          border-radius: 10px;
          margin: 0 auto;
          text-align: center;
      }

      .form-control {
          width:200px;
          display: flex;
          margin: 0 auto;
      }
	  * {

    box-sizing: border-box;
    font-family: 'Josefin Sans', sans-serif;
	column-span: 1;
	margin: auto;

	}

	body {
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 100vh;
		background: #434750;
		margin-top: -50px;
		    margin: 0;
    padding: 0;
    font-family: sans-serify;
    background: #434750;
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

	.column {
		margin-top: 50px;
	}

	p {
	
		color: white;

	}
	h2{
	color:#27fefb;}
	
	.box {
    width: 300px;
    padding: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #3e3f46;
    text-align: center;

  </style>

</head>

<body>

  <div class="container">
    <div class="container">
	<div class="box">

      <h2>Zarejestruj się</h2><br>
      <form method="POST" action="registration.php">

        <div class="form-group">
          <label><p>Login</p></label>

          <input class="form-control"style=" border: 0;
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
    transition: 0.25s;" type="text" placeholder="login" name="username" id="username" required>
        </div>

        <div class="form-group">
          <label><p>Hasło</p></label>
          <input class="form-control"style=" border: 0;
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
    transition: 0.25s;" type="password" placeholder="hasło" id="password" name="password" required>
        </div>

        <div class="form-group">
          <label><p>Email</p></label>

          <input class="form-control" style=" border: 0;
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
    transition: 0.25s;" type="email" placeholder="email" name="email" id="email" required>
        </div>
        <br>

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
    cursor: pointer;"type="submit" value="Dołącz!">
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
  // Połączenie z bazą danych
  $servername = "localhost";
  $username = "gralapagos";
  $password = "Dzionselka1";
  $dbname = "gralapagos";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Obsługa przesyłania formularzy

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Sprawdź poprawność danych wprowadzonych przez użytkownika wyrażenia regularne

    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    if (!preg_match($password_regex, $password)) {
      echo "Hasło musi mieć co najmniej 8 znaków i zawierać co najmniej jedną małą literę, jedną wielką literę i jedną cyfrę.";
      exit;
    }
    $email_regex = '/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/';
    if (!preg_match($email_regex, $email)) {
      echo "Nieprawidłowy adres email";
      exit;
    }


    // Sprawdź, czy nazwa użytkownika już istnieje w bazie danych
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    echo "Użytkownik o podanym loginie już istnieje.";
    exit;
    }

    // Sprawdź, czy e-mail już istnieje w bazie danych
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    echo "Ten adres email jest już zajęty.";
    exit;
    }


    // Zaszyfruj hasło użytkownika 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Uzyskaj następny dostępny  ID 
    $sql = "SELECT MIN(t1.id + 1) AS next_id
        FROM users AS t1
        LEFT JOIN users AS t2 ON t1.id + 1 = t2.id
        WHERE t2.id IS NULL";
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     $next_id = $row["next_id"];

     // Wstaw dane użytkownika do bazy danych
     $stmt = $conn->prepare("INSERT INTO users (id, username, email, password) VALUES (?, ?, ?, ?)");
     $stmt->bind_param("isss", $next_id, $username, $email, $hashed_password);

   if ($stmt->execute()) {
      echo "Użytkownik został pomyślnie zarejestrowany";
   } else {
    echo "Error: " . $stmt->error;
   }

   $stmt->close();
   $conn->close();
  }
?>
    </div>
  </div>
   </div>
 
</body>
</html>								