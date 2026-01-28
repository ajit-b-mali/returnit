<?php
require __DIR__ . '/../config/session.php';
require __DIR__ . '/../config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Password do not match";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "Email already registered";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hash]);

            $success = "Account created successfully. You can Login now.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ReturnIt</title>
</head>
<body>
    <h2>Register</h2>

    <?php if ($error): ?>
        <p style="color: red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color: green"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" id="username" placeholder="User Name" required>
        <br><br>
    
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br><br>

        <input type="password" name="password" id="password" placeholder="Password" required>
        <br><br>

        <input type="password" name="confirm_password" id="password" placeholder="Confirm Password" required>
        <br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>