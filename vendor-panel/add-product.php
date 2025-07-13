<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product - Vendor Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      max-width: 600px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

<div class="container">
  <h3 class="mb-4 text-center">➕ Add New Product</h3>
  <form id="productForm" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Product Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Price (₹)</label>
      <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Product Image</label>
      <input type="file" name="image" accept="image/*" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success w-100">Add Product</button>
    <a href="dashboard.php" class="btn btn-link mt-2 w-100">← Back to Dashboard</a>
  </form>
</div>

<script>
const vendorId = localStorage.getItem("vendor_id");
if (!vendorId) {
  alert("Please login first.");
  window.location.href = "login.php";
}

document.getElementById("productForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(e.target);
  formData.append("vendor_id", vendorId);

  const res = await fetch("../backend/vendors/add_product.php", {
    method: "POST",
    body: formData
  });

  const data = await res.json();
  alert(data.message);
  if (data.status) e.target.reset();
});
</script>

</body>
</html>
<?php include 'includes/footer.php'; ?>
