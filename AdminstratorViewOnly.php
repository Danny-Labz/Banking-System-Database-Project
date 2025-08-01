<?php

include("config.php");

session_start();
if (isset($_SESSION['CustomerID'])) {

    $customerID = $_SESSION['CustomerID'];
    $roleid = $_SESSION['RoleID'];
}
else {

    echo "No Customer ID Found!";
}

if (!$roleid == 2) {

    echo "Not an administrator! Please Log In Again.";

    header( "refresh:5; url=Login.php");
    die();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <hr>
        <title>Administrator View</title>
    </head>

    <form action="BankAccount.php" style="
        border-radius: 25px;
        background: rgba(121, 238, 139, 1);
        padding: 10px; 
        width: 70px;
        height: 20x;  ">

        <input type="submit" value="Go Back" style="border-radius: 10px;">
    </form>
    <br>
    <body id="adminBody">

        <table border ="3" id=TransactionLog>
            <style>
                table {
                border-collapse: collapse;
                width: 100%;
                }

                th, td {
                text-align: middle;
                padding: 8px;
                }

                tr:nth-child(even) {
                background-color: #7cfa8fff;
                }
            </style>

        <!-- creating table column headers -->
         
            <tr align="center">
                <th>Name</th>
                <th>Role Access</th>
                <th>Account ID</th>
                <th>Account Type</th>
                <th>Transaction Id</th>
                <th>Transaction Amount</th>
                <th>Transaction Type</th>
                <th>Transaction Time</th>
                <th>Running Balance</th>
            </tr>

            <?php

$sql = "SELECT customer.FirstName, customer.LastName, customer.RoleAccess, AccountLedger.AccountID, AccountType, "
                . "TransactionID, TransactionAmount, TransactionType, "
                . "TransactionTime, RunningBalance "
                . "FROM AccountLedger "
                . "INNER JOIN BankAccount ON AccountLedger.AccountID = BankAccount.AccountID "
                . "INNER JOIN customer ON BankAccount.CustomerID = customer.CustomerID ";

                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){

                    # displays them
                    while($row = mysqli_fetch_assoc($result)){

                    echo "<tr align='center'>";
                    echo "<td>" . $row["FirstName"] ." " . $row["LastName"] . "</td>";
                    echo "<td>" . $row["RoleAccess"] . "</td>";
                    echo "<td>" . $row["AccountID"] . "</td>";
                    echo "<td>" . $row["AccountType"] . "</td>";
                    echo "<td>" . $row["TransactionID"] . "</td>";
                    echo "<td>" . $row["TransactionAmount"] . "</td>";
                    echo "<td>" . $row["TransactionType"] . "</tdr>";
                    echo "<td>" . $row["TransactionTime"] . "</td>";
                    echo "<td>" . $row["RunningBalance"] . "</td>";
                    echo "</tr>";
                    }
                }
    

                # else say nothing found
                else{

                    echo "<h3>No results found.</h3>";
                    echo "<hr>";
                }
            ?>

        </table>
    </body>
</html>