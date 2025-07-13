<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vendor Login - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="login-box">
  <h3 class="mb-4 text-center">Vendor Login</h3>
  <form onsubmit="loginVendor(event)">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" class="form-control" id="email" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" class="form-control" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
    <p class="text-center mt-3">
      Don't have an account? <a href="register.php">Register here</a>
    </p>
  </form>
</div>

<script>
function loginVendor(e) {
  e.preventDefault();
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  fetch("../backend/vendors/vendor_login.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ email, password })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    if (data.status) {
      localStorage.setItem("vendor_id", data.vendor.id);
      window.location.href = "dashboard.php";
    }
  });
}
</script>

</body>
</html>
