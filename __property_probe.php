<?php
include 'db.php';
$result = $conn->query("DESCRIBE property");
while ($row = $result->fetch_assoc()) {
    echo $row['Field'], '|', $row['Type'], PHP_EOL;
}
?>
