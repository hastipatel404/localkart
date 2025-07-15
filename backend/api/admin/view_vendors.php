<?php
require_once '../../config/db.php';

try {
    $stmt = $conn->query("SELECT vendor_id, shop_name, owner_name, email, is_approved, created_at FROM vendors");
    $vendors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "vendors" => $vendors
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error fetching vendors: " . $e->getMessage()
    ]);
}
?>
