<?php
require_once '../db.php';
header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT id, name, email FROM vendors");
$stmt->execute();
$vendors = $stmt->fetchAll();

echo json_encode(["status" => true, "vendors" => $vendors]);
