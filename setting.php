<!-- <?php
// include 'includes/header.php'; // Reuse your head/nav code
// ?>

<div class="max-w-4xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-bold text-slate-900 mb-6">Account Settings</h2>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
        <div class="flex items-center gap-6">
            <div class="h-20 w-20 rounded-full bg-slate-900 text-white flex items-center justify-center text-3xl font-bold">
                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-900"><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
                <p class="text-slate-500">Member since 2023</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Security</h3>
        <form action="" method="POST" class="max-w-md space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Current Password</label>
                <input type="password" class="w-full border-slate-300 rounded-lg">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">New Password</label>
                <input type="password" class="w-full border-slate-300 rounded-lg">
            </div>
            <button class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">Update Password</button>
        </form>
    </div>
</div> -->

<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/header.php';

// Auth Guard
// if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$msg = "";
$error = "";
$user_id = $_SESSION['user_id'];

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // --- UPDATE PASSWORD ---
    if (isset($_POST['update_password'])) {
        $new_pass = $_POST['new_password'];
        if (strlen($new_pass) < 6) {
            $error = "Password must be at least 6 characters.";
        } else {
            $hash = password_hash($new_pass, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
            if ($stmt->execute([$hash, $user_id])) {
                $msg = "Password updated successfully.";
            }
        }
    }

    // --- DELETE ACCOUNT ---
    if (isset($_POST['delete_account'])) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        if ($stmt->execute([$user_id])) {
            session_destroy();
            header("Location: index.php"); // Redirect to home
            exit;
        }
    }
}
?>

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-display font-bold text-slate-900 mb-8">Account Settings</h1>

    <?php if($msg): ?><div class="p-4 mb-6 bg-green-50 text-green-700 rounded-lg border border-green-200"><?php echo $msg; ?></div><?php endif; ?>
    <?php if($error): ?><div class="p-4 mb-6 bg-red-50 text-red-700 rounded-lg border border-red-200"><?php echo $error; ?></div><?php endif; ?>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8 flex items-center gap-6">
        <div class="h-20 w-20 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 text-white flex items-center justify-center text-3xl font-bold shadow-lg">
            <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
        </div>
        <div>
            <h3 class="text-xl font-bold text-slate-900"><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
            <p class="text-slate-500">User ID: #<?php echo $_SESSION['user_id']; ?></p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 h-full">
            <h3 class="text-lg font-bold text-slate-900 mb-1">Security</h3>
            <p class="text-sm text-slate-500 mb-6">Update your password to keep your account safe.</p>
            
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">New Password</label>
                    <input type="password" name="new_password" required class="w-full border-slate-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <button type="submit" name="update_password" class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-primary transition shadow-lg">
                    Update Password
                </button>
            </form>
        </div>

        <div class="bg-red-50 rounded-2xl border border-red-100 p-8 h-full">
            <h3 class="text-lg font-bold text-red-900 mb-1">Danger Zone</h3>
            <p class="text-sm text-red-600 mb-6">Once you delete your account, there is no going back. All items and debts will be permanently removed.</p>
            
            <form method="POST" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                <button type="submit" name="delete_account" class="px-4 py-2 bg-white border border-red-200 text-red-600 font-bold rounded-lg hover:bg-red-600 hover:text-white transition shadow-sm">
                    Delete My Account
                </button>
            </form>
        </div>
    </div>
</main>
</body>
</html>