<?php
include 'config.php';

<<<<<<< HEAD
=======
$statusMessage = "";

// Database connection confirmation
if ($conn->connect_error) {
    $statusMessage .= "<p style='color:red;'>Database connection failed: " . $conn->connect_error . "</p>";
    exit;
} else {
    $statusMessage .= "<p style='color:green;'>✅ Database connection successful.</p>";
}

// Pull customer ID from query string
>>>>>>> 3de0c243398efa4b1b98799f4aefdc3f600c4bcc
$customerID = isset($_GET['id']) ? intval($_GET['id']) : 0;
$statusMessage = '';

<<<<<<< HEAD
// Load customer data
$sql = "SELECT * FROM Customer WHERE CustomerID = $customerID";
$result = $conn->query($sql);
=======
// Get customer data
$sql = "SELECT * FROM Customer WHERE CustomerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerID);
$stmt->execute();
$result = $stmt->get_result();
>>>>>>> 3de0c243398efa4b1b98799f4aefdc3f600c4bcc

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
} else {
  echo "Customer not found.";
  exit;
}

// Handle post-update message
if (isset($_GET['updated']) && $_GET['updated'] === "true") {
  $statusMessage = "✅ Profile updated successfully!";
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
      margin-right: 1.5rem;
      border: 3px solid #88f297;
    }
    .name input {
      font-size: 1.8rem;
      font-weight: bold;
      border: none;
      background: transparent;
      color: #000;
      margin-bottom: 0.3rem;
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
<<<<<<< HEAD
    .message-box {
      background:#fff;
      border-radius:10px;
      padding:1rem;
      margin-top:2rem;
      box-shadow:0 0 10px rgba(0,0,0,0.1);
      color:#333;
=======
    .status-box {
      background: #fff;
      border-radius: 10px;
      padding: 1rem;
      margin-top: 2rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      color: #333;
>>>>>>> 3de0c243398efa4b1b98799f4aefdc3f600c4bcc
    }
  </style>
</head>
<body>
  <form method="POST" action="update_customer.php">
<<<<<<< HEAD
    <input type="hidden" name="customerID" value="<?php echo $customerID; ?>">
=======
>>>>>>> 3de0c243398efa4b1b98799f4aefdc3f600c4bcc
    <div class="profile-header">
      <div class="avatar"></div>
      <div class="name">
        <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($row['FirstName']) ?>" disabled />
        <input type="hidden" name="customerID" value="<?= $customerID ?>">
      </div>
    </div>

    <div class="section">
      <h3>Demographics</h3>

      <label>Last Name</label>
      <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($row['LastName']) ?>" disabled>

      <label>Date of Birth</label>
      <input type="date" name="dob" id="dob" value="<?= htmlspecialchars($row['DateOfBirth']) ?>" disabled>

      <label>SSN</label>
      <input type="text" name="ssn" id="ssn" value="<?= htmlspecialchars($row['SSN']) ?>" disabled>

      <label>Email</label>
      <input type="email" name="email" id="email" value="<?= htmlspecialchars($row['Email']) ?>" disabled>

      <label>Phone</label>
      <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($row['PhoneNumber']) ?>" disabled>

      <label>Address</label>
      <input type="text" name="address" id="address" value="<?= htmlspecialchars($row['Address']) ?>" disabled>

      <label>City</label>
      <input type="text" name="city" id="city" value="<?= htmlspecialchars($row['City']) ?>" disabled>

      <label>State</label>
      <input type="text" name="state" id="state" value="<?= htmlspecialchars($row['State']) ?>" disabled>

      <label>Zip</label>
      <input type="text" name="zip" id="zip" value="<?= htmlspecialchars($row['Zip']) ?>" disabled>

      <label>Country</label>
      <input type="text" name="country" id="country" value="<?= htmlspecialchars($row['Country']) ?>" disabled>
    </div>

    <div class="button-row">
      <button type="button" id="editBtn" onclick="enableEdit()">Edit</button>
      <button type="submit" id="saveBtn">Save</button>
    </div>
  </form>

<<<<<<< HEAD
  <script>
    function enableEdit() {
      document.querySelectorAll('input:not([type="hidden"])').forEach(el => el.removeAttribute('disabled'));
=======
  <div class="status-box">
    <h4>🔍 System Messages</h4>
    <?= $statusMessage ?>
  </div>

  <script>
    function enableEdit() {
      document.querySelectorAll('input:not([type=hidden])').forEach(el => el.removeAttribute('disabled'));
>>>>>>> 3de0c243398efa4b1b98799f4aefdc3f600c4bcc
      document.getElementById('editBtn').style.display = 'none';
      document.getElementById('saveBtn').style.display = 'inline-block';
    }
  </script>

  <?php if ($statusMessage): ?>
    <div class="message-box">
      <?php echo $statusMessage; ?>
    </div>
  <?php endif; ?>
</body>
</html>
