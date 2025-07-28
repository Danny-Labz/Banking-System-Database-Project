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
  <title>Customer Profile</title>
  <style>/* keep your CSS here */</style>
</head>
<body>

  <h2>Customer Profile</h2>

  <form method="POST" action="update_customer.php">
    <input type="hidden" name="customerID" value="<?= $customer['CustomerID'] ?>">

    <div class="form-group">
      <label for="firstName">First Name</label>
      <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($customer['FirstName']) ?>">
    </div>

    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($customer['LastName']) ?>">
    </div>

    <div class="form-group">
      <label for="dob">Date of Birth</label>
      <input type="date" id="dob" name="dob" value="<?= $customer['DateOfBirth'] ?>">
    </div>

    <div class="form-group">
      <label for="ssn">SSN</label>
      <input type="text" id="ssn" name="ssn" value="<?= $customer['SSN'] ?>">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= $customer['Email'] ?>">
    </div>

    <div class="form-group">
      <label for="phone">Phone Number</label>
      <input type="text" id="phone" name="phone" value="<?= $customer['PhoneNumber'] ?>">
    </div>

    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" id="address" name="address" value="<?= $customer['Address'] ?>">
    </div>

    <!-- Optionally split address fields (City, State, etc.) if needed later -->

    <button type="submit">Save Changes</button>
  </form>

</body>
</html>
