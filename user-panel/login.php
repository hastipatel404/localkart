<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #ffecd2, #fcb69f);
      height: 100vh;
    }
    .login-card {
      max-width: 500px;
      margin: auto;
      margin-top: 100px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      border-radius: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card login-card p-4">
    <h3 class="text-center mb-4">User Login</h3>
    <form id="loginForm">
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" required />
      </div>
      <div id="responseMsg" class="text-danger text-center mb-2"></div>
      <button type="submit" class="btn btn-warning w-100">Login</button>
    </form>
    <p class="text-center mt-3">Don't have an account? <a href="register.php">Register</a></p>
  </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", async function(e) {
  e.preventDefault();
  const res = await fetch("../backend/auth/user_login.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      email: document.getElementById("email").value,
      password: document.getElementById("password").value
    })
  });
  const result = await res.json();
  document.getElementById("responseMsg").innerText = result.message;
  if (result.status) {
    alert("Login successful! Redirecting...");
    window.location.href = "index.php";
  }
});
</script>
</body>
</html>
