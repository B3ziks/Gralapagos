<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Usunięcie prezentu</title>
  </head>

  <style>

      body{
        margin-top:1%;
        text-align:center;
      }

        .btn {
          width:200px;
          display: flex;
          margin: 0 auto;
      }

  </style>

<body>

<?php

  $usunPrezent = $_GET["usunietoUzytkownika"];
  $listaJson = file_get_contents("users.json");
  $decodedJson = json_decode($listaJson);

  $lp = 0;
  $pustaLista = array();

  foreach($decodedJson as $prezent) {
    $lp++;
    if($usunPrezent != $lp) {
      $pustaLista[]=$prezent;
    }
  }

  file_put_contents("users.json", json_encode($pustaLista));
  echo 'usunieto<br>';
  echo '<br>';
  echo '<a class="btn btn-dark" href="./registration.php">Wróć na stroną główną</a>';
  echo '</div>';

?>

</body>
</html>