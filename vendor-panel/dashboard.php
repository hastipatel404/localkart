<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vendor Dashboard - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
    }
    .dashboard-box {
      max-width: 600px;
      margin: 80px auto;
      padding: 40px;
      background: white;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .dashboard-box a {
      display: block;
      margin: 10px 0;
    }
  </style>
</head>
<body>

<div class="dashboard-box">
  <h3>Welcome, <span id="vendorName">Vendor</span>!</h3>
  <p>Your Vendor ID: <span id="vendorId"></span></p>

  <div class="mt-4 text-start">
    <h5>📊 Your Analytics</h5>
    <ul>
      <li><strong>Products:</strong> <span id="productCount">0</span></li>
      <li><strong>Total Orders:</strong> <span id="orderCount">0</span></li>
      <li><strong>Total Sales:</strong> ₹<span id="salesTotal">0</span></li>
    </ul>
  </div>

  <hr>

  <a href="add-product.php" class="btn btn-primary w-100">➕ Add Product</a>
  <a href="view-orders.php" class="btn btn-secondary w-100">📋 View Orders</a>
  <a href="profile.php" class="btn btn-warning w-100 mt-2">👤 My Profile</a>
  <button onclick="logout()" class="btn btn-danger w-100 mt-3">🚪 Logout</button>
</div>


<script>
const vendorId = localStorage.getItem("vendor_id");
// Fetch analytics
async function fetchAnalytics() {
  const res = await fetch("../backend/vendors/get_analytics.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ vendor_id: vendorId })
  });

  const data = await res.json();
  if (data.status) {
    document.getElementById("productCount").innerText = data.total_products;
    document.getElementById("orderCount").innerText = data.total_orders;
    document.getElementById("salesTotal").innerText = data.total_sales;
  }
}

fetchAnalytics();

if (!vendorId) {
  alert("Please login first.");
  window.location.href = "login.php";
} else {
  document.getElementById("vendorId").innerText = vendorId;

  // Optional: Fetch name using an API
  fetch("../backend/db.php") // or create a new endpoint to fetch vendor name
    .then(() => {
      // For now, we’ll use a hardcoded name if API not ready
      document.getElementById("vendorName").innerText = "Vendor #" + vendorId;
    });
}

function logout() {
  localStorage.removeItem("vendor_id");
  window.location.href = "login.php";
}
</script>

</body>
</html>
<?php include 'includes/footer.php'; ?>