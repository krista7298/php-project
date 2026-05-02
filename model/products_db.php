<?php
require_once('database.php');

function get_products()
{
    $conn = get_db_conn();
    $query = "SELECT * FROM products";
    return mysqli_query($conn, $query);
}
?>