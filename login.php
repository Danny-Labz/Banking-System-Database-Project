<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $stmt = $conn->prepare("SELECT * FROM SecurityVerification WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['Password']) {
            $_SESSION['CustomerID'] = $user['CustomerID'];
            $_SESSION['Role'] = $user['Rolename'] ?? '';
            $_SESSION['Username'] = $user['Username'];

            // Redirect based on role
            if ($_SESSION['Role'] == 2) {
                header("Location: admin.php");
            } else {
                header("Location: BankAccount.php");
            }
            exit;
        } else {
            $error = "Incorrect Password.";
        }
    } else {
        $error = "User not found.";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>

body{
background-color: white;
font-family: Segoe UI, sans-serif;
display: flex;
justify-content: center;
align-items: center;
font-size: 16px;
}
.login-container {
  text-align: center;
  border: 1px solid #ccc;
  padding: 30px;
  border-radius: 10px;
  margin-top: 400px;
}

h1{
font-family: Segoe UI, sans-serif;
color: #79ee8b; 
font-size: 40px;
margin-bottom: 20px;
}

input[type="text"], input[type="Password"]{
font-family: Segoe UI, sans-serif;
font-size: 16px;
margin-top: 10px;
}

button{
font-family: Segoe UI, sans-serif;
background-color: 45a049ff;
font-size: 16px;
margin-top: 20px;
}


</style>
</head>
<body>
<div class="login-container">
  <h1>Bank Login</h1>
<?php if (!empty($error)): ?>
  <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
  <p>Welcome to your personal online banking experience!</p>
  <form action="login.php" method="POST">
    Username: <input type="text" name="Username" required><br>
    Password: <input type="password" name="Password" required><br>

    <button type="submit">Login</button> <button type="reset">Clear</button>
  </form>
</body>
</div>

</html>