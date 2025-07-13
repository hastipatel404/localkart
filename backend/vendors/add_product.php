<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['vendor_id'], $_POST['name'], $_POST['price']) || !isset($_FILES['image'])) {
        echo json_encode(["status" => false, "message" => "Missing required fields"]);
        exit;
    }

    $vendor_id = $_POST['vendor_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];

    // Save image to uploads/
    $imageName = time() . "_" . basename($image['name']);
    $targetPath = "../uploads/" . $imageName;

    if (!move_uploaded_file($image['tmp_name'], $targetPath)) {
        echo json_encode(["status" => false, "message" => "Image upload failed"]);
        exit;
    }

    // Insert product into DB
    $stmt = $conn->prepare("INSERT INTO products (vendor_id, name, price, image) VALUES (?, ?, ?, ?)");
    $success = $stmt->execute([$vendor_id, $name, $price, $imageName]);

    echo json_encode([
        "status" => $success,
        "message" => $success ? "Product added successfully!" : "Failed to add product"
    ]);
}
