<?php
require_once '../db.php';
header('Content-Type: application/json');

// Total vendors
$vendors = $conn->query("SELECT COUNT(*) FROM vendors")->fetchColumn();

// Total products
$products = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();

// Total orders
$orders = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();

// Total sales
$sales = $conn->query("SELECT SUM(quantity * price) FROM order_items")->fetchColumn();

echo json_encode([
    "status" => true,
    "vendors" => $vendors,
    "products" => $products,
    "orders" => $orders,
    "sales" => $sales ?? 0
]);
