<!DOCTYPE html>
<html>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="icon" href="img/logo.png" type="image/x-icon">
<title>Forum</title>

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
	
  </style>

</head>

<body>
  <div class="container">
    <div class="container">
	<a href="strona.php"><img src="img/logo.png" title="Gralapagos"></a>
	<a href="strona.php"><button class="powrot">⮜</button></a>
      <h1>Dodaj komentarz</h1><br />
      <form action="add_comment.php" method="post">
        <div class="form-group">
          <label>Treść:</label>
          <input class="form-control" type="text" maxlength="58" placeholder="wprowadź treść komentarza" name="content" required>
        </div>
		
        <br />
		
        <br />
		
        <input class="btn btn-primary" style="background-color:#b58adb; color:#27fefb; border-color:#b58adb;" type="submit" value="Dodaj komentarz">
      </form>
      <br />
      <br />
<?php
session_start();

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

// Define variable to hold comments
$comments = array();

// Get comments from database
$sql = "SELECT comments.content, comments.created_at, users.username FROM comments JOIN users ON comments.user_id = users.id ORDER BY comments.created_at DESC";

if ($result = mysqli_query($link, $sql)) {
    // Fetch comments from result set
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }

    // Free result set
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>

<h2>Komentarze</h2>
<hr>
<table>
  <thead>
    <tr>
      <th>Użytkownik</th>
      <th>Treść</th>
      <th>Data</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Check if there are comments
    if (count($comments) > 0) {
        // Loop through comments and display them
        foreach ($comments as $comment) {
            echo "<tr>";
            echo "<td>" . $comment['username'] . "</td>";
            echo "<td>" . $comment['content'] . "</td>";
            echo "<td>" . $comment['created_at'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No comments yet.</td></tr>";
    }
    ?>
  </tbody>
</table>

    </div>
  </div>
</body>

</html>
