<?php
include("config.php");

$customerID = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM Customer WHERE CustomerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerID);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if (!$customer) {
    die("Customer not found.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Profile View</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 2rem;
      background: #f2f2f2;
    }
    .profile-header {
      display: flex;
      align-items: center;
      background: white;
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 2rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: #ccc;
      background-image: url('https://via.placeholder.com/80');
      background-size: cover;
      margin-right: 1rem;
    }
    .name {
      font-size: 1.8rem;
      font-weight: bold;
    }
    .section {
      background: white;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .section h3 {
      margin-top: 0;
      color: #333;
      border-bottom: 1px solid #ccc;
      padding-bottom: 0.5rem;
    }
    .info {
      margin: 0.5rem 0;
    }
    .label {
      font-weight: bold;
      color: #555;
    }
    .value {
      margin-left: 0.5rem;
      color: #000;
    }
  </style>
</head>
<body>

  <div class="profile-header">
    <div class="avatar"></div>
    <div class="name"><?= htmlspecialchars($customer['FirstName'] . ' ' . $customer['LastName']) ?></div>
  </div>

  <div class="section">
    <h3>Contact Information</h3>
    <div class="info"><span class="label">Email:</span> <span class="value"><?= $customer['Email'] ?></span></div>
    <div class="info"><span class="label">Phone:</span> <span class="value"><?= $customer['PhoneNumber'] ?></span></div>
  </div>

  <div class="section">
    <h3>Personal Details</h3>
    <div class="info"><span class="label">Date of Birth:</span> <span class="value"><?= $customer['DateOfBirth'] ?></span></div>
    <div class="info"><span class="label">SSN:</span> <span class="value"><?= $customer['SSN'] ?></span></div>
  </div>

  <div class="section">
    <h3>Address</h3>
    <div class="info"><span class="label">Address:</span> <span class="value"><?= $customer['Address'] ?></span></div>
  </div>

  <div class="section">
    <h3>Account Metadata</h3>
    <div class="info"><span class="label">Role Access:</span> 
      <span class="value">
        <?php
          switch ($customer['RoleAccess']) {
            case 1: echo "Viewer"; break;
            case 2: echo "Editor"; break;
            case 3: echo "Admin"; break;
            default: echo "Unknown";
          }
        ?>
      </span>
    </div>
    <div class="info"><span class="label">Last Updated:</span> <span class="value"><?= $customer['LastUpdated'] ?></span></div>
  </div>

</body>
</html>
