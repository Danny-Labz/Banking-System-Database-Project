<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['CustomerID'])) {
    $id      = $_SESSION['CustomerID'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE Customer SET Email = ?, PhoneNumber = ?, Address = ? WHERE CustomerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $email, $phone, $address, $id);

    if ($stmt->execute()) {
        header("Location: profile_view.php?status=success");
    } else {
        header("Location: profile_view.php?status=error&msg=" . urlencode($stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
?>
