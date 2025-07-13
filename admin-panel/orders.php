<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Orders - Admin</title>
  <?php include 'includes/header.php'; ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
  <h3>📋 All Orders</h3>
  <table class="table table-bordered mt-3">
    <thead class="table-dark">
      <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Date</th>
        <th>Items</th>
      </tr>
    </thead>
    <tbody id="orderTable"></tbody>
  </table>
  <a href="dashboard.php" class="btn btn-link">← Back to Dashboard</a>
</div>

<script>
const adminId = localStorage.getItem("admin_id");
if (!adminId) {
  alert("Please login."); window.location.href = "login.php";
}

fetch("../backend/admin/get_orders.php")
  .then(res => res.json())
  .then(data => {
    if (data.status) {
      const tbody = document.getElementById("orderTable");
      data.orders.forEach(order => {
        tbody.innerHTML += `
          <tr>
            <td>${order.id}</td>
            <td>${order.user_id}</td>
            <td>${new Date(order.created_at).toLocaleString()}</td>
            <td>
              <ul>${order.items.map(i => `<li>${i.name} x ${i.quantity}</li>`).join('')}</ul>
            </td>
          </tr>
        `;
      });
    }
  });
</script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
