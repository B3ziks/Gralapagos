<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"></head>
<style>
  body, html {
            background-color: #434750;
            padding: 4% 15% 8% 15%;
            color: grey;
        }

        .container {
      display: flex;
      flex-direction: column;
      background-color: #2e3133;
      padding: 24px;
      border-radius: 16px;
      margin: 0 auto;
      text-align: center;
      color:#9669be;
    }
    .btn {
      max-width: 260px !important;
      margin: 0 auto;
	 background-color:#b58adb; 
	 color:#27fefb;
	 border-color:#b58adb;
	 
    }
		
		
	
</style>
<?php

session_start();

// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'gralapagos');
define('DB_PASSWORD', 'Dzionselka1');
define('DB_NAME', 'gralapagos');

// Attempt to connect to MySQL database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "User not logged in";
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$content = "";
$content_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate content
    if (empty(trim($_POST["content"]))) {
        $content_err = "Please enter your comment.";
    } else {
        $content = trim($_POST["content"]);
    }

    // Check input errors before inserting in database
    if (empty($content_err)) {
        // Prepare a select statement to retrieve the user's id
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store the result
                mysqli_stmt_store_result($stmt);

                // Check if the username exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind the result variables
                    mysqli_stmt_bind_result($stmt, $user_id);
                    mysqli_stmt_fetch($stmt);

                    // Prepare an insert statement
                    $sql = "INSERT INTO comments (user_id, content) VALUES (?, ?)";

                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ss", $user_id, $content);


                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Redirect to comments page
                            header("location: komentarze.php");
                        } else {
                            echo "Something went wrong. Please try again later.";
                        }
                        // Close statement
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }
                } else {
                    echo "User not found";
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    // Close connection
    mysqli_close($link);
}
?>
