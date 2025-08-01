<?php
session_start();
include 'config.php';

// Ensure session CustomerID is set
if (!isset($_SESSION['CustomerID'])) {
    die("No customer session found. Please <a href='login.php'>login</a>.");
}

$customerID = $_SESSION['CustomerID'];

// Get the BranchID for the customer
$branchID = null;
$branchProfile = null;

$branchResult = mysqli_query($conn, "
    SELECT b.BranchID, b.Address, b.PhoneNumber, b.AssignedBankerID
    FROM Customer c
    JOIN Branch b ON c.BranchID = b.BranchID
    WHERE c.CustomerID = $customerID
");

if ($branchResult && mysqli_num_rows($branchResult) > 0) {
    $branchProfile = mysqli_fetch_assoc($branchResult);
    $branchID = $branchProfile['BranchID'];
}

// Get all branches
$branches = mysqli_query($conn, "SELECT * FROM Branch");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Branch Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f4f4f4;
            display: flex;
        }
        .sidebar {
            width: 300px;
            margin-right: 30px;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        .main-content {
            flex: 1;
        }
        .table-green th {
            background-color: #79EE8B;
            color: #000;
        }
        .table-green tr:hover {
            background-color: #e6ffe9;
        }
        .highlight {
            background-color: #d1ffd9 !important;
        }
        .btn-back {
            margin-bottom: 15px;
            background-color: #79EE8B;
            border-color: #79EE8B;
            color: #000;
        }
        .btn-back:hover {
            background-color: #5edb70;
            border-color: #5edb70;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4> Your Branch Info</h4>
        <?php if ($branchProfile): ?>
            <p><strong>Branch ID:</strong> <?= $branchProfile['BranchID'] ?></p>
            <p><strong>Address:</strong><br><?= $branchProfile['Address'] ?></p>
            <p><strong>Phone:</strong> <?= $branchProfile['PhoneNumber'] ?></p>
            <p><strong>Banker ID:</strong> <?= $branchProfile['AssignedBankerID'] ?></p>
        <?php else: ?>
            <p>No branch information available.</p>
        <?php endif; ?>
        <a href="bankaccount.php" class="btn btn-back mt-3">← Back</a>
    </div>

    <div class="main-content container">
        <h1 class="text-center mb-4">Bank Branch Directory</h1>
        <table class="table table-bordered table-green">
            <thead>
                <tr>
                    <th>Branch ID</th>
                    <th>Assigned Banker ID</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($branches)): ?>
                    <tr class="<?= ($row['BranchID'] == $branchID) ? 'highlight' : '' ?>">
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
