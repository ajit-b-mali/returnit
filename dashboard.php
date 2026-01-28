<?php

require __DIR__ . '/config/session.php';
require __DIR__ . '/config/db.php';

requireLogin();

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("SELECT SUM(type='lent') AS total_lent,
                              SUM(type='borrowed') AS total_borrowed,
                              SUM(returned_at IS NOT NULL) AS total_returned,
                              SUM(returned_at IS NULL) AS total_not_returned
                       FROM items
                       WHERE user_id = ?");
$stmt->execute([$user_id]);
$stats = $stmt->fetch();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ReturnIt</title>
</head>
<body>
    <h2>Dashboard</h2>

    <div style="border: 1px solid black">
        <h3>Profile</h3>
        <p>User Name: <?= htmlspecialchars($user['username']) ?></p>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div style="border: 1px solid black">
        <h3>Summary</h3>
        <p>total_lent: <?= htmlspecialchars($stats['total_lent']) ?></p>
        <p>total_lent: <?= htmlspecialchars($stats['total_borrowed']) ?></p>
        <p>total_lent: <?= htmlspecialchars($stats['total_returned']) ?></p>
        <p>total_lent: <?= htmlspecialchars($stats['total_not_returned']) ?></p>
    </div>
</body>
</html>
