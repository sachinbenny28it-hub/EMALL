<?php
$hosts = ['localhost', '127.0.0.1', '::1'];
foreach ($hosts as $host) {
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli($host, 'root', '', 'emall', 3307);
    if ($conn->connect_error) {
        echo $host . ': FAIL - ' . $conn->connect_error . PHP_EOL;
    } else {
        echo $host . ': OK' . PHP_EOL;
        $conn->close();
    }
}
?>
