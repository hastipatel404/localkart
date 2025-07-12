<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f8ffae, #43c6ac);
      height: 100vh;
    }
    .register-card {
      max-width: 500px;
      margin: auto;
      margin-top: 80px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      border-radius: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card register-card p-4">
    <h3 class="text-center mb-4">User Registration</h3>
    <form id="registerForm">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" required />
      </div>
      <div id="responseMsg" class="text-danger text-center mb-2"></div>
      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
  </div>
</div>

<script>
document.getElementById("registerForm").addEventListener("submit", async function(e) {
  e.preventDefault();
  const res = await fetch("../backend/auth/user_register.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      password: document.getElementById("password").value
    })
  });
  const result = await res.json();
  document.getElementById("responseMsg").innerText = result.message;
  if (result.status) {
    alert("Registered! Redirecting to login...");
    window.location.href = "login.php";
  }
});
</script>
</body>
</html>
