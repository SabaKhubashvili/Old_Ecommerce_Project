<?php
include('connection.php');

$stmt = $conn->prepare('SELECT * FROM products WHERE product_category="Jacket" LIMIT 4');
$stmt->execute();

$jacket_products = $stmt->get_result();

?>