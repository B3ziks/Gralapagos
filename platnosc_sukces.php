<?php
session_start();

// Redirect if accessed directly or order_id is not provided
if (!isset($_SERVER['HTTP_REFERER']) || !isset($_GET['order_id'])) {
    header("Location: platnosc.php");
    exit;
}
// Establish database connection
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sukces - Gralapagos</title>
  <style>
    body {
        font-family: Arial, sans-serif;
    background-color: #44474f;
    color: white;
   
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
       
    }
    
    h1 {
        text-align: center;
        margin-top: 20px;
        
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        
    }
    
    table th,
    table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        
    }
    
    table th {
        background-color: #5c6067;
        
    }
    
    p {
        text-align: right;
        color: white;
    }
    
    form {
        text-align: center;
    }
    
    label {
        display: block;
        margin-bottom: 10px;
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




</head>
<body>
    <div class="container">

<?php
$game_name = urldecode($_GET['game_name']);
echo "<h1>Płatność udana" . $game_name . "</h1>";
// Display the cart summary

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<h2>Potwierdzenie płatności</h2>";
    echo "<table>";
    echo "<tr><th>Nazwa</th><th>Cena</th><th>Ilość</th><th>Cena łącznie</th><th>Metoda płatności</th></tr>";
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        echo "<tr>";
        echo "<td>" . $item['name'] . "</td>";
        echo "<td>" . $item['price'] . "</td>";
        echo "<td>" . $item['quantity'] . "</td>";
        $totalPrice += $item['price'] * $item['quantity'];
        echo "<td>" . $totalPrice . "</td>";
$orderID = $_GET['order_id'];
         $sql = "SELECT paymentMethod FROM orders WHERE id = '$orderID'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $paymentMethod = $row['paymentMethod'];
            echo "<td>" . $paymentMethod . "</td>";
        } else {
            echo "<td>Payment Method Not Found</td>";
        }

        echo "</tr>";
    }
    echo "</table>";
}
?>



<a href="faktura.php?order_id=<?php echo $_GET['order_id']; ?>" target="_blank" class="btn btn-dark" 
style="border: 0;
background: none;
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid #27fefb;
padding: 14px 40px;
outline: none;
color: white;
border-radius: 24px;
transition: 0.25s;
cursor: pointer;">Przejdz do faktury</a>

<a href="zakup.php" class="btn btn-dark" 
style="border: 0;
background: none;
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid #27fefb;
padding: 14px 40px;
outline: none;
color: white;
border-radius: 24px;
transition: 0.25s;
cursor: pointer;">Odbierz kody do gry</a>

<a href="strona.php" class="btn btn-dark" 
style="border: 0;
background: none;
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid #27fefb;
padding: 14px 40px;
outline: none;
color: white;
border-radius: 24px;
transition: 0.25s;
cursor: pointer;">Cofnij</a>

    </div>
</body>
</html>