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

// Query the database to fetch product names where used=0
$sql = "SELECT game_name FROM user_games WHERE used=0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $productNames = array();
    while ($row = $result->fetch_assoc()) {
        $productNames[] = $row['game_name'];
    }
    echo json_encode($productNames);
} else {
    echo "No products found";
}

$conn->close();
?>