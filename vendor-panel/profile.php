<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vendor Profile - Localkart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      max-width: 600px;
      margin-top: 50px;
    }
  </style>
</head>
<body>

<div class="container">
  <h3 class="mb-4 text-center">👤 Vendor Profile</h3>
  <form id="profileForm">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" id="email" class="form-control" disabled>
    </div>

    <div class="mb-3">
      <label>Name</label>
      <input type="text" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>New Password <small>(optional)</small></label>
      <input type="password" id="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
    <button type="button" onclick="logout()" class="btn btn-danger w-100 mt-3">Logout</button>
    <a href="dashboard.php" class="btn btn-link mt-2 w-100">← Back to Dashboard</a>
  </form>
</div>

<script>
const vendorId = localStorage.getItem("vendor_id");
if (!vendorId) {
  alert("Please login first.");
  window.location.href = "login.php";
}

async function fetchProfile() {
  const res = await fetch("../backend/vendors/get_vendor.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ vendor_id: vendorId })
  });
  const data = await res.json();
  if (data.status) {
    document.getElementById("email").value = data.vendor.email;
    document.getElementById("name").value = data.vendor.name;
  }
}

document.getElementById("profileForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  const name = document.getElementById("name").value;
  const password = document.getElementById("password").value;

  const res = await fetch("../backend/vendors/update_profile.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ vendor_id: vendorId, name, password })
  });

  const data = await res.json();
  alert(data.message);
  if (data.status) document.getElementById("password").value = "";
});

function logout() {
  localStorage.removeItem("vendor_id");
  window.location.href = "login.php";
}

fetchProfile();
</script>

</body>
</html>
<?php include 'includes/footer.php'; ?>
