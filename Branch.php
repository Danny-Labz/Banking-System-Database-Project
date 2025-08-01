<?php
include 'config.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "banking_system";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM Branch");
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
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .table-green th {
            background-color: #79EE8B;
            color: #000;
        }
        .table-green tr:hover {
            background-color: #e6ffe9;
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
    <div class="container">
        <h1 class="text-center mb-4">Bank Branch Directory</h1>
        <a href="BankAccount.php" class="btn btn-back">← Back</a>
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
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
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
