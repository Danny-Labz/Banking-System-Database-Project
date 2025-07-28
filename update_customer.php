<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id        = $_POST['customerID'];
    $firstName = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $dob       = $_POST['dob'];
    $ssn       = $_POST['ssn'];
    $email     = $_POST['email'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];
    $city      = $_POST['city'];
    $state     = $_POST['state'];
    $zip       = $_POST['zip'];
    $country   = $_POST['country'];

    // Combine address fields into one full address
    $fullAddress = "$address, $city, $state $zip, $country";

    $sql = "UPDATE Customer SET
            FirstName = ?, LastName = ?, DateOfBirth = ?, SSN = ?,
            Email = ?, PhoneNumber = ?, Address = ?
            WHERE CustomerID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $firstName, $lastName, $dob, $ssn, $email, $phone, $fullAddress, $id);

    if ($stmt->execute()) {
        echo "Customer profile updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
