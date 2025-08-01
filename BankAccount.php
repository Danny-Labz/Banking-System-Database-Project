<?php
    include("config.php");

session_start();
if (isset($_SESSION['CustomerID'])) {

    $customerID = $_SESSION['CustomerID'];
}
else {

    echo "No Customer ID Found!";
}

$customerID = isset($_GET['id']) ? intval($_GET['id']) : 0;

/*
    selecting whatever query template

    $sql = "SELECT * FROM BankAccount";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    while($row = mysqli_fetch_assoc($result)){
        echo $row["AccountID"] . "<br>";
    }
        */
    

?>
<!DOCTYPE html>
<html>
    <head>
        <hr>
        <title>Your Bank Account</title>
    </head>

    <body id="mainBody">

        <!-- this is the section displaying Basic Bank Account Info -->
        <h1 style="background-color: #79EE8B;" >Your Bank Account:</h1>
        <hr>

        <div class="Balance Display">

        <?php
        
        #select stuff from table 
        $sql = "SELECT Customer.FirstName, BankAccount.Balance, BankAccount.AccountType " 
            . "FROM BankAccount "
            . "INNER JOIN Customer ON BankAccount.CustomerID = Customer.CustomerID "
            . "WHERE Customer.CustomerID = '$customerID'";

        $result = mysqli_query($conn, $sql);

        # if there are results
        if(mysqli_num_rows($result) > 0) {

            #displays all results 
            $row = mysqli_fetch_assoc($result);
            echo "<p>Hello, " . $row["FirstName"] . "</p>";

                echo "<ul>";
                foreach($result as $row){
                    echo "<li><b>" . $row["AccountType"] . " Balance: $" . $row["Balance"] . "</b></li>";
                    
                    # Warn user for negative balance
                    if ($row["Balance"] < 0) {

                        echo "<p>WARNING: Your " . $row["AccountType"] . " account has a negative balance!";
                    }
                    
                    echo "<br>";
                }
            echo "</ul>";
        }
            
        ?>

        </div>
        <hr>

        <!-- make it look puuuurrty -->
        <!-- Bro Code once again with helping spice the view -->
        <style>
            form {
                border-radius: 25px;
                background: #79EE8B;
                padding: 10px; 
                width: 500px;
                height: 20x;  
            }
            .navSection ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                text-align: center;
            }

            .navSection li {
                float: left;
                width: 125px;
                border-style: solid;
                border-width: 1px;
                border-color: #5EBB6C;
            }

            .navSection a {
                display: block;
                padding: 8px;
                background-color: #79EE8B;
                color: #000000ff;
                text-decoration: none;
            }

            .navSection a:hover {

                background-color: #5EBB6C;
            }

        </style>

        <nav class=navSection>
            <ul> 
                <li><a href="TransactionLog.php">Transaction Log</a></li>
                <li><a href="profile_view.php">Profile View</a></li>
                <li><a href="Branch.php">Your Branch</a></li>
                <li><a href="">Logout</a></li>

                <?php

                if ($roleid == 1) {

                    echo "<li><a href='AdminstratorViewOnly.php'>Administrator</a></li>";
                }

                ?>
            </ul>
        </nav>

    </body>
</html>


