<?php
include("config.php");

// Fetch Customer
$customerID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Form was submitted — update customer
    $stmt = $conn->prepare("UPDATE Customer SET FirstName=?, LastName=?, DateOfBirth=?, SSN=?, Email=?, PhoneNumber=?, Address=? WHERE CustomerID=?");
    $stmt->bind_param("sssssssi",
        $_POST['FirstName'],
        $_POST['LastName'],
        $_POST['DateOfBirth'],
        $_POST['SSN'],
        $_POST['Email'],
        $_POST['PhoneNumber'],
        $_POST['Address'],
        $customerID
    );
    $stmt->execute();
    $stmt->close();
}

// Always fetch current data
$stmt = $conn->prepare("SELECT * FROM Customer WHERE CustomerID = ?");
$stmt->bind_param("i", $customerID);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$customer) {
    die("Customer not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Profile View</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 2rem; }
    .form-section {
      background: #fff; padding: 2rem; border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; margin: auto;
    }
    .avatar { float: left; margin-right: 1rem; border-radius: 50%; width: 80px; height: 80px; background: url('https://via.placeholder.com/80') no-repeat center; background-size: cover; }
    .form-header { display: flex; align-items: center; margin-bottom: 2rem; }
    .form-header h2 { margin: 0; }
    label { display: block; margin-top: 1rem; font-weight: bold; }
    input[type="text"], input[type="email"], input[type="date"] {
      width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;
    }
    button {
      margin-top: 1.5rem; padding: 0.7rem 1.5rem; font-size: 1rem;
      border: none; border-radius: 4px; cursor: pointer;
    }
    #editBtn { background-color: #007bff; color: #fff; }
    #saveBtn { background-color: #28a745; color: #fff; display: none; }
  </style>
  <script>
    function enableEdit() {
      const inputs = document.querySelectorAll("input[type='text'], input[type='email'], input[type='date']");
      inputs.forEach(input => input.disabled = false);
      document.getElementById("editBtn").style.display = "none";
      document.getElementById("saveBtn").style.display = "inline-block";
    }
  </script>
</head>
<body>

  <form method="POST" class="form-section">
    <div class="form-header">
      <div class="avatar"></div>
      <h2><?= htmlspecialchars($customer['FirstName'] . ' ' . $customer['LastName']) ?></h2>
    </div>

    <label>First Name</label>
    <input type="text" name="FirstName" value="<?= htmlspecialchars($customer['FirstName']) ?>" disabled>

    <label>Last Name</label>
    <input type="text" name="LastName" value="<?= htmlspecialchars($customer['LastName']) ?>" disabled>

    <label>Date of Birth</label>
    <input type="date" name="DateOfBirth" value="<?= $customer['DateOfBirth'] ?>" disabled>

    <label>SSN</label>
    <input type="text" name="SSN" value="<?= $customer['SSN'] ?>" disabled>

    <label>Email</label>
    <input type="email" name="Email" value="<?= $customer['Email'] ?>" disabled>

    <label>Phone Number</label>
    <input type="text" name="PhoneNumber" value="<?= $customer['PhoneNumber'] ?>" disabled>

    <label>Address</label>
    <input type="text" name="Address" value="<?= $customer['Address'] ?>" disabled>

    <button type="button" id="editBtn" onclick="enableEdit()">Edit</button>
    <button type="submit" id="saveBtn">Save Changes</button>
  </form>

</body>
</html>
