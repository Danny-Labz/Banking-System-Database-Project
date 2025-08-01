<?php
include 'config.php';

// Create Branch table if it doesn't exist
$create_sql = "CREATE TABLE IF NOT EXISTS Branch (
    BranchID INT PRIMARY KEY,
    AssignedBankerID INT,
    Address VARCHAR(255),
    PhoneNumber VARCHAR(20)
);";

mysqli_query($conn, $create_sql);

// Insert multiple rows of dummy data
$insert_sql = "INSERT INTO Branch (BranchID, AssignedBankerID, Address, PhoneNumber) VALUES
    (1, 101, '123 Elm Street, Miami, FL 33101', '(305) 555-1234'),
    (2, 102, '456 Oak Avenue, Orlando, FL 32801', '(407) 555-5678'),
    (3, 103, '789 Pine Road, Tampa, FL 33602', '(813) 555-9012'),
    (4, 104, '321 Maple Blvd, Jacksonville, FL 32202', '(904) 555-3456'),
    (5, 105, '654 Cedar Lane, Fort Lauderdale, FL 33301', '(954) 555-7890'),
    (6, 106, '147 Palm Ave, Hialeah, FL 33010', '(786) 555-1122'),
    (7, 107, '258 Beach St, St. Petersburg, FL 33701', '(727) 555-3344'),
    (8, 108, '369 Coral Way, Naples, FL 34102', '(239) 555-5566'),
    (9, 109, '951 Sunset Dr, Tallahassee, FL 32301', '(850) 555-7788'),
    (10, 110, '753 Ocean Blvd, Sarasota, FL 34236', '(941) 555-9900')
ON DUPLICATE KEY UPDATE Address = VALUES(Address);";

mysqli_query($conn, $insert_sql);

// Fetch data
$result = mysqli_query($conn, "SELECT * FROM Branch");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bank Branch Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Bank Branch Directory</h1>

        <a href="BankAccount.php" class="btn btn-secondary mb-3">← Back</a>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Branch ID</th>
                    <th>Assigned Banker ID</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['BranchID']) ?></td>
                        <td><?= htmlspecialchars($row['AssignedBankerID']) ?></td>
                        <td><?= htmlspecialchars($row['Address']) ?></td>
                        <td><?= htmlspecialchars($row['PhoneNumber']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
