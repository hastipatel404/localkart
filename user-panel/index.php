<?php
// user-panel/index.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Localkart - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f9f9f9;
    }
    .vendor-card {
      transition: 0.3s ease-in-out;
    }
    .vendor-card:hover {
      transform: scale(1.03);
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">🛒 Localkart</a>
    <a class="btn btn-outline-primary" href="login.php">Login</a>
  </div>
</nav>

<div class="container mt-5">
  <h3 class="mb-4">Nearby Vendors</h3>
  <div class="row" id="vendorList">
    <!-- Vendors will load here -->
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", async () => {
  const res = await fetch("../backend/users/get_vendors.php");
  const data = await res.json();

  const vendorList = document.getElementById("vendorList");

  if (data.status && data.vendors.length > 0) {
    data.vendors.forEach(vendor => {
      vendorList.innerHTML += `
        <div class="col-md-4 mb-4">
          <div class="card vendor-card p-3">
            <h5>${vendor.store_name}</h5>
            <p><strong>Owner:</strong> ${vendor.name}</p>
            <p><strong>Address:</strong> ${vendor.address}</p>
            <a href="products.php?vendor_id=${vendor.id}" class="btn btn-primary mt-2">View Products</a>
          </div>
        </div>
      `;
    });
  } else {
    vendorList.innerHTML = `<p>No vendors found.</p>`;
  }
});
</script>

</body>
</html>
