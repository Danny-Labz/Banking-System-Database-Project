<?php
    include("config.php");
    
session_start();
if (isset($_SESSION['CustomerID'])) {

    $customerID = $_SESSION['CustomerID'];
}
else {

    echo "No Customer ID Found! Please Log In Again.";
    header( "refresh:5; url=Login.php");
    die();
}
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
        <title>Transaction Log</title>
    </head>

    <body id="mainBody">

    <form action="BankAccount.php" style="
        border-radius: 25px;
        background: rgba(121, 238, 139, 1);
        padding: 10px; 
        width: 70px;
        height: 20x;  ">

        <input type="submit" value="Go Back" style="border-radius: 10px;">
    </form>

    <!-- This is the section displaying Transaction Log -->
        <h1 style="background-color:rgba(121, 238, 139, 1);">Transaction Log</h1>

        <?php 
        #creating vars and defaults
        $inputDate = $_POST['specDate'] ?? ''; 
        $specAccount = $_POST['accountBox'] ?? '';
        ?>

    
        <!-- Sets an update to detect -->
        <form id="filter" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method=POST>

        <div>
            <!-- Creates Calendar for specific date -->
            <label for="specDate">Date:</label>
            <input type="date" id="specDate" name="specDate" value="<?php echo htmlspecialchars($inputDate); ?>">

            <!-- Submits empty date to query -->
            <input type="submit" onclick="document.getElementById('specDate').value = '';" value="Reset Date">
        </div>

        <br>


        <?php

        # Selects types of accounts from user
        $sql = "SELECT accountType FROM BankAccount WHERE CustomerID = '$customerID'";
        $result = mysqli_query($conn, $sql);

        #if more than one account
        if(mysqli_num_rows($result) > 1) {

            #create a dropdown box with all options
            echo "<div>";
                echo "<label for='accountBox'>Choose an account:</label>";
                echo "<select id='accountBox' name='accountBox'>";

                # setup choice selection storage and default
                $selected = ($specAccount == '') ? "selected" : "";
                echo "<option value='' $selected>All</option>";

                // Loop through account types
                while ($row = mysqli_fetch_assoc($result)) {

                    # set $account to row from database
                    $account = $row["accountType"]; 

                    # if account == account to sort by, set that one as selected, else move on
                    $selected = ($account == $specAccount) ? "selected" : "";


                    echo "<option value='$account' $selected>$account</option>";
                }

                echo "</select>";
            echo "</div>";
            echo "<br>";
            
        }
        ?>
        
 
        <div>
            <!-- Submits to query -->
            <input type="submit" name="submit" value="Sort">

            <input type="submit" onclick="document.getElementById('specDate').value = '';
            document.getElementById('accountBox').value = '';" value="Reset All">
        </div>

        </form>

        <hr>

        <br>

        <!-- beginning of actual table -->
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
                <th>Account Type</th>
                <th>Transaction Id</th>
                <th>Transaction Amount</th>
                <th>Transaction Type</th>
                <th>Transaction Time</th>
                <th>Running Balance</th>
            </tr>

            <?php

            #basic query to get all transactions
            $sql = "SELECT AccountLedger.AccountID, AccountType, "
                . "TransactionID, TransactionAmount, TransactionType, "
                . "TransactionTime, RunningBalance "
                . "FROM AccountLedger "
                . "INNER JOIN BankAccount ON AccountLedger.AccountID = BankAccount.AccountID "
                . "INNER JOIN customer ON BankAccount.CustomerID = customer.CustomerID "
                . "WHERE BankAccount.CustomerID = '$customerID' ";

            # if a special filter is added
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                # add specific account
                if (!empty($_POST['accountBox'])) {
                    $specAccount = $_POST['accountBox'];
                
                    $sql .= "AND BankAccount.AccountType = '$specAccount' ";
                }

                # add specific date
                if (!empty($_POST['specDate'])) {
                    $inputDate = $_POST['specDate'];
                
                    $sql .= "AND CAST(AccountLedger.TransactionTime AS DATE) = '$inputDate' ";
                }
            
            }
            #debug by outputting query
            #echo "<p>QUERY: $sql</p>";
            
                # check results and if there are any
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){

                    # displays them
                    while($row = mysqli_fetch_assoc($result)){

                    echo "<tr align='center'>";
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