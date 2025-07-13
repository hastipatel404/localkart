<?php
require_once '../db.php';
header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
$stmt->execute();
$products = $stmt->fetchAll();

echo json_encode(["status" => true, "products" => $products]);
