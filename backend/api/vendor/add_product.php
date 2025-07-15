<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$vendor_id = $data->vendor_id ?? 0;
$name = $data->product_name ?? '';
$desc = $data->description ?? '';
$price = $data->price ?? 0;
$image = $data->image ?? ''; // you can enhance it later to support actual uploads

if ($vendor_id && $name && $price) {
    $stmt = $conn->prepare("INSERT INTO products (vendor_id, product_name, description, price, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$vendor_id, $name, $desc, $price, $image]);

    echo json_encode(["success" => true, "message" => "Product added successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
}
?>
