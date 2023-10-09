<?php

$login = $_POST['login'];
$password = $_POST['password'];


if(isset($login) && isset($password) && $login_and_password[$login] == $password)
{
    header("Location: http://www.gralapagos.pl/strona.html");
}
elseif (isset($login) && isset($password) && $login_and_password[$login] != $password)
{
	echo 'Błędny login lub hasło.<br><br><a href="http://www.gralapagos.pl/login.php"><button class="btn">Zaloguj się ponownie</button></a>';
	
}
else
{
    echo '';
}	


?>