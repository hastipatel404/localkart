<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Products - Admin</title>
  <?php include 'includes/header.php'; ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    img { width: 80px; height: 60px; object-fit: cover; }
  </style>
</head>
<body>

<div class="container py-4">
  <h3>📦 All Products</h3>
  <table class="table table-bordered mt-3">
    <thead class="table-dark">
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Vendor ID</th>
      </tr>
    </thead>
    <tbody id="productTable"></tbody>
  </table>
  <a href="dashboard.php" class="btn btn-link">← Back to Dashboard</a>
</div>

<script>
const adminId = localStorage.getItem("admin_id");
if (!adminId) {
  alert("Please login."); window.location.href = "login.php";
}

fetch("../backend/admin/get_products.php")
  .then(res => res.json())
  .then(data => {
    if (data.status) {
      const tbody = document.getElementById("productTable");
      data.products.forEach(p => {
        tbody.innerHTML += `
          <tr>
            <td><img src="../backend/uploads/${p.image}" /></td>
            <td>${p.name}</td>
            <td>₹${p.price}</td>
            <td>${p.vendor_id}</td>
          </tr>
        `;
      });
    }
  });
</script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
