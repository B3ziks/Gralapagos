<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"></head>
<style>
  body, html {
            background-color: grey;
            padding: 4% 15% 8% 15%;
            color: grey;
        }

        .container {
      display: flex;
      flex-direction: column;
      background-color: white;
      padding: 24px;
      border-radius: 16px;
      margin: 0 auto;
      text-align: center;
      color:black;
    }
    .btn {
      max-width: 260px !important;
      margin: 0 auto;
    }
</style>
<?php

  $usunprezent = $_GET["presentDelete"];
  $listajson = file_get_contents("listakomentarzy.json");
  $decodedJson = json_decode($listajson);

  $counter = 0;
  $pustalista = array();

  foreach($decodedJson as $prezent) {
    $counter++;
    if($usunprezent != $counter) {
      $pustalista[]=$prezent;
    }
  }

  file_put_contents("listakomentarzy.json", json_encode($pustalista));
  echo '<div class="container">';
  echo 'Komentarz został pomyślnie usunięty<br/>';
  echo '<br>';
  echo '<a class="btn btn-primary" href="./komentarze.php">Wróc do sekcji komentarzy</a>';
  echo '</div>';
?>