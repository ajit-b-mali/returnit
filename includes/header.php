<?php
// Ensure session is started only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the current page name for active link styling
$current_page = basename($_SERVER['PHP_SELF']);
$is_logged_in = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReturnIt - Personal Lending Manager</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4F46E5', // Indigo 600
                        secondary: '#10B981', // Emerald 500
                        dark: '#0F172A', // Slate 900
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Global Custom Styles */
        body { font-family: 'Inter', sans-serif; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        /* Dropdown Menu Animation */
        .dropdown-menu {
            transform-origin: top right;
            transition: all 0.2s ease-out;
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }
        .dropdown-menu.active {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <nav class="fixed top-0 w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <a href="<?php echo $is_logged_in ? 'dashboard.php' : 'index.php'; ?>" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md group-hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                        R
                    </div>
                    <span class="font-display font-bold text-xl text-slate-900 tracking-tight">ReturnIt</span>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <?php if (!$is_logged_in): ?>
                        <a href="index.php#features" class="text-sm font-medium text-slate-500 hover:text-primary transition-colors">Features</a>
                        <a href="login.php" class="text-sm font-medium text-slate-900 hover:text-primary transition-colors">Log in</a>
                        <a href="register.php" class="px-4 py-2 bg-slate-900 text-white text-sm font-semibold rounded-full hover:bg-primary transition-all shadow-lg hover:shadow-primary/30 transform hover:-translate-y-0.5">
                            Get Started
                        </a>
                    <?php else: ?>
                        <a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'text-primary' : 'text-slate-500'; ?> text-sm font-medium hover:text-primary transition-colors">
                            Dashboard
                        </a>
                        
                        <!-- <button class="relative p-2 text-slate-400 hover:text-indigo-600 transition-colors duration-200">
    <i class="fas fa-bell text-xl"></i>
    
    <span class="absolute top-1 right-1 flex h-3 w-3">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
    </span>
</button> -->

<!-- <div class="relative ml-3">
    
    <button onclick="toggleNotifications()" class="relative p-2 text-slate-400 hover:text-indigo-600 focus:outline-none transition-colors">
        <i class="fas fa-bell text-xl"></i>
        <div class="absolute top-0 right-0 -mt-1 -mr-1 px-1.5 py-0.5 bg-red-500 border-2 border-white rounded-full text-xs font-bold text-white flex items-center justify-center min-w-[1.25rem]">
            3
        </div>
    </button>

    <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-slate-100 z-50 overflow-hidden origin-top-right transition-all">
        
        <div class="px-4 py-3 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-sm text-slate-800">Notifications</h3>
            <span class="text-xs text-indigo-600 font-medium cursor-pointer">Mark all read</span>
        </div>

        <div class="max-h-64 overflow-y-auto">
            <a href="#" class="block px-4 py-3 hover:bg-slate-50 border-b border-slate-50 transition-colors">
                <p class="text-sm text-slate-800 font-medium"><span class="text-indigo-600">Sarah</span> returned your book.</p>
                <p class="text-xs text-slate-400 mt-1">2 hours ago</p>
            </a>
            <a href="#" class="block px-4 py-3 hover:bg-slate-50 border-b border-slate-50 transition-colors">
                <p class="text-sm text-slate-800 font-medium">Debt Reminder sent to <span class="text-indigo-600">Mike</span>.</p>
                <p class="text-xs text-slate-400 mt-1">Yesterday</p>
            </a>
            <a href="#" class="block px-4 py-3 hover:bg-slate-50 transition-colors">
                <p class="text-sm text-slate-800 font-medium">Welcome to ReturnIt!</p>
                <p class="text-xs text-slate-400 mt-1">2 days ago</p>
            </a>
        </div>
        
        <a href="#" class="block bg-slate-50 px-4 py-2 text-center text-xs text-slate-500 hover:text-indigo-600 font-medium border-t border-slate-100">
            View All
        </a>
    </div>
</div>

<script>
    function toggleNotifications() {
        const dropdown = document.getElementById('notificationDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close when clicking outside
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('notificationDropdown');
        const button = document.querySelector('button[onclick="toggleNotifications()"]');
        
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script> -->

<?php 
// Example variable - replace with real DB count
$notification_count = 0; 
?>

<button class="relative text-slate-400 hover:text-primary">
    <i class="fas fa-bell text-xl"></i>
    
    <?php if ($notification_count > 0): ?>
        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 ring-2 ring-white text-[10px] font-bold text-white">
            <?php echo $notification_count; ?>
        </span>
    <?php endif; ?>
</button>

                        <div class="relative ml-2">
                            <button onclick="toggleDropdown()" class="flex items-center gap-2 focus:outline-none">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white flex items-center justify-center text-sm font-bold shadow-md border-2 border-white">
                                    <?php echo strtoupper(substr($username, 0, 1)); ?>
                                </div>
                                <span class="text-sm font-medium text-slate-700 max-w-[100px] truncate"><?php echo htmlspecialchars($username); ?></span>
                                <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                            </button>

                            <div id="userDropdown" class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1 z-50">
                                <div class="px-4 py-2 border-b border-slate-50">
                                    <p class="text-xs text-slate-500">Signed in as</p>
                                    <p class="text-sm font-bold text-slate-900 truncate"><?php echo htmlspecialchars($username); ?></p>
                                </div>
                                <a href="dashboard.php" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                                    <i class="fas fa-columns w-5 text-slate-400"></i> Dashboard
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                                    <i class="fas fa-cog w-5 text-slate-400"></i> Settings
                                </a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fas fa-sign-out-alt w-5"></i> Log out
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="md:hidden flex items-center">
                    <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="text-slate-600 hover:text-primary focus:outline-none p-2">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-slate-100 absolute w-full shadow-lg">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <?php if (!$is_logged_in): ?>
                    <a href="login.php" class="block px-3 py-3 text-base font-medium text-slate-600 hover:text-primary hover:bg-slate-50 rounded-lg">Log in</a>
                    <a href="register.php" class="block px-3 py-3 text-base font-medium text-primary hover:bg-indigo-50 rounded-lg">Create Account</a>
                <?php else: ?>
                    <div class="px-3 py-3 border-b border-slate-100 mb-2">
                        <p class="text-sm text-slate-500">Welcome,</p>
                        <p class="font-bold text-slate-900"><?php echo htmlspecialchars($username); ?></p>
                    </div>
                    <a href="dashboard.php" class="block px-3 py-2 text-base font-medium text-slate-700 hover:text-primary hover:bg-slate-50 rounded-lg">Dashboard</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-slate-700 hover:text-primary hover:bg-slate-50 rounded-lg">Settings</a>
                    <a href="logout.php" class="block px-3 py-2 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg">Log out</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <div class="h-16"></div>

    <script>
        // Toggle User Dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.closest('.relative') && !event.target.closest('#userDropdown')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown && dropdown.classList.contains('active')) {
                    dropdown.classList.remove('active');
                }
            }
        }
    </script>