<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
  echo "<script>window.location.href = 'login.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to bottom right, #f1f1f1, #d2ffe6);
      min-height: 100vh;
    }
    .dashboard-title {
      text-align: center;
      margin-top: 40px;
      font-weight: bold;
      color: #333;
    }
    .card {
      transition: transform 0.3s, box-shadow 0.3s;
      border: none;
      border-radius: 15px;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }
    .icon {
      font-size: 2rem;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="dashboard-title mb-4">👋 Welcome to Localkart, User!</h2>

  <div class="row justify-content-center g-4">
    <!-- View Products -->
    <div class="col-md-3">
      <a href="index.php" class="text-decoration-none">
        <div class="card text-center p-4 bg-white h-100">
          <div class="icon mb-2">🛍️</div>
          <h5 class="fw-bold">Browse Products</h5>
          <p class="text-muted">Explore items from local vendors</p>
        </div>
      </a>
    </div>

    <!-- Cart -->
    <div class="col-md-3">
      <a href="cart.php" class="text-decoration-none">
        <div class="card text-center p-4 bg-white h-100">
          <div class="icon mb-2">🛒</div>
          <h5 class="fw-bold">My Cart</h5>
          <p class="text-muted">View your current cart items</p>
        </div>
      </a>
    </div>

    <!-- Orders -->
    <div class="col-md-3">
      <a href="orders.php" class="text-decoration-none">
        <div class="card text-center p-4 bg-white h-100">
          <div class="icon mb-2">📦</div>
          <h5 class="fw-bold">My Orders</h5>
          <p class="text-muted">Track your past orders</p>
        </div>
      </a>
    </div>

    <!-- Profile -->
    <div class="col-md-3">
      <a href="profile.php" class="text-decoration-none">
        <div class="card text-center p-4 bg-white h-100">
          <div class="icon mb-2">👤</div>
          <h5 class="fw-bold">My Profile</h5>
          <p class="text-muted">Manage your personal info</p>
        </div>
      </a>
    </div>

    <!-- Logout -->
    <div class="col-md-3">
      <a href="logout.php" class="text-decoration-none">
        <div class="card text-center p-4 bg-danger text-white h-100">
          <div class="icon mb-2">🚪</div>
          <h5 class="fw-bold">Logout</h5>
          <p>End your session</p>
        </div>
      </a>
    </div>
  </div>
</div>

</body>
</html>
