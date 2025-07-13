<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Vendors - Admin</title>
  <?php include 'includes/header.php'; ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
  <h3>👥 All Registered Vendors</h3>
  <table class="table table-bordered mt-3">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody id="vendorTable"></tbody>
  </table>

  <a href="dashboard.php" class="btn btn-link">← Back to Dashboard</a>
</div>

<script>
const adminId = localStorage.getItem("admin_id");
if (!adminId) {
  alert("Please login."); window.location.href = "login.php";
}

fetch("../backend/admin/get_vendors.php")
  .then(res => res.json())
  .then(data => {
    if (data.status) {
      const tbody = document.getElementById("vendorTable");
      data.vendors.forEach(v => {
        tbody.innerHTML += `
          <tr>
            <td>${v.id}</td>
            <td>${v.name}</td>
            <td>${v.email}</td>
          </tr>
        `;
      });
    }
  });
</script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
