<?php
// user-panel/products.php
if (!isset($_GET['vendor_id'])) {
  header("Location: index.php");
  exit;
}
$vendor_id = $_GET['vendor_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f2f2f2;
    }
    .product-card {
      border-radius: 10px;
      transition: 0.3s ease;
    }
    .product-card:hover {
      transform: scale(1.02);
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .product-img {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<div class="container py-4">
  <h3 class="mb-4">Products</h3>
  <div class="row" id="productList">
    <!-- Products will load here -->
  </div>
</div>

<script>
const vendorId = <?= $vendor_id ?>;

document.addEventListener("DOMContentLoaded", async () => {
  const res = await fetch(`../backend/users/get_products.php?vendor_id=${vendorId}`);
  const data = await res.json();

  const productList = document.getElementById("productList");

  if (data.status && data.products.length > 0) {
    data.products.forEach(product => {
      productList.innerHTML += `
        <div class="col-md-4 mb-4">
          <div class="card product-card p-2">
            <img src="../backend/uploads/${product.image}" class="card-img-top product-img" alt="${product.name}">
            <div class="card-body">
              <h5 class="card-title">${product.name}</h5>
              <p class="card-text">₹${product.price}</p>
              <button class="btn btn-success w-100" onclick="addToCart(${product.id})">Add to Cart</button>
            </div>
          </div>
        </div>
      `;
    });
  } else {
    productList.innerHTML = `<p>No products available.</p>`;
  }
});

function addToCart(productId) {
  const userId = localStorage.getItem("user_id");
  if (!userId) {
    alert("Please log in first.");
    window.location.href = "login.php";
    return;
  }

  fetch("../backend/users/add_to_cart.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      user_id: userId,
      product_id: productId
    })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
  });
}

</script>

</body>
</html>
