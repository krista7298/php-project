<?php
require_once('../model/products_db.php');

function get_all_products()
{
    $rows = get_products();
    $products = array();

    if ($rows) {
        while ($row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
    }

    return $products;
}
?>