<?php
session_start();

if (isset($_POST['login'])) {
    $login= $_POST['login'];
    $password = $_POST['password'];
    $users = json_decode(file_get_contents('users.json'), true);
    foreach ($users as $user) {
        if ($user['login'] === $login&& $user['password'] === $password) {
            $_SESSION['login'] = $login;
            header('Location: dashboard.php');
            exit();
        }
    }
    $error_message = 'Invalid username or password.';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="login">Username:</label>
        <input type="text" name="login" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
