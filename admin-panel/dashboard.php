<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php include 'includes/header.php'; ?>
  <title>Admin Dashboard - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card {
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .stat {
      font-size: 24px;
      font-weight: bold;
    }
  </style>
</head>
<body>
<div class="container py-4">
  <h3 class="mb-4">📊 Admin Dashboard</h3>

  <div class="row g-4">
    <div class="col-md-3">
      <div class="card text-center p-3">
        <div>👥 Vendors</div>
        <div class="stat" id="vendorsCount">0</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center p-3">
        <div>📦 Products</div>
        <div class="stat" id="productsCount">0</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center p-3">
        <div>📋 Orders</div>
        <div class="stat" id="ordersCount">0</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center p-3">
        <div>💰 Total Sales</div>
        <div class="stat">₹<span id="salesAmount">0</span></div>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <a href="vendors.php" class="btn btn-outline-primary me-2">Manage Vendors</a>
    <a href="products.php" class="btn btn-outline-success me-2">View Products</a>
    <a href="orders.php" class="btn btn-outline-warning me-2">View Orders</a>
    <button onclick="logout()" class="btn btn-danger">Logout</button>
  </div>
</div>

<script>
const adminId = localStorage.getItem("admin_id");
if (!adminId) {
  alert("Please login as admin.");
  window.location.href = "login.php";
}

function logout() {
  localStorage.removeItem("admin_id");
  window.location.href = "login.php";
}

async function loadStats() {
  const res = await fetch("../backend/admin/get_stats.php");
  const data = await res.json();

  if (data.status) {
    document.getElementById("vendorsCount").innerText = data.vendors;
    document.getElementById("productsCount").innerText = data.products;
    document.getElementById("ordersCount").innerText = data.orders;
    document.getElementById("salesAmount").innerText = data.sales;
  }
}

loadStats();
</script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
