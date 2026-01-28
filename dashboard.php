<!-- <?php
// session_start();
// require_once __DIR__ . '/../config/db.php';

// // // 1. Auth Guard
// // if (!isset($_SESSION['user_id'])) {
// //     header("Location: login.php");
// //     exit;
// // }

// $user_id = $_SESSION['user_id'];
// $username = $_SESSION['username'];
// $msg = "";

// // 2. Handle Form Submissions (Add & Updates)
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
//     // --- ADD ITEM ---
//     if (isset($_POST['add_item'])) {
//         $name = trim($_POST['item_name']);
//         $borrower = trim($_POST['borrower']);
//         $date = $_POST['due_date']; // Optional
        
//         if(!empty($name) && !empty($borrower)) {
//             $stmt = $pdo->prepare("INSERT INTO items (user_id, item_name, borrower, due_date) VALUES (?, ?, ?, ?)");
//             $stmt->execute([$user_id, $name, $borrower, $date]);
//             $msg = "Item added successfully!";
//         }
//     }

//     // --- ADD DEBT ---
//     if (isset($_POST['add_debt'])) {
//         $amount = $_POST['amount'];
//         $borrower = trim($_POST['borrower']);
//         $desc = trim($_POST['description']);
        
//         if(!empty($amount) && !empty($borrower)) {
//             $stmt = $pdo->prepare("INSERT INTO debts (user_id, amount, borrower, description) VALUES (?, ?, ?, ?)");
//             $stmt->execute([$user_id, $amount, $borrower, $desc]);
//             $msg = "Debt recorded successfully!";
//         }
//     }

//     // --- TOGGLE STATUS (Item Returned / Debt Paid) ---
//     if (isset($_POST['toggle_status'])) {
//         $id = $_POST['id'];
//         $type = $_POST['type']; // 'item' or 'debt'
        
//         if ($type === 'item') {
//             $stmt = $pdo->prepare("UPDATE items SET returned = NOT returned WHERE id = ? AND user_id = ?");
//         } else {
//             $stmt = $pdo->prepare("UPDATE debts SET paid = NOT paid WHERE id = ? AND user_id = ?");
//         }
//         $stmt->execute([$id, $user_id]);
//     }
// }

// // 3. Fetch Data
// // Fetch Items
// $stmt = $pdo->prepare("SELECT * FROM items WHERE user_id = ? ORDER BY created_at DESC");
// $stmt->execute([$user_id]);
// $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // Fetch Debts
// $stmt = $pdo->prepare("SELECT * FROM debts WHERE user_id = ? ORDER BY created_at DESC");
// $stmt->execute([$user_id]);
// $debts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // Calculate Stats
// $total_lent_items = count($items);
// $active_items = count(array_filter($items, fn($i) => !$i['returned']));
// $total_owed_money = 0;
// foreach($debts as $d) { if(!$d['paid']) $total_owed_money += $d['amount']; }

?> -->

<?php
session_start();

// --- DEMO MODE SETUP ---
// We are skipping the database connection and auth check for this demo.
// In a real app, you would check $_SESSION['user_id'] here.

// 1. Simulate a Logged-In User
if (!isset($_SESSION['username'])) {
    $_SESSION['user_id'] = 999;
    $_SESSION['username'] = "Demo User";
}
$username = $_SESSION['username'];

// 2. Create Dummy Data for Items (Simulating a DB Fetch)
$items = [
    // [
    //     'id' => 1,
    //     'item_name' => 'GoPro Hero 9',
    //     'borrower' => 'Alice Smith',
    //     'created_at' => '2023-10-15',
    //     'returned' => 0 // 0 = With Borrower
    // ],
    // [
    //     'id' => 2,
    //     'item_name' => 'Harry Potter Book Set',
    //     'borrower' => 'John Doe',
    //     'created_at' => '2023-09-20',
    //     'returned' => 1 // 1 = Returned
    // ],
    // [
    //     'id' => 3,
    //     'item_name' => 'Power Drill (Makita)',
    //     'borrower' => 'Neighbor Mike',
    //     'created_at' => '2023-11-01',
    //     'returned' => 0
    // ]
];

// 3. Create Dummy Data for Debts (Simulating a DB Fetch)
$debts = [
    // [
    //     'id' => 101,
    //     'description' => 'Friday Night Pizza',
    //     'borrower' => 'Sarah Connor',
    //     'amount' => 45.50,
    //     'paid' => 0 // 0 = Unpaid
    // ],
    // [
    //     'id' => 102,
    //     'description' => 'Concert Tickets',
    //     'borrower' => 'Tom Hardy',
    //     'amount' => 120.00,
    //     'paid' => 1 // 1 = Paid
    // ],
    // [
    //     'id' => 103,
    //     'description' => 'Uber Share',
    //     'borrower' => 'Alice Smith',
    //     'amount' => 15.25,
    //     'paid' => 0
    // ]
];

// 4. Calculate Stats (Logic remains the same)
$total_lent_items = count($items);
$active_items = count(array_filter($items, fn($i) => !$i['returned']));
$total_owed_money = 0;
foreach($debts as $d) { 
    if(!$d['paid']) $total_owed_money += $d['amount']; 
}

// 5. Handle Mock Form Submissions (Just for UI feedback)
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $msg = "Action simulated! (Connect DB to save changes)";
    // In a real app, SQL INSERT/UPDATE queries would go here.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ReturnIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], display: ['Space Grotesk', 'sans-serif'] },
                    colors: { primary: '#4F46E5', secondary: '#10B981', dark: '#0F172A' }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen">

    <nav class="sticky top-0 z-40 w-full glass border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded flex items-center justify-center text-white font-bold text-sm">R</div>
                    <span class="font-display font-bold text-xl text-slate-900 hidden sm:block">ReturnIt</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-500">Hi, <strong class="text-slate-900"><?php echo htmlspecialchars($username); ?></strong></span>
                    <a href="logout.php" class="text-sm text-slate-500 hover:text-red-500 transition-colors"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Currently Owed to You</p>
                    <h3 class="text-3xl font-display font-bold text-slate-900 mt-1">$<?php echo number_format($total_owed_money, 2); ?></h3>
                </div>
                <div class="w-12 h-12 bg-indigo-50 text-primary rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition">
                <div>
                    <p class="text-sm text-slate-500 font-medium">Active Lent Items</p>
                    <h3 class="text-3xl font-display font-bold text-slate-900 mt-1"><?php echo $active_items; ?></h3>
                </div>
                <div class="w-12 h-12 bg-emerald-50 text-secondary rounded-xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
            <div class="bg-slate-900 p-6 rounded-2xl shadow-lg text-white flex flex-col justify-center relative overflow-hidden group cursor-pointer" onclick="openModal('debtModal')">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>
                <h3 class="text-lg font-bold z-10">Quick Add</h3>
                <p class="text-slate-400 text-sm mb-3 z-10">Log a new loan instantly.</p>
                <div class="flex gap-2 z-10">
                    <button onclick="event.stopPropagation(); openModal('itemModal')" class="flex-1 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-sm font-medium transition backdrop-blur-sm">Item</button>
                    <button onclick="event.stopPropagation(); openModal('debtModal')" class="flex-1 py-2 bg-primary hover:bg-indigo-500 rounded-lg text-sm font-medium transition shadow-lg shadow-indigo-500/50">Money</button>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex p-1 bg-white border border-slate-200 rounded-xl shadow-sm">
                <button id="tab-items" onclick="switchTab('items')" class="px-6 py-2 rounded-lg text-sm font-medium transition-all bg-slate-900 text-white shadow-md">
                    Lent Items
                </button>
                <button id="tab-debts" onclick="switchTab('debts')" class="px-6 py-2 rounded-lg text-sm font-medium transition-all text-slate-500 hover:text-slate-900">
                    Money Owed
                </button>
            </div>
            <button onclick="openModal('itemModal')" class="sm:hidden w-full py-3 bg-slate-900 text-white rounded-xl font-bold shadow-lg">+ Add New</button>
        </div>

        <div class="relative mb-4">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <i class="fas fa-search text-slate-400"></i>
    </div>
    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search items or people..." 
           class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm transition duration-150 ease-in-out">
</div>

        <section id="view-items" class="animate-fade-in">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 tracking-wider">
                                <th class="p-4 font-semibold">Item Name</th>
                                <th class="p-4 font-semibold">Borrowed By</th>
                                <th class="p-4 font-semibold">Date</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if(count($items) > 0): foreach($items as $item): ?>
                            <tr class="group hover:bg-slate-50/50 transition">
                                <td class="p-4 font-medium text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded bg-indigo-50 text-indigo-500 flex items-center justify-center text-sm"><i class="fas fa-cube"></i></div>
                                        <?php echo htmlspecialchars($item['item_name']); ?>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600"><?php echo htmlspecialchars($item['borrower']); ?></td>
                                <td class="p-4 text-slate-500 text-sm"><?php echo date('M j, Y', strtotime($item['created_at'])); ?></td>
                                <td class="p-4">
                                    <?php if($item['returned']): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            Returned
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            With Borrower
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-right">
                                    <form method="POST" class="inline">
                                        <input type="hidden" name="type" value="item">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" name="toggle_status" class="text-xs font-bold text-slate-400 hover:text-primary transition uppercase tracking-wide">
                                            <?php echo $item['returned'] ? 'Undo' : 'Mark Returned'; ?>
                                        </button>
                                    </form>
                                    <a href="mailto:?subject=ReturnIt Reminder&body=Hey! Just a reminder to return my <?php echo $item['item_name']; ?>." 
       class="w-8 h-8 rounded-full bg-indigo-50 text-primary flex items-center justify-center hover:bg-primary hover:text-white transition"
       title="Send Email Reminder">
       <i class="fas fa-paper-plane text-xs"></i>
    </a>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
    <tr>
        <td colspan="5" class="p-12 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-check-circle text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-slate-900 font-bold text-lg">All caught up!</h3>
                <p class="text-slate-500 max-w-xs mx-auto">You haven't lent anything out. Keep it that way, or click "Add New" to track something.</p>
            </div>
        </td>
    </tr>
<?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="view-debts" class="hidden animate-fade-in">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 tracking-wider">
                                <th class="p-4 font-semibold">Description</th>
                                <th class="p-4 font-semibold">Who Owes You</th>
                                <th class="p-4 font-semibold">Amount</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if(count($debts) > 0): foreach($debts as $debt): ?>
                            <tr class="group hover:bg-slate-50/50 transition">
                                <td class="p-4 font-medium text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded bg-emerald-50 text-emerald-500 flex items-center justify-center text-sm"><i class="fas fa-receipt"></i></div>
                                        <?php echo htmlspecialchars($debt['description'] ?: 'Loan'); ?>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600"><?php echo htmlspecialchars($debt['borrower']); ?></td>
                                <td class="p-4 font-mono font-bold text-slate-700">$<?php echo number_format($debt['amount'], 2); ?></td>
                                <td class="p-4">
                                    <?php if($debt['paid']): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Paid</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Unpaid</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-right">
                                    <form method="POST" class="inline">
                                        <input type="hidden" name="type" value="debt">
                                        <input type="hidden" name="id" value="<?php echo $debt['id']; ?>">
                                        <button type="submit" name="toggle_status" class="text-xs font-bold text-slate-400 hover:text-primary transition uppercase tracking-wide">
                                            <?php echo $debt['paid'] ? 'Undo' : 'Mark Paid'; ?>
                                        </button>
                                    </form>
                                    <a href="mailto:?subject=ReturnIt Reminder&body=Hey! Just a reminder to return my <?php echo $item['item_name']; ?>." 
       class="w-8 h-8 rounded-full bg-indigo-50 text-primary flex items-center justify-center hover:bg-primary hover:text-white transition"
       title="Send Email Reminder">
       <i class="fas fa-paper-plane text-xs"></i>
    </a>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" class="p-8 text-center text-slate-400">No debts recorded. Rich friends?</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

    <div id="itemModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" onclick="closeModal('itemModal')"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <form method="POST" class="p-6">
                    <h3 class="text-xl font-display font-bold text-slate-900 mb-4">Lend an Item</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">What are you lending?</label>
                            <input type="text" name="item_name" required placeholder="e.g. Power Drill, Harry Potter Book" class="w-full border-slate-300 rounded-lg bg-slate-50 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Who is taking it?</label>
                            <input type="text" name="borrower" required placeholder="e.g. John Doe" class="w-full border-slate-300 rounded-lg bg-slate-50 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Due Date (Optional)</label>
                            <input type="date" name="due_date" class="w-full border-slate-300 rounded-lg bg-slate-50 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeModal('itemModal')" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 rounded-lg">Cancel</button>
                        <button type="submit" name="add_item" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-indigo-700 rounded-lg shadow-lg shadow-indigo-500/30">Save Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="debtModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" onclick="closeModal('debtModal')"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <form method="POST" class="p-6">
                    <h3 class="text-xl font-display font-bold text-slate-900 mb-4">Record a Debt</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-700 mb-1">Amount ($)</label>
                                <input type="number" step="0.01" name="amount" required placeholder="0.00" class="w-full border-slate-300 rounded-lg bg-slate-50 focus:ring-secondary focus:border-secondary">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 mb-1">Who owes you?</label>
                                <input type="text" name="borrower" required placeholder="Name" class="w-full border-slate-300 rounded-lg bg-slate-50 focus:ring-secondary focus:border-secondary">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Description</label>
                            <input type="text" name="description" placeholder="e.g. Lunch, Concert Ticket" class="w-full border-slate-300 rounded-lg bg-slate-50 focus:ring-secondary focus:border-secondary">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeModal('debtModal')" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 rounded-lg">Cancel</button>
                        <button type="submit" name="add_debt" class="px-4 py-2 text-sm font-medium text-white bg-secondary hover:bg-emerald-600 rounded-lg shadow-lg shadow-emerald-500/30">Save Debt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            // Hide all sections
            document.getElementById('view-items').classList.add('hidden');
            document.getElementById('view-debts').classList.add('hidden');
            
            // Reset Buttons
            document.getElementById('tab-items').classList.remove('bg-slate-900', 'text-white', 'shadow-md');
            document.getElementById('tab-items').classList.add('text-slate-500');
            document.getElementById('tab-debts').classList.remove('bg-slate-900', 'text-white', 'shadow-md');
            document.getElementById('tab-debts').classList.add('text-slate-500');

            // Activate Selected
            document.getElementById('view-' + tabName).classList.remove('hidden');
            const btn = document.getElementById('tab-' + tabName);
            btn.classList.add('bg-slate-900', 'text-white', 'shadow-md');
            btn.classList.remove('text-slate-500');
            
            // Save preference (Optional)
            localStorage.setItem('activeTab', tabName);
        }

        // Modal Logic
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Persist Tab on Reload
        document.addEventListener('DOMContentLoaded', () => {
            const active = localStorage.getItem('activeTab') || 'items';
            switchTab(active);
        });

        function filterTable() {
    // 1. Get input value
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    
    // 2. Detect which tab is active to search the correct table
    let activeTab = localStorage.getItem('activeTab') || 'items';
    let tableId = (activeTab === 'items') ? 'view-items' : 'view-debts';
    
    // 3. Loop through rows
    let table = document.getElementById(tableId);
    let tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) { // Start at 1 to skip header
        let tdName = tr[i].getElementsByTagName("td")[0]; // Column 1: Item/Desc
        let tdBorrower = tr[i].getElementsByTagName("td")[1]; // Column 2: Borrower
        
        if (tdName || tdBorrower) {
            let txtValue1 = tdName.textContent || tdName.innerText;
            let txtValue2 = tdBorrower.textContent || tdBorrower.innerText;
            
            if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }       
    }
}
    </script>

    
</body>
</html>
