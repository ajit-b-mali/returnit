<?php
// router.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 1. Security: Block access to /includes/ and .sql files
if (preg_match('#^/includes/#', $uri) || preg_match('#\.sql$#', $uri)) {
    require '404.php';
    exit;
}

// 2. Serve Static Files (CSS, JS, Images) directly
if (file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false; // PHP handles this automatically
}

// 3. Pretty URLs: If user asks for /login, serve login.php
if (file_exists(__DIR__ . $uri . '.php')) {
    require __DIR__ . $uri . '.php';
    exit;
}

// 4. Handle Root URL (/)
if ($uri === '/' || $uri === '/index.php') {
    require 'index.php';
    exit;
}

// 5. If nothing matches, show 404
require '404.php';
?>