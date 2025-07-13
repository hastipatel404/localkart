<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="login-box">
  <h4 class="text-center mb-4">🛡 Admin Login</h4>
  <form id="loginForm">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" class="form-control" id="username" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" class="form-control" id="password" required>
    </div>
    <button class="btn btn-primary w-100">Login</button>
  </form>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  const res = await fetch("../backend/admin/auth.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, password })
  });

  const data = await res.json();
  alert(data.message);

  if (data.status) {
    localStorage.setItem("admin_id", data.admin_id);
    window.location.href = "dashboard.php";
  }
});
</script>
</body>
</html>
