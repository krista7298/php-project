<?php
session_start();

$conn = new mysqli("localhost", "root", "", "harry_potter_store");

$totalItems = 0;
$subtotal = 0;
?>

<html>
<head>
    <title>Shopping Cart</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Libre+Baskerville&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #0d1b14;
            color: #e8e6e3;
            font-family: 'Libre Baskerville', serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-family: 'Cinzel', serif;
            color: #9fefc4;
        }

        .cart-item {
            background-color: #1b2f24;
            border: 1px solid #2e4d3d;
            padding: 15px;
            margin: 10px auto;
            max-width: 600px;
            border-radius: 10px;
        }

        a {
            color: #9fefc4;
            text-decoration: none;
        }

        button {
            background-color: #2e4d3d;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background-color: #3f6b55;
            transform: scale(1.1);
        }
    </style>
</head>

<body>

<h1>Your Cart</h1>

<a href="index.php">← Continue Shopping</a>

<hr>

<?php
foreach ($_SESSION['cart'] as $id => $qty):
    if ($qty > 0):

        $result = $conn->query("SELECT * FROM products WHERE Product_ID=$id");
        $product = $result->fetch_assoc();

        $total = $product['Product_cost'] * $qty;
        $subtotal += $total;
        $totalItems += $qty;
?>

<div class="cart-item">
    <h3><?php echo $product['Product_name']; ?></h3>
    Quantity: <?php echo $qty; ?><br>
    Price: $<?php echo $product['Product_cost']; ?><br>
    Total: $<?php echo number_format($total,2); ?>
</div>

<?php endif; endforeach; ?>

<hr>

<?php
$tax = $subtotal * 0.05;
$shipping = $subtotal * 0.10;
$orderTotal = $subtotal + $tax + $shipping;
?>

<p>Total Items: <?php echo $totalItems; ?></p>
<p>Subtotal: $<?php echo number_format($subtotal,2); ?></p>
<p>Tax (5%): $<?php echo number_format($tax,2); ?></p>
<p>Shipping (10%): $<?php echo number_format($shipping,2); ?></p>

<h2>Order Total: $<?php echo number_format($orderTotal,2); ?></h2>

<form method="POST">
    <button name="checkout">Check Out</button>
</form>

<?php
if (isset($_POST['checkout'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php");
}
?>

</body>
</html>