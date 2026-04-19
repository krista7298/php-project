<html>
<head>
    <title>Krista Agustin Wk 2 Store</title>
</head>
<body>

<h1>Hogwarts Supply Shop</h1>

<?php

$conn = new mysqli("localhost", "root", "", "harry_potter_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");

while ($row = $result->fetch_assoc()) {
    echo "<h3>" . $row['Product_name'] . " - $" . $row['Product_cost'] . "</h3>";
    echo "<p>" . $row['Product_description'] . "</p>";
}

?>

</body>
</html>
