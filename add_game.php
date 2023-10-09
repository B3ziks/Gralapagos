<?php
// establish database connection
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check if the connection is established successfully
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $publisher = $_POST["publisher"];
  $description = $_POST["description"];
  $price = $_POST["price"];
  $sale_price = $_POST["sale_price"];

  $photo = $_FILES["photo"];
  $photo_name = $photo["name"];
  $photo_tmp_name = $photo["tmp_name"];
  $photo_size = $photo["size"];
  $photo_error = $photo["error"];

  $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
  $allowed_exts = ["jpg", "jpeg", "png", "gif"];

  if (in_array($photo_ext, $allowed_exts)) {
    if ($photo_error === 0) {
      if ($photo_size <= 5000000) {
        $photo_data = file_get_contents($photo_tmp_name);

        $stmt = $conn->prepare("INSERT INTO games (name, photo, publisher, description, price, sale_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdd", $name, $photo_data, $publisher, $description, $price, $sale_price);
        $stmt->execute();
        $stmt->close();

        header("Location: programy.php");
        exit();
      } else {
        echo "Sorry, your file is too large.";
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
  }
}

$conn->close();

?>