<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$vendor_id = $data->vendor_id ?? null;
$action = $data->action ?? ''; // 'approve' or 'block'

if ($vendor_id && in_array($action, ['approve', 'block'])) {
    $status = ($action === 'approve') ? 1 : 0;

    $stmt = $conn->prepare("UPDATE vendors SET is_approved = ? WHERE vendor_id = ?");
    $stmt->execute([$status, $vendor_id]);

    echo json_encode([
        "success" => true,
        "message" => "Vendor has been " . ($status ? "approved" : "blocked")
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request"
    ]);
}
?>
