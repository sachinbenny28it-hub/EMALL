<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conn = null;
$dbAvailable = false;
$dbError = 'Database connection failed. Please make sure MySQL is running for the eMall project.';
$connectionTargets = [
    ['127.0.0.1', 3307],
    ['localhost', 3307],
    ['127.0.0.1', 3306],
    ['localhost', 3306],
];

foreach ($connectionTargets as [$host, $port]) {
    $candidate = @new mysqli($host, 'root', '', 'emall', $port);

    if (!$candidate->connect_error) {
        $candidate->set_charset('utf8mb4');
        $conn = $candidate;
        $dbAvailable = true;
        break;
    }

    if (!empty($candidate->connect_error)) {
        $dbError = 'Database connection failed: ' . $candidate->connect_error;
    }
}
?>
