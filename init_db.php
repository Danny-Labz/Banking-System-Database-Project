<?php
include 'config.php';

$sqlFile = 'banking_system.sql';
$sql = file_get_contents($sqlFile);

if (!$sql) {
    die("Failed to read SQL file: $sqlFile");
}

if ($conn->multi_query($sql)) {
    echo "Database schema initialized successfully.";
    do {
        // flush remaining results
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
} else {
    echo "Error executing schema creation: " . $conn->error;
}

$conn->close();
?>
