<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$product_id = $data->product_id ?? 0;

if ($product_id) {
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->execute([$product_id]);

    echo json_encode(["success" => true, "message" => "Product deleted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Product ID is required"]);
}
?>
