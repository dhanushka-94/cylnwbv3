<?php

// Simple helper to list all tables in the primary site database using .env-style defaults.

try {
    $dsn = 'mysql:host=127.0.0.1;dbname=mskcomputers_sitedb;charset=utf8mb4';
    $user = 'root';
    $pass = '';

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM,
    ]);

    $stmt = $pdo->query('SHOW TABLES');

    while ($row = $stmt->fetch()) {
        echo $row[0], PHP_EOL;
    }
} catch (Throwable $e) {
    fwrite(STDERR, 'Error: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

