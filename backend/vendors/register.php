<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vendor Register - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
    }
    .register-box {
      max-width: 450px;
      margin: 80px auto;
      padding: 30px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="register-box">
  <h3 class="mb-4 text-center">Vendor Registration</h3>
  <form onsubmit="registerVendor(event)">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" class="form-control" id="name" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" class="form-control" id="email" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" class="form-control" id="password" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Register</button>
    <p class="text-center mt-3">
      Already have an account? <a href="login.php">Login</a>
    </p>
  </form>
</div>

<script>
function registerVendor(e) {
  e.preventDefault();

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;

  fetch("../backend/vendors/vendor_register.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ name, email, password })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    if (data.status) {
      window.location.href = "login.php";
    }
  });
}
</script>

</body>
</html>
