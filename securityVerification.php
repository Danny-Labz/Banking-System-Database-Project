<?php
session_start();
include("config.php");

if (!isset($_SESSION['CustomerID'])) {
    echo "No Customer ID Found!";
    exit;
}

$customerID = $_SESSION['CustomerID'];
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer1 = $_POST['SecurityAnswer'] ?? '';
    $answer2 = $_POST['SecurityAnswer2'] ?? '';

    $stmt = $conn->prepare("SELECT SecurityAnswer, SecurityAnswer2 FROM SecurityVerification WHERE CustomerID = ?");
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (
            strtolower(trim($answer1)) === strtolower(trim($row['SecurityAnswer'])) &&
            strtolower(trim($answer2)) === strtolower(trim($row['SecurityAnswer2']))
        ) {
            // Successful verification → Redirect to bankaccount.php
            header("Location: bankaccount.php");
            exit;
        } else {
            $error = "Incorrect answers. Please try again.";
        }
    } else {
        $error = "Security info not found.";
    }
} else {
    // Get questions to display
    $stmt = $conn->prepare("SELECT SecurityQuestion, SecurityQuestion2 FROM SecurityVerification WHERE CustomerID = ?");
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Security Verification</title>
    <style>
        body {
            background-color: white;
            font-family: Segoe UI, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
        }
        .Security-container {
            text-align: center;
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 10px;
            margin-top: 300px;
        }
        h1 {
            color: #79ee8b;
            font-size: 40px;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            font-size: 16px;
            margin-top: 10px;
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }
        button {
            background-color: #45a049;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="Security-container">
        <h1>Security Verification</h1>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Security Question #1:</label><br>
            <strong><?php echo htmlspecialchars($row['SecurityQuestion'] ?? ''); ?></strong><br>
            Answer: <input type="password" name="SecurityAnswer" required><br>

            <label>Security Question #2:</label><br>
            <strong><?php echo htmlspecialchars($row['SecurityQuestion2'] ?? ''); ?></strong><br>
            Answer: <input type="password" name="SecurityAnswer2" required><br>

            <button type="submit">Verify</button>
            <button type="reset">Clear</button>
        </form>
    </div>
</body>
</html>
