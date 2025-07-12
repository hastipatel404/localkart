<?php
$host = "localhost";
$dbname = "localkart";
$username = "root"; // change this if your MySQL username is different
$password = "";     // change this if your MySQL password is set

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: set fetch mode to associative array by default
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
