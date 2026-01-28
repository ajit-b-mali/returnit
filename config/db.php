<?php
// 1. Get credentials (Render Env or Local Fallback)
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = getenv('DB_PORT');

// Local Fallback
if (!$host) {
    $secrets_file = __DIR__ . '/secrets.php';
    if (file_exists($secrets_file)) {
        require_once $secrets_file;
        $host = LOCAL_DB_HOST;
        $user = LOCAL_DB_USER;
        $pass = LOCAL_DB_PASS;
        $db   = LOCAL_DB_NAME;
        $port = LOCAL_DB_PORT;
    } else {
        $host = '127.0.0.1';
        $user = 'returnit_user';
        $pass = 'returnit_pass';
        $db   = 'returnit_db';
        $port = 3306;
    }
}

// 2. The PDO Connection Logic
try {
    // DSN = Data Source Name (The string that describes the DB)
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw errors!
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Return arrays
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Better security
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (\PDOException $e) {
    error_log("DB CONNECTION ERROR: " . $e->getMessage());
    die("Service temporarily unavailable. Please try again later.\n");
}
?>