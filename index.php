<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s, color 0.3s;
    }
    .dark-mode {
      background-color: #1e1e1e;
      color: white;
    }
    .card {
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }
    .toggle-container {
      position: absolute;
      top: 20px;
      right: 30px;
    }
  </style>
</head>
<body>

<!-- 🌙 Dark Mode Toggle -->
<div class="toggle-container form-check form-switch">
    <br>
  <input class="form-check-input" type="checkbox" id="themeToggle">
  <label class="form-check-label" for="themeToggle">Dark Mode</label>
</div>

<div class="container text-center">
  <h2 class="mb-5 fw-bold">🚀 Welcome to <span class="text-success">Localkart</span></h2>

  <div class="row justify-content-center g-4">
    <!-- User Panel -->
    <div class="col-md-3">
      <div class="card p-4">
        <h5 class="fw-bold">👤 User Panel</h5>
        <p>Buy from local vendors</p>
        <a href="user-panel/login.php" class="btn btn-outline-primary">Go to User Panel</a>
      </div>
    </div>

    <!-- Vendor Panel -->
    <div class="col-md-3">
      <div class="card p-4">
        <h5 class="fw-bold">🏪 Vendor Panel</h5>
        <p>Sell your products online</p>
        <a href="vendor-panel/login.php" class="btn btn-outline-success">Go to Vendor Panel</a>
      </div>
    </div>

    <!-- Admin Panel -->
    <div class="col-md-3">
      <div class="card p-4">
        <h5 class="fw-bold">🛡️ Admin Panel</h5>
        <p>Manage everything</p>
        <a href="admin-panel/login.php" class="btn btn-outline-danger">Go to Admin Panel</a>
      </div>
    </div>
  </div>
</div>

<!-- Dark Mode Script -->
<script>
  const toggle = document.getElementById('themeToggle');
  const body = document.body;

  // Load saved mode
  const savedMode = localStorage.getItem('mode');
  if (savedMode === 'dark') {
    body.classList.add('dark-mode');
    toggle.checked = true;
  }

  toggle.addEventListener('change', () => {
    if (toggle.checked) {
      body.classList.add('dark-mode');
      localStorage.setItem('mode', 'dark');
    } else {
      body.classList.remove('dark-mode');
      localStorage.setItem('mode', 'light');
    }
  });
</script>

</body>
</html>
