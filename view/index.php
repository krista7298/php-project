<?php
session_start();

require_once('../controller/products_controller.php');
$products = get_all_products();

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header("Location: index.php");
    exit();
}

// Remove product
if (isset($_POST['remove'])) {
    $id = $_POST['id'];
    $_SESSION['cart'][$id] = max(0, ($_SESSION['cart'][$id] ?? 0) - 1);
    header("Location: index.php");
    exit();
}

// Clear cart
if (isset($_POST['clear'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php");
    exit();
}

// Count total items
$totalItems = array_sum($_SESSION['cart']);
?>

<html>
<head>
    <title>Krista Agustin Wk 4 Store</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Libre+Baskerville&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #0d1b14;
            color: #e8e6e3;
            font-family: 'Libre Baskerville', serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-family: 'Cinzel', serif;
            font-size: 42px;
            color: #9fefc4;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #a3c9b5;
            margin-bottom: 30px;
            font-style: italic;
        }

        a {
            color: #9fefc4;
            text-decoration: none;
            font-weight: bold;
        }

        .top-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .product {
            background-color: #1b2f24;
            border: 1px solid #2e4d3d;
            border-radius: 10px;
            padding: 15px;
            margin: 15px auto;
            max-width: 600px;
        }

        button {
            background-color: #2e4d3d;
            color: #e8e6e3;
            border: none;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<h1>Hogwarts Supply Shop</h1>

<p class="subtitle">
    A curated collection of magical essentials
</p>

<div class="top-bar">
    <a href="cart.php">Go to Cart</a>
    <p><strong>Items in Cart:</strong> <?php echo $totalItems; ?></p>

    <form method="POST">
        <button name="clear">Clear Cart</button>
    </form>
</div>

<hr>

<?php foreach ($products as $row): ?>

<div class="product">

    <strong>Product ID:</strong> <?php echo $row['Product_ID']; ?><br>

    <h3>
        <?php echo $row['Product_name']; ?> - $
        <?php echo $row['Product_cost']; ?>
    </h3>

    <p><?php echo $row['Product_description']; ?></p>

    <p>
        Quantity in Cart:
        <?php echo $_SESSION['cart'][$row['Product_ID']] ?? 0; ?>
    </p>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['Product_ID']; ?>">
        <button name="add">Add</button>
        <button name="remove">Remove</button>
    </form>

</div>

<?php endforeach; ?>

</body>
</html>