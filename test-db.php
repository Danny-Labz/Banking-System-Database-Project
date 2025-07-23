<?php
include("config.php");  // Assumes config.php is in the same folder

echo "<h2>Connected to the database!</h2>";

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>ID: " . $row['id'] . " | Name: " . $row['name'] . " | Balance: $" . $row['balance'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No accounts found.";
}

$conn->close();
?>
