<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Orders - Vendor Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
  <h3>📋 My Orders</h3>
  <table class="table table-bordered mt-4">
    <thead class="table-dark">
      <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Price (₹)</th>
      </tr>
    </thead>
    <tbody id="orderTable"></tbody>
  </table>

  <a href="dashboard.php" class="btn btn-link mt-3">← Back to Dashboard</a>
</div>

<script>
const vendorId = localStorage.getItem("vendor_id");
if (!vendorId) {
  alert("Please login first.");
  window.location.href = "login.php";
}

document.addEventListener("DOMContentLoaded", async () => {
  const res = await fetch("../backend/vendors/get_orders.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ vendor_id: vendorId })
  });

  const data = await res.json();
  const tbody = document.getElementById("orderTable");

  if (data.status && data.orders.length > 0) {
    data.orders.forEach(o => {
      tbody.innerHTML += `
        <tr>
          <td>${o.order_id}</td>
          <td>${new Date(o.created_at).toLocaleString()}</td>
          <td>${o.product_name}</td>
          <td>${o.quantity}</td>
          <td>₹${o.price}</td>
        </tr>
      `;
    });
  } else {
    tbody.innerHTML = `<tr><td colspan="5">No orders found.</td></tr>`;
  }
});
</script>

</body>
</html>
<?php include 'includes/footer.php'; ?>