<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id        = intval($_POST['customerID']);
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

    $stmt = $conn->prepare("UPDATE Customer SET
        FirstName = ?, LastName = ?, DateOfBirth = ?, SSN = ?,
        Email = ?, PhoneNumber = ?, Address = ?, City = ?, State = ?, Zip = ?, Country = ?
        WHERE CustomerID = ?");

    $stmt->bind_param("sssssssssssi", $firstName, $lastName, $dob, $ssn, $email, $phone, $address, $city, $state, $zip, $country, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: profile_view.php?id=$id&updated=true");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
