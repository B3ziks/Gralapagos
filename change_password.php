<?php
session_start();

// Sprawdź czy użytkownik jest zalogowany
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Sprawdź, czy formularz został pomyślnie przesłany
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    // Sprawdź poprawność formularzy

    // Check if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $_SESSION["change_password_error"] = "Pole nowe hasło i pole potwierdź hasło nie zgadzają się.";
        header("Location: zmiana_hasla.php");
        exit;
    }

    // Check if the new password meets the regex requirements
    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    if (!preg_match($password_regex, $newPassword)) {
        $_SESSION["change_password_error"] = "Hasło musi mieć co najmniej 8 znaków i zawierać co najmniej jedną małą literę, jedną wielką literę i jedną cyfrę.";
        header("Location: zmiana_hasla.php");
        exit;
    }

    // Zmiana hasła

    // Connect to the database
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

    // Pobierz aktualne hasło z bazy danych

    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    // Sprawdź czy użytkownik z takim id istnieje
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // sprawdź aktualne hasło
        if (password_verify($oldPassword, $hashedPassword)) {
            // Hash the new password
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE users SET password = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("si", $newHashedPassword, $user_id);
            $updateStmt->execute();
            $updateStmt->close();

            $_SESSION["change_password_success"] = "Hasło zostało zmienione pomyślnie";
            header("Location: zmiana_hasla.php");
            exit;
        } else {
            $_SESSION["change_password_error"] = "Podane aktualne hasło jest nieprawidłowe.";
            header("Location: zmiana_hasla.php");
            exit;
        }
    } else {
        $_SESSION["change_password_error"] = "Nie znaleziono użytkownika.";
        header("Location: zmiana_hasla.php");
        exit;
    }
}

// Jeśli formularz nie został przesłany lub powyższa logika nie została wykonana, przekieruj z powrotem na stronę profilu
header("Location: zmiana_hasla.php");
exit;
?>