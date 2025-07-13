<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-img {
      width: 100px;
      height: 80px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<div class="container py-4">
  <h3>🛠 Manage Your Products</h3>
  <table class="table table-bordered mt-4">
    <thead class="table-dark">
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price (₹)</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="productList"></tbody>
  </table>
  <a href="dashboard.php" class="btn btn-link">← Back to Dashboard</a>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="product_id" id="edit_id">
        <div class="mb-3">
          <label>Name</label>
          <input type="text" name="name" id="edit_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Price</label>
          <input type="number" name="price" id="edit_price" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Change Image</label>
          <input type="file" name="image" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const vendorId = localStorage.getItem("vendor_id");
if (!vendorId) {
  alert("Please login first."); window.location.href = "login.php";
}

const tbody = document.getElementById("productList");
let editModal = new bootstrap.Modal(document.getElementById('editModal'));

async function loadProducts() {
  const res = await fetch("../backend/vendors/get_products.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ vendor_id: vendorId })
  });
  const data = await res.json();
  tbody.innerHTML = "";
  if (data.status) {
    data.products.forEach(p => {
      tbody.innerHTML += `
        <tr>
          <td><img src="../backend/uploads/${p.image}" class="product-img"></td>
          <td>${p.name}</td>
          <td>₹${p.price}</td>
          <td>
            <button class="btn btn-sm btn-warning" onclick="showEdit(${p.id}, '${p.name}', ${p.price})">✏️ Edit</button>
            <button class="btn btn-sm btn-danger" onclick="deleteProduct(${p.id})">🗑 Delete</button>
          </td>
        </tr>
      `;
    });
  }
}

function showEdit(id, name, price) {
  document.getElementById("edit_id").value = id;
  document.getElementById("edit_name").value = name;
  document.getElementById("edit_price").value = price;
  editModal.show();
}

async function deleteProduct(product_id) {
  if (!confirm("Are you sure?")) return;
  const res = await fetch("../backend/vendors/delete_product.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ product_id })
  });
  const data = await res.json();
  alert(data.message);
  loadProducts();
}

document.getElementById("editForm").addEventListener("submit", async e => {
  e.preventDefault();
  const formData = new FormData(e.target);
  const res = await fetch("../backend/vendors/update_product.php", {
    method: "POST",
    body: formData
  });
  const data = await res.json();
  alert(data.message);
  editModal.hide();
  loadProducts();
});

loadProducts();
</script>
</body>
</html>
<?php include 'includes/footer.php'; ?>
