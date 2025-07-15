<?php
require_once '../../config/db.php';

try {
    // Total users
    $userStmt = $conn->query("SELECT COUNT(*) AS total_users FROM users");
    $userCount = $userStmt->fetch(PDO::FETCH_ASSOC)['total_users'];

    // Total vendors
    $vendorStmt = $conn->query("SELECT COUNT(*) AS total_vendors FROM vendors");
    $vendorCount = $vendorStmt->fetch(PDO::FETCH_ASSOC)['total_vendors'];

    // Approved vendors
    $approvedStmt = $conn->query("SELECT COUNT(*) AS approved_vendors FROM vendors WHERE is_approved = 1");
    $approvedCount = $approvedStmt->fetch(PDO::FETCH_ASSOC)['approved_vendors'];

    // Total orders
    $orderStmt = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
    $orderCount = $orderStmt->fetch(PDO::FETCH_ASSOC)['total_orders'];

    echo json_encode([
        "success" => true,
        "data" => [
            "total_users" => $userCount,
            "total_vendors" => $vendorCount,
            "approved_vendors" => $approvedCount,
            "total_orders" => $orderCount
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error fetching stats: " . $e->getMessage()
    ]);
}
?>
