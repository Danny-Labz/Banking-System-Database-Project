<?php
    include("config.php");

session_start();
if (isset($_SESSION['CustomerID'])) {

    $customerID = $_SESSION['CustomerID'];
}
else {

    echo "No Customer ID Found!";
}


$QandA = "SELECT SecurityQuestion, SecurityAnswer, SecurityQuestion2, SecurityAnswer2 "
    . "FROM SecurityVerification WHERE CustomerID = '$customerID'";
    $result = mysqli_query($conn, $QandA);
    $row = mysqli_fetch_assoc($result)
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
.Security-container {
  text-align: center;
  border: 1px solid #ccc;
  padding: 30px;
  border-radius: 10px;
  margin-top: 300px;
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
        <div class="Security-container">
            <h1>Security Verification</h1>
            <?php if (!empty($error)): ?>

            <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="login.php" method="POST">
                Security Question #1: <?php echo $row['SecurityQuestion']?><type="text" name="SecurityQuestion"><br>
                Answer: <input type="password" name="SecurityAnswer" required><br>
                <br>
                Security Question #2: <?php echo $row['SecurityQuestion2']?><type="text" name="SecurityQuestion2"><br>
                Answer: <input type="password" name="SecurityAnswer2" required><br>
                <button type="submit">Login</button> <button type="reset">Clear</button>
            </form>
    </body>
    </div>

</html>