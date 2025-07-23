<?php
include("config.php");  // Make sure config.php is in the same folder

echo "<h2>Customer Table Records</h2>";

$sql = "SELECT CustomerID, FirstName, LastName, DateOfBirth, SSN, Email, PhoneNumber, Address, RoleAccess, LastUpdated FROM Customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='6'>";
    echo "<tr>
            <th>ID</th><th>First Name</th><th>Last Name</th>
            <th>DOB</th><th>SSN</th><th>Email</th>
            <th>Phone</th><th>Address</th><th>Role</th><th>Updated</th>
          </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['CustomerID']}</td>";
        echo "<td>{$row['FirstName']}</td>";
        echo "<td>{$row['LastName']}</td>";
        echo "<td>{$row['DateOfBirth']}</td>";
        echo "<td>{$row['SSN']}</td>";
        echo "<td>{$row['Email']}</td>";
        echo "<td>{$row['PhoneNumber']}</td>";
        echo "<td>{$row['Address']}</td>";
        echo "<td>{$row['RoleAccess']}</td>";
        echo "<td>{$row['LastUpdated']}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No customers found.";
}

$conn->close();
?>
