<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Localkart - User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .nav-link.active {
      font-weight: bold;
      color: #0d6efd !important;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Localkart</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="orders.php">My Orders</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="#" onclick="logout()">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-4">

<script>
function logout() {
  localStorage.removeItem("user_id");
  window.location.href = "login.php";
}
document.querySelectorAll(".nav-link").forEach(link => {
  if (link.href === location.href) link.classList.add("active");
});

</script>
