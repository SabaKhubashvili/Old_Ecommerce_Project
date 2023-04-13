<?php


$stmt = $conn->prepare('SELECT * FROM products ');
$stmt->execute();

$shop_products = $stmt->get_result();

?>