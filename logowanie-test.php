<!DOCTYPE html>
<html>
<head>
	<title>Logowanie</title>
</head>
<body>
	<h1>Logowanie</h1>
	<form method="post" action="strona.html">
		<label for="login">Login:</label>
		<input type="text" name="login" id="login" required><br><br>
		<label for="password ">Hasło:</label>
		<input type="password" name="password " id="password " required><br><br>
		<input type="submit" value="Zaloguj">
	</form>


</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password '];
    $json = file_get_contents('users.json');
    $users = json_decode($json, true);

    foreach ($users as $user) {
        if($user['login'] == $login && $user['password '] == $password ) {
            session_start();
            $_SESSION['login'] = $login;
            header('Location: panel.php');
            exit();
        }
    }

    echo 'Nieprawidłowy login lub hasło.';
}

?>