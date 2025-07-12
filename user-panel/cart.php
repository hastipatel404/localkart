<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Cart - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f1f1f1;
    }
    .cart-card {
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .product-img {
      height: 100px;
      object-fit: cover;
    }
    .remove-btn {
      height: 36px;
    }
  </style>
</head>
<body>

<div class="container my-4">
  <h3 class="mb-4">🛒 My Cart</h3>
  <div id="cartItems" class="row"></div>
  <div class="text-end mt-4">
    <h5>Total: ₹<span id="cartTotal">0</span></h5>
    <button class="btn btn-success mt-2" onclick="placeOrder()">Place Order</button>
  </div>
</div>

<script>
const userId = localStorage.getItem("user_id");
if (!userId) {
  alert("Please login first.");
  window.location.href = "login.php";
}

// Fetch and display cart
document.addEventListener("DOMContentLoaded", async () => {
  const res = await fetch("../backend/users/get_cart.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ user_id: userId })
  });

  const data = await res.json();
  const cartItems = document.getElementById("cartItems");
  let total = 0;

  if (data.status && data.items.length > 0) {
    data.items.forEach(item => {
      const itemTotal = item.price * item.quantity;
      total += itemTotal;

      cartItems.innerHTML += `
        <div class="col-md-6 mb-4">
          <div class="card cart-card p-3 d-flex flex-row align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <img src="../backend/uploads/${item.image}" class="product-img me-3" width="100" />
              <div>
                <h5>${item.name}</h5>
                <p>Price: ₹${item.price} × ${item.quantity}</p>
                <strong>Subtotal: ₹${itemTotal}</strong>
              </div>
            </div>
            <button class="btn btn-danger btn-sm remove-btn" onclick="removeFromCart(${item.cart_id})">Remove</button>
          </div>
        </div>
      `;
    });
  } else {
    cartItems.innerHTML = "<p>No items in cart.</p>";
  }

  document.getElementById("cartTotal").innerText = total;
});

// Remove item from cart
function removeFromCart(cartId) {
  if (!confirm("Remove this item?")) return;

  fetch("../backend/users/remove_from_cart.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ cart_id: cartId })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    if (data.status) location.reload();
  });
}

// Place order
function placeOrder() {
  if (!confirm("Are you sure you want to place the order?")) return;

  fetch("../backend/users/place_order.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ user_id: userId })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    if (data.status) {
      location.reload();
    }
  });
}
</script>

</body>
</html>
