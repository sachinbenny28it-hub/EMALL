<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli('127.0.0.1', 'root', '', 'emall', 3306);
    echo "connected\n";
    $res = $conn->query('SHOW TABLES');
    while ($row = $res->fetch_row()) {
        echo $row[0], "\n";
    }
} catch (Throwable $e) {
    echo get_class($e), ': ', $e->getMessage(), "\n";
}
?>
