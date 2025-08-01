<?php
session_start();
include 'config.php';

$statusMessage = "";

// Check session
if (!isset($_SESSION['CustomerID'])) {
    echo "<p style='color:red;'>No customer session found. Please <a href='login.php'>login</a>.</p>";
    exit;
}

$customerID = intval($_SESSION['CustomerID']);

// Redirect status message
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $statusMessage .= "<p style='color:green;'>✅ Profile updated successfully.</p>";
    } elseif ($_GET['status'] === 'error') {
        $msg = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'Unknown error';
        $statusMessage .= "<p style='color:red;'>❌ Update failed: $msg</p>";
    }
}

// Get customer data
$sql = "SELECT * FROM Customer WHERE CustomerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerID);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "<p style='color:red;'>Customer not found.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Customer Profile</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      padding: 2rem;
    }
    .profile-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ffffff;
      border-radius: 16px;
      padding: 1rem 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }
    .avatar {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      background-image: url('https://avatars.githubusercontent.com/u/1?v=4');
      background-size: cover;
      background-position: center;
      border: 3px solid #88f297;
    }
    .header-info {
      flex: 1;
      padding: 0 1rem;
    }
    .header-info .name {
      font-size: 1.8rem;
      font-weight: bold;
      margin: 0;
    }
    .header-info .address,
    .header-info .phone {
      font-size: 1rem;
      color: #555;
      margin: 2px 0;
    }
    .header-email {
      font-size: 0.9rem;
      color: #333;
      text-align: right;
    }

    .section {
      background: #ffffff;
      padding: 1.5rem 2rem;
      border-radius: 16px;
      margin-bottom: 1.5rem;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
    }
    .section h3 {
      margin-top: 0;
      font-size: 1.3rem;
      color: #000;
      border-bottom: 2px solid #88f297;
      padding-bottom: 0.5rem;
    }
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 0.3rem;
    }
    input[type="text"],
    input[type="email"],
    input[type="date"] {
      width: 100%;
      padding: 0.6rem 0.8rem;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #f9f9f9;
      font-size: 1rem;
    }
    button {
      padding: 0.7rem 1.4rem;
      border-radius: 20px;
      font-size: 1rem;
      cursor: pointer;
      border: none;
      transition: background-color 0.3s ease;
    }
    #editBtn {
      background-color: #88f297;
      color: #000;
    }
    #editBtn:hover {
      background-color: #6ed87b;
    }
    #saveBtn {
      background-color: #4CAF50;
      color: white;
      display: none;
    }
    #saveBtn:hover {
      background-color: #45a049;
    }
    .button-row {
      text-align: center;
      margin-top: 1rem;
    }
    input[disabled] {
      background-color: #eee;
      color: #555;
    }
    .status-box {
      background: #fff;
      border-radius: 10px;
      padding: 1rem;
      margin-top: 2rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      color: #333;
    }
  </style>
</head>
<body>
  <form method="POST" action="update_customer.php">
    <div class="profile-header">
      <div class="avatar"></div>
      <div class="header-info">
        <p class="name"><?= htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) ?></p>
        <p class="address"><?= htmlspecialchars($row['Address']) ?></p>
        <p class="phone">📞 <?= htmlspecialchars($row['PhoneNumber']) ?></p>
      </div>
      <div class="header-email">
        📧 <?= htmlspecialchars($row['Email']) ?>
      </div>
    </div>

    <input type="hidden" name="customerID" value="<?= $customerID ?>">

    <div class="section">
      <h3>Demographics</h3>

      <label>Date of Birth</label>
      <input type="date" name="dob" id="dob" value="<?= htmlspecialchars($row['DateOfBirth']) ?>" disabled>

      <label>SSN</label>
      <input type="text" name="ssn" id="ssn" value="<?= htmlspecialchars($row['SSN']) ?>" disabled>

      <label>Address Line 1</label>
      <input type="text" name="address" id="address" value="<?= htmlspecialchars($row['Address']) ?>" disabled>

      <label>Email</label>
      <input type="email" name="email" id="email" value="<?= htmlspecialchars($row['Email']) ?>" disabled>

      <label>Phone</label>
      <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($row['PhoneNumber']) ?>" disabled>
    </div>

    <div class="button-row">
      <button type="button" id="editBtn" onclick="enableEdit()">Edit</button>
      <button type="submit" id="saveBtn">Save</button>
    </div>
  </form>

  <div class="button-row">
    <a href="bankaccount.php" style="
      display: inline-block;
      padding: 0.7rem 1.4rem;
      background-color: #45a049;
      color: #000;
      border-radius: 20px;
      text-decoration: none;
      margin-top: 1rem;
      font-weight: bold;
    ">
      ← Back to Accounts
    </a>
  </div>

    <div class="status-box">
  <h4>🔍 System Messages</h4>
  <?= $statusMessage ?>

  <?php
  if (isset($_GET['status']) && $_GET['status'] === 'success') {
      $checkSQL = "SELECT CustomerID, FirstName, LastName, DateOfBirth, SSN, Email, PhoneNumber, Address, RoleAccess FROM Customer WHERE CustomerID = ?";
      $checkStmt = $conn->prepare($checkSQL);
      $checkStmt->bind_param("i", $customerID);
      $checkStmt->execute();
      $checkResult = $checkStmt->get_result();

      if ($checkResult && $checkResult->num_rows > 0) {
          $updated = $checkResult->fetch_assoc();
          echo "<hr><p><strong>✅ DB Update Confirmed. Current Record:</strong></p>";
          echo "<table style='width:100%; border-collapse: collapse; font-size: 0.95rem;'>
                  <thead>
                    <tr style='background:#eee; text-align:left;'>
                      <th style='border:1px solid #ccc; padding:8px;'>CustomerID</th>
                      <th style='border:1px solid #ccc; padding:8px;'>FirstName</th>
                      <th style='border:1px solid #ccc; padding:8px;'>LastName</th>
                      <th style='border:1px solid #ccc; padding:8px;'>DateOfBirth</th>
                      <th style='border:1px solid #ccc; padding:8px;'>SSN</th>
                      <th style='border:1px solid #ccc; padding:8px;'>Email</th>
                      <th style='border:1px solid #ccc; padding:8px;'>Phone</th>
                      <th style='border:1px solid #ccc; padding:8px;'>Address</th>
                      <th style='border:1px solid #ccc; padding:8px;'>Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['CustomerID']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['FirstName']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['LastName']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['DateOfBirth']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['SSN']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['Email']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['PhoneNumber']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['Address']}</td>
                      <td style='border:1px solid #ccc; padding:8px;'>{$updated['RoleAccess']}</td>
                    </tr>
                  </tbody>
                </table>";
      } else {
          echo "<p style='color:red;'>⚠ Could not retrieve updated values from the database.</p>";
      }
      $checkStmt->close();
  }
  ?>
</div>


  <script>
    function enableEdit() {
      document.querySelectorAll('input[name="email"], input[name="phone"], input[name="address"]').forEach(el => el.removeAttribute('disabled'));
      document.getElementById('editBtn').style.display = 'none';
      document.getElementById('saveBtn').style.display = 'inline-block';
    }
  </script>
</body>
</html>
