<?php
session_start();

// Retrieve the logged-in user ID from session or any appropriate source
$userId = $_SESSION['id'];

// Establish database connection
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add the game to the cart if data is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price'])) {
    // Your existing code to add items to the cart
}

// Delete one item from the cart if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['id'])) {
    // Your existing code to delete items from the cart
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_method'])) {
    $paymentMethod = $_POST['payment_method'];

    if ($paymentMethod === 'card') {
        // Retrieve card details from the form
        $cardNumber = $_POST['card_number'];
        $expiryDate = $_POST['expiry_date'];
        $cwCode = $_POST['cw_code'];

        // Prepare the order details
        $orderDetails = array();
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $item) {
            $productName = $item['name'];
            $price = $item['price'];

            // Escape special characters to prevent SQL injection
            $productName = $conn->real_escape_string($productName);
            $price = $conn->real_escape_string($price);

            // Add the product name to the order details
            for ($i = 0; $i < $item['quantity']; $i++) {
                $orderDetails[] = $productName;
            }

            // Calculate the total price
            $totalPrice += ($price * $item['quantity']);
        }

        // Get the current date
        $orderDate = date('Y-m-d');

        // Concatenate the product names
        $productNames = implode(', ', $orderDetails);

        // Escape special characters to prevent SQL injection
        $productNames = $conn->real_escape_string($productNames);
        $totalPrice = $conn->real_escape_string($totalPrice);

        // Insert the order into the orders table
        $sql = "INSERT INTO orders (user_id, orderDate, productName, price, paymentMethod)
                VALUES ('$userId', '$orderDate', '$productNames', '$totalPrice', '$paymentMethod')";

        if ($conn->query($sql) === TRUE) {
            // Get the inserted order ID
            $orderID = $conn->insert_id;

            // Insert the games into the user_games table
            $insertValues = array();
            foreach ($orderDetails as $gameName) {
                $gameName = $conn->real_escape_string($gameName);
                $insertValues[] = "('', '$userId', '0', '$gameName')";
            }

            $insertQuery = "INSERT INTO user_games (id, user_id, used, game_name)
                            VALUES " . implode(", ", $insertValues);

            if ($conn->query($insertQuery) === TRUE) {
                // Redirect to invoice.php with the order ID as a URL parameter
                header("Location: platnosc_sukces.php?order_id=" . $orderID);
                exit;
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }}else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
    } else {
        // Invalid 
        echo "Zła metoda!";
    }
     if ($paymentMethod === 'paypal') {


        // Prepare the order details
        $orderDetails = array();
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $item) {
            $productName = $item['name'];
            $price = $item['price'];

            // Escape special characters to prevent SQL injection
            $productName = $conn->real_escape_string($productName);
            $price = $conn->real_escape_string($price);

            // Add the product name to the order details
            for ($i = 0; $i < $item['quantity']; $i++) {
                $orderDetails[] = $productName;
            }

            // Calculate the total price
            $totalPrice += ($price * $item['quantity']);
        }

        // Get the current date
        $orderDate = date('Y-m-d');

        // Concatenate the product names
        $productNames = implode(', ', $orderDetails);

        // Escape special characters to prevent SQL injection
        $productNames = $conn->real_escape_string($productNames);
        $totalPrice = $conn->real_escape_string($totalPrice);

        // Insert the order into the orders table
        $sql = "INSERT INTO orders (user_id, orderDate, productName, price, paymentMethod)
                VALUES ('$userId', '$orderDate', '$productNames', '$totalPrice', '$paymentMethod')";

        if ($conn->query($sql) === TRUE) {
            // Get the inserted order ID
            $orderID = $conn->insert_id;

            // Insert the games into the user_games table
            $insertValues = array();
            foreach ($orderDetails as $gameName) {
                $gameName = $conn->real_escape_string($gameName);
                $insertValues[] = "('', '$userId', '0', '$gameName')";
            }

            $insertQuery = "INSERT INTO user_games (id, user_id, used, game_name)
                            VALUES " . implode(", ", $insertValues);

            if ($conn->query($insertQuery) === TRUE) {
                // Redirect to invoice.php with the order ID as a URL parameter
                header("Location: platnosc_sukces.php?order_id=" . $orderID);
                exit;
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Invalid 
        echo "Zła metoda!";
    }
if ($paymentMethod === 'blik') {


        // Prepare the order details
        $orderDetails = array();
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $item) {
            $productName = $item['name'];
            $price = $item['price'];

            // Escape special characters to prevent SQL injection
            $productName = $conn->real_escape_string($productName);
            $price = $conn->real_escape_string($price);

            // Add the product name to the order details
            for ($i = 0; $i < $item['quantity']; $i++) {
                $orderDetails[] = $productName;
            }

            // Calculate the total price
            $totalPrice += ($price * $item['quantity']);
        }

        // Get the current date
        $orderDate = date('Y-m-d');

        // Concatenate the product names
        $productNames = implode(', ', $orderDetails);

        // Escape special characters to prevent SQL injection
        $productNames = $conn->real_escape_string($productNames);
        $totalPrice = $conn->real_escape_string($totalPrice);

        // Insert the order into the orders table
        $sql = "INSERT INTO orders (user_id, orderDate, productName, price, paymentMethod)
                VALUES ('$userId', '$orderDate', '$productNames', '$totalPrice', '$paymentMethod')";

        if ($conn->query($sql) === TRUE) {
            // Get the inserted order ID
            $orderID = $conn->insert_id;

            // Insert the games into the user_games table
            $insertValues = array();
            foreach ($orderDetails as $gameName) {
                $gameName = $conn->real_escape_string($gameName);
                $insertValues[] = "('', '$userId', '0', '$gameName')";
            }

            $insertQuery = "INSERT INTO user_games (id, user_id, used, game_name)
                            VALUES " . implode(", ", $insertValues);

            if ($conn->query($insertQuery) === TRUE) {
                // Redirect to invoice.php with the order ID as a URL parameter
                header("Location: platnosc_sukces.php?order_id=" . $orderID);
                exit;
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Invalid 
        echo "Zła metoda!";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Płatność - Gralapagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #44474f;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            color: white;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            color: white;
            text-align: center;
            
        }

        table th,
        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            color: white;
        }

        table th {
            background-color: #5c6067;
            color: white;
        }

        p {
            text-align: right;
            color: white;
        }

        form {
            text-align: center;
            color: white;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: white;
        }

        select {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-width: 200px;
        }

        input[type="text"] {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-width: 200px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .hidden {
            display: none !important;
        }
    </style>
    <script>
        function toggleDiv() {
            var paymentMethod = document.getElementById('payment_method').value;
            var cardDiv = document.getElementById('card_div');
            var paypalDiv = document.getElementById('paypal_div');
            var blikDiv = document.getElementById('blik_div');

            cardDiv.classList.add('hidden');
            paypalDiv.classList.add('hidden');
            blikDiv.classList.add('hidden');

            if (paymentMethod === 'card') {
                cardDiv.classList.remove('hidden');
            } else if (paymentMethod === 'paypal') {
                paypalDiv.classList.remove('hidden');
            } else if (paymentMethod === 'blik') {
                blikDiv.classList.remove('hidden');
            }
        }
    </script>
</head>
<body>
    <h1>Płatność</h1>
    <form method="post">
        <?php
        // Display the cart summary
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            echo "<h2>Podsumowanie</h2>";
            echo "<table>";
            echo "<tr><th>Nazwa</th><th>Cena</th><th>Ilość</th></tr>";
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $item) {
                echo "<tr>";
                echo "<td>" . $item['name'] . "</td>";
                echo "<td>" . $item['price'] . "</td>";
                echo "<td>" . $item['quantity'] . "</td>";
                echo "</tr>";
                $totalPrice += $item['price'] * $item['quantity'];
            }
            echo "</table>";
            echo "<p>Cena łącznie: " . $totalPrice . "</p>";

            // Add the field
            echo "<label for='payment_method'>Metoda płatności:</label>";
            echo "<select id='payment_method' name='payment_method'>";
            echo '<option value="" selected disabled hidden>Wybierz</option>';
            echo "<option value='card'>Card</option>";
            echo "<option value='paypal'>PayPal</option>";
            echo "<option value='blik'>Blik</option>";
            echo "</select>";

            echo "<br><br><br>";
            // Display the additional fields based on the selected payment method
            echo "<div id='card_fields' class='hidden'>";
            echo "<label for='card_number'>Card Number:</label>";
            echo "<input type='text' id='card_number' name='card_number'>";
            echo "<label for='expiry_date'>Expiry Date:</label>";
            echo "<input type='text' id='expiry_date' name='expiry_date'>";
            echo "<label for='cw_code'>CW Code:</label>";
            echo "<input type='text' id='cw_code' name='cw_code'>";
            echo "</div>";

            echo "<div id='paypal_button' class='hidden'>";
            echo '<a href="https://www.paypal.com/signin?returnUri=https%3A%2F%2Fwww.paypal.com%2Fmyaccount%2Fautopay&state=%2Fconnect%2FB-216466662E3723024">
       <img src="https://koliber-dzieciom.pl/wp-content/uploads/2017/06/paypal-logo.png" alt="buttonpng" border="0" style=" width: 200px; height: 200px;"/>
</a>';
            echo "</div>";

            echo "<div id='blik_field' class='hidden'>";
            echo "<label for='blik_code'>Blik Code (6 digits):</label>";
            echo "<input type='text' id='blik_code' name='blik_code' maxlength='6'>";
            echo "</div>";

            echo "<br><br><button type='submit'>Zapłać</button>";
        } else {
            echo "<p>Koszyk jest pusty.</p>";
        }
        ?>
    </form>

    <script>
        // Toggle the visibility of the fields based on the selected 
        const paymentMethodSelect = document.getElementById('payment_method');
        const cardFields = document.getElementById('card_fields');
        const paypalButton = document.getElementById('paypal_button');
        const blikField = document.getElementById('blik_field');

        paymentMethodSelect.addEventListener('change', function() {
            const selectedMethod = paymentMethodSelect.value;

            if (selectedMethod === 'card') {
                cardFields.classList.remove('hidden');
                paypalButton.classList.add('hidden');
                blikField.classList.add('hidden');
            } else if (selectedMethod === 'paypal') {
                cardFields.classList.add('hidden');
                paypalButton.classList.remove('hidden');
                blikField.classList.add('hidden');
            } else if (selectedMethod === 'blik') {
                cardFields.classList.add('hidden');
                paypalButton.classList.add('hidden');
                blikField.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>