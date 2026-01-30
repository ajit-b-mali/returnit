<?php
session_start();

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/header.php'; // Your header file

// 1. Auth Guard
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

// 2. Handle Actions (POST)
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mark_all_read'])) {
        // SQL: UPDATE notifications SET is_read = 1 WHERE user_id = ?
        $msg = "All notifications marked as read.";
    }
    if (isset($_POST['delete_notification'])) {
        $id = $_POST['notification_id'];
        // SQL: DELETE FROM notifications WHERE id = ?
        $msg = "Notification removed.";
    }
}

// 3. Mock Data (Replace this with SQL SELECT query)
// In a real app: SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC
$notifications = [
    [
        'id' => 1,
        'type' => 'alert', // alert, success, info
        'title' => 'Item Overdue',
        'message' => 'The <strong>Power Drill</strong> lent to <strong>Mike</strong> was due yesterday.',
        'time' => '2 hours ago',
        'is_read' => 0 // 0 = Unread
    ],
    [
        'id' => 2,
        'type' => 'success',
        'title' => 'Debt Paid',
        'message' => '<strong>Sarah</strong> marked the $45.00 debt as paid.',
        'time' => '1 day ago',
        'is_read' => 0
    ],
    [
        'id' => 3,
        'type' => 'info',
        'title' => 'Welcome',
        'message' => 'Welcome to ReturnIt! Don\'t forget to set up your profile.',
        'time' => '3 days ago',
        'is_read' => 1 // 1 = Read
    ],
    [
        'id' => 4,
        'type' => 'info',
        'title' => 'System Update',
        'message' => 'We have updated our privacy policy.',
        'time' => '1 week ago',
        'is_read' => 1
    ]
];

?>

<main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-display font-bold text-slate-900">Notifications</h1>
            <p class="text-slate-500 text-sm mt-1">Stay updated on your loans and debts.</p>
        </div>
        
        <div class="flex gap-2">
            <form method="POST">
                <button type="submit" name="mark_all_read" class="inline-flex items-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none transition-colors">
                    <i class="fas fa-check-double mr-2 text-slate-400"></i> Mark all read
                </button>
            </form>
        </div>
    </div>

    <?php if($msg): ?>
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2 animate-fade-in">
            <i class="fas fa-check-circle"></i> <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <div class="space-y-3">
        <?php if (count($notifications) > 0): ?>
            <?php foreach ($notifications as $note): 
                // Determine Styles based on Type and Read Status
                $bg_class = $note['is_read'] ? 'bg-white' : 'bg-indigo-50/40 border-indigo-100';
                $border_color = $note['is_read'] ? 'border-slate-200' : 'border-indigo-200';
                
                // Icon Logic
                $icon = 'fa-info-circle';
                $icon_color = 'text-blue-500 bg-blue-100';
                if($note['type'] == 'alert') { $icon = 'fa-exclamation-triangle'; $icon_color = 'text-amber-500 bg-amber-100'; }
                if($note['type'] == 'success') { $icon = 'fa-check-circle'; $icon_color = 'text-emerald-500 bg-emerald-100'; }
            ?>
            
            <div class="group relative rounded-xl border <?php echo $border_color . ' ' . $bg_class; ?> p-4 shadow-sm transition-all hover:shadow-md hover:border-indigo-300">
                <div class="flex items-start gap-4">
                    
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full <?php echo $icon_color; ?>">
                            <i class="fas <?php echo $icon; ?>"></i>
                        </span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-bold text-slate-900">
                                <?php echo htmlspecialchars($note['title']); ?>
                                <?php if(!$note['is_read']): ?>
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">New</span>
                                <?php endif; ?>
                            </p>
                            <span class="text-xs text-slate-400 whitespace-nowrap ml-2"><?php echo htmlspecialchars($note['time']); ?></span>
                        </div>
                        <p class="mt-1 text-sm text-slate-600 leading-relaxed">
                            <?php echo $note['message']; // Assuming message contains safe HTML like <strong> ?>
                        </p>
                    </div>

                    <div class="flex-shrink-0 self-center ml-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <form method="POST">
                            <input type="hidden" name="notification_id" value="<?php echo $note['id']; ?>">
                            <button type="submit" name="delete_notification" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Delete Notification">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        
        <?php else: ?>
            <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                    <i class="fas fa-bell-slash text-slate-300 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-slate-900">No notifications</h3>
                <p class="text-slate-500 mt-1">You're all caught up! Great job.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-8 flex justify-center">
        <nav class="flex items-center gap-1">
            <button class="p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 disabled:opacity-50"><i class="fas fa-chevron-left"></i></button>
            <button class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium">1</button>
            <button class="px-4 py-2 rounded-lg text-slate-600 hover:bg-slate-100 text-sm font-medium">2</button>
            <button class="px-4 py-2 rounded-lg text-slate-600 hover:bg-slate-100 text-sm font-medium">3</button>
            <button class="p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100"><i class="fas fa-chevron-right"></i></button>
        </nav>
    </div>

</main>

</body>
</html>