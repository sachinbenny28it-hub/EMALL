<?php
$sessionPath = __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'sessions';

if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}

session_save_path($sessionPath);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('APP_BASE')) {
    $documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']) ?: $_SERVER['DOCUMENT_ROOT']) : '';
    $projectRoot = str_replace('\\', '/', __DIR__);
    $basePath = '';

    if ($documentRoot !== '' && strpos($projectRoot, $documentRoot) === 0) {
        $basePath = str_replace('\\', '/', substr($projectRoot, strlen($documentRoot)));
    }

    $basePath = trim($basePath, '/');
    define('APP_BASE', $basePath === '' ? '' : '/' . $basePath);
}
?>
