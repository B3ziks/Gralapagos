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

// Get the game name from the request parameter
$game_name = $_GET['game_name'];

// Check if a code has been generated for the given game name
$sql = "SELECT COUNT(*) as count FROM user_games WHERE game_name = '$game_name'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['count'];
    if ($count > 0) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "false";
}

$conn->close();
?>