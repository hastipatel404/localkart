<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['product_id'], $_POST['name'], $_POST['price'])) {
        echo json_encode(["status" => false, "message" => "Missing data"]);
        exit;
    }

    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'] ?? null;

    if ($image && $image['name'] !== "") {
        $imageName = time() . "_" . basename($image['name']);
        $targetPath = "../uploads/" . $imageName;
        move_uploaded_file($image['tmp_name'], $targetPath);

        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?");
        $success = $stmt->execute([$name, $price, $imageName, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
        $success = $stmt->execute([$name, $price, $id]);
    }

    echo json_encode([
        "status" => $success,
        "message" => $success ? "Product updated" : "Update failed"
    ]);
}
