<?php
require __DIR__ . '/config/session.php';
require __DIR__ . '/config/db.php';

requireLogin();

$stmt = $pdo->prepare("
    SELECT
        COUNT(*) AS items_count
    FROM
        items
    WHERE
        user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$stats = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dastboard - ReturnIt</title>
</head>
<body>
    <h1>ReturnIt Dashboard</h1>

    <p>Items Lent: <?= $stats['items_count'] ?></p>

    <a href="logout.php">Logout</a>

</body>
</html>