<?php
session_start();

// wróć na stronę logowania
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Get the logged-in user ID or implement your own user identification mechanism
$user_id = $_SESSION["id"];

// Establish database connection
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the key, serial number, and game name from the AJAX request
$game_name = $_POST['game_name'];
$key = generateGameCode();
$serial_number = generateSerialNumber();

// Check if the game_code already exists for the given game_name
while (gameCodeExists($conn, $game_name, $key)) {
    $key = generateGameCode();
}

// Update the existing record in the user_games table
$sql = "UPDATE user_games SET game_code = '$key', serial_number = '$serial_number', used = 1 WHERE user_id = '$user_id' AND game_name = '$game_name' AND game_code IS NULL LIMIT 1";
if ($conn->query($sql) === TRUE) {
    http_response_code(200);
    $encoded_game_name = urlencode($game_name);
    header("Location: platnosc_sukces.php?game_name=$encoded_game_name");
    exit();
} else {
    http_response_code(500);
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

function generateGameCode() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $gameCode = '';
    for ($i = 0; $i < 5; $i++) {
        for ($j = 0; $j < 5; $j++) {
            $gameCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        if ($i < 4) {
            $gameCode .= '-';
        }
    }
    return $gameCode;
}

function generateSerialNumber() {
    return rand(100000000, 999999999);
}

function gameCodeExists($conn, $game_name, $game_code) {
    $sql = "SELECT game_code FROM user_games WHERE game_name = '$game_name' AND game_code = '$game_code' AND game_code <> 'TG6BR-XJ7FL-WBU24-6RV7D-VDSVL'";
    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}
?>