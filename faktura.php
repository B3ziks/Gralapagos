<?php
session_start();

// wróć na stronę logowania
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$customerId = $_SESSION['id'];
// Establish database connection
$servername = "localhost";
$username = "gralapagos";
$password = "Dzionselka1";
$dbname = "gralapagos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include the Dompdf library
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Create a new Dompdf instance
$dompdf = new Dompdf();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in
    if (isset($_GET['order_id'])) {
        // Retrieve the order ID from the URL parameter

        $orderNumber = $_GET['order_id'];
// Get the customer ID


// Get the customer username
$sql = "SELECT email FROM users WHERE id = $customerId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customerUsername = $row['email'];
} else {
    $customerUsername = "Unknown";
}


        // Set the contractor information
        $contractor = "gralapagos.support@gmail.com";

        // Generate the HTML content for the PDF
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Faktura</title>
            <style>
                /* Define your CSS styles here */
                body {
                    font-family: Arial, sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 5px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
            </style>
        </head>
        <body>
            <h1>Faktura</h1>
            <h2>Numer faktury: ' . $orderNumber . '</h2>
            
            <h3>Odbiorca: ' . $customerUsername . '</h3>
            <h3>Zleceniodawca: ' . $contractor . '</h3>
            
            <table>
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Cena</th>
                        <th>Ilosc</th>
                        <th>Suma</th>
                    </tr>
                </thead>
                <tbody>';

       // Calculate the total amount
        $total = $_SESSION['totalPrice'];

        foreach ($_SESSION['cart'] as $item) {
            $productName = $item['name'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $itemTotal = $price * $quantity;

            // Add a row for each item
            $html .= '
                    <tr>
                        <td>' . $productName . '</td>
                        <td>' . $price . '</td>
                        <td>' . $quantity . '</td>
                        <td>' . $itemTotal . '</td>
                    </tr>';
        }

        $html .= '
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total:</strong></td>
                        <td>' . $total . '</td>
                    </tr>
                </tfoot>
            </table>';

  
        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF content
        $dompdf->render();

        // Output the generated PDF (inline or download)
        $dompdf->stream('order_invoice.pdf', ['Attachment' => false]);

        // Clear the shopping cart
        unset($_SESSION['cart']);
    } else {
        echo "Invalid order number.";
    }
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}