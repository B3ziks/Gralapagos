<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["id"];

// Check if a file was uploaded
if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] === UPLOAD_ERR_OK) {
    // Read the file content
    $imageData = file_get_contents($_FILES["profile_picture"]["tmp_name"]);

    // Update the user's profile picture in the database
    $query = "UPDATE users SET profile_picture = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("bi", $imageData, $user_id);
    $stmt->send_long_data(0, $imageData);
    $stmt->execute();
    $stmt->close();

    // Redirect to the profile page
    header("Location: profile.php");
    exit;
} else {
    echo "No file was uploaded.";
    exit;
}
?>