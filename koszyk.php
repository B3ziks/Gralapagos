<?php
session_start();


// wróć na stronę logowania
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Add the game to the cart if data is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price'])) {
    $gameId = $_POST['id'];
    $gameName = $_POST['name'];
    $gamePrice = $_POST['price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the game is already in the cart
    $gameIndex = null;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] === $gameId) {
            $gameIndex = $index;
            break;
        }
    }

    // Add the game to the cart or update its quantity
    if ($gameIndex !== null) {
        $_SESSION['cart'][$gameIndex]['quantity']++;
    } else {
        $_SESSION['cart'][] = array(
            'id' => $gameId,
            'name' => $gameName,
            'price' => $gamePrice,
            'quantity' => 1
        );
    }

    // Redirect the user to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Delete one item from the cart if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['id'])) {
    $gameId = $_POST['id'];

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] === $gameId) {
                $_SESSION['cart'][$index]['quantity']--;

                // Remove the item from the cart if the quantity reaches zero
                if ($_SESSION['cart'][$index]['quantity'] <= 0) {
                    unset($_SESSION['cart'][$index]);
                }
                break;
            }
        }
    }

    // Redirect the user to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylepro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Shopping Cart</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .cart-table th,
        .cart-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .cart-table th {
            background-color: #5c5f68;
        }
        
        .cart-summary {
            margin-top: 20px;
            text-align: right;
        }
        
        .proceed-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
 .hidden {
        display: none !important;
		
    }
	tr {
	color: white;
	background-color: #5c5f68;
	}
	th {
	color: white;
	background-color: #5c5f68;
	}
    h2{
    color:white;
    }
	
    </style>
</head>
<body>
    <div class="container">
        <h2>Twój koszyk</h2>

        <?php
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            echo "<table class='cart-table'>";
            echo "<tr><th>Nazwa Produktu</th><th>Cena</th><th>Ilość</th><th>Akcje</th></tr>";
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $item) {
                echo "<tr>";
                echo "<td>" . $item['name'] . "</td>";
                echo "<td>" . $item['price'] . "</td>";
                echo "<td>" . $item['quantity'] . "</td>";
                echo "<td><form method='post'><input type='hidden' name='delete' value='true'><input type='hidden' name='id' value='" . $item['id'] . "'><button class='remove-button'>Usuń jeden egzemplarz</button></form></td>";
                echo "</tr>";
                $totalPrice += $item['price'] * $item['quantity'];
$_SESSION['totalPrice'] = $totalPrice;
            }
            echo "</table>";

            echo "<div class='cart-summary'>";
            echo "<p>Całkowity Koszt: " . $totalPrice . " zł</p>";
echo "</div>";
            
            echo '<form action="platnosc.php" method="post">
                <input class="btn btn-dark" style="border: 0;
                background: none;
                display: block;
                margin: 20px auto;
                text-align: center;
                border: 2px solid #27fefb;
                padding: 14px 40px;
                outline: none;
                color: #b58adb;
                border-radius: 24px;
                transition: 0.25s;
                cursor: pointer;" type="submit" value="Przejdź do płatności">
            </form>';
        } else {
            echo "<p>Twój koszyk jest pusty.</p>";
        }
        ?>

        <form action="programy.php" method="post">
            <input class="btn btn-dark" style="border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #27fefb;
            padding: 14px 40px;
            outline: none;
            color: #b58adb;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;" type="submit" value="Powrót do przeglądania">
        </form>
    </div>
</body>
</html>	