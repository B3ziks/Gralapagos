<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Rejestracja zakończona pomyślnie</title>
  </head>

  <style>
      .container {
          margin-top:1%;
          text-align:center;
      }

      .btn {
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
	}

	ul {
		position: relative;
		transform: skewY(-15deg);
	}

	ul li {
		position: relative;
		list-style: none;
		width: 200px;
		background: #3e3f46;
		padding: 15px;
		z-index: var(--i);
		transition: 0.5s;
	}

	ul li:hover {
		background: #b58adb;
		transform: translateX(-50px);
	}

	ul li::before {
		content: '';
		position: absolute;
		top: 0;
		left: -40px;
		width: 40px;
		height: 100%;
		background: #2e3133;
		transform-origin: right;
		transform: skewY(45deg);
		transition: 0.5s;
	}

	ul li:hover:before {
		background: #9669be;
	}

	ul li::after {
		content: '';
		position: absolute;
		top: -40px;
		left: 0;
		width: 100%;
		height: 40px;
		background: #35383e;
		transform-origin: bottom;
		transform: skewX(45deg);
		transition: 0.5s;
	}

	ul li:hover:after {
		background: #a077c3;
	}

	ul li a {
		text-decoration: none;
		color: #999;
		display: block;
		text-transform: uppercase;
		letter-spacing: 0.05em;
		transition: 0.5s;
	}

	ul li:hover a {
		color: #fff;
	}

	ul li:last-child::after {
		box-shadow: -120px 120px 20px rgba(0, 0, 0, 0.25);
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
		text-align: center;
		color: white;
		margin-bottom: -30px;

	}
	
	h2 {
		color: white!important;
	}
  </style>

<body>

<?php
   
  $login = $_POST['login'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if(!file_exists("users.json")) {
    $url = fopen("users.json");
    $pustaLista = array();
    fwrite($url, json_encode($pustaLista));
    fclose($url);
  }

  $zarejestrowani=file_get_contents("users.json");
  $array_uzytkownicy=json_decode($zarejestrowani, true);
  $nowi_userzy = array(
    "login" => $login,
    "password" => $password,
    "email" => $email
  );
  $array_uzytkownicy[]=$nowi_userzy;
  file_put_contents("users.json", json_encode($array_uzytkownicy));
  echo '<div class="container">';
  echo '<p>Konto zostało zarejestrowane!</p><br>';
  echo '<br>';
  echo '<a class="btn btn-dark" href="./index.html">Wróć na stroną główną</a>';
  echo '</div>';
  
?>

</body>
</html>