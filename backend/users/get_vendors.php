<?php
require_once '../db.php';
header('Content-Type: application/json');

$stmt = $conn->query("SELECT id, name, store_name, address FROM vendors");
$vendors = $stmt->fetchAll();

echo json_encode([
  "status" => true,
  "vendors" => $vendors
]);
