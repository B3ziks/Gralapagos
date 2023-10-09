<?php
// Establish database connection
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the game name from the AJAX request
$game_name = $_POST['game_name'];

// Update the used value to 1 in the orders table
$sql = "UPDATE orders SET used = 1 WHERE productName LIKE '%$game_name%'";
if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

$conn->close();
?>