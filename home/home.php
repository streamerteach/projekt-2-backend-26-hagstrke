<?php
$sql = "SELECT * FROM profiles";
// Execute the SQL query
$result = $conn->query($sql);
// Process the result set
if ($result->rowCount() > 0) {
    // Output data of each row
    while ($row = $result->fetch()) {
        include "./post.php";
    }
} else {
    echo "No records found.";
}
