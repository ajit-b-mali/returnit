<?php
session_start();
require_once __DIR__ . '/config/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email OR username = :username");
        $stmt->execute(['email' => $email, 'username' => $username]);
        
        if ($stmt->rowCount() > 0) {
            $error = "Username or Email already taken.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute(['username' => $username, 'email' => $email, 'password_hash' => $password_hash])) {
                header("Location: login.php?registered=true");
                exit;
            } else {
                $error = "Something went wrong.";
            }
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], display: ['Space Grotesk', 'sans-serif'] },
                    colors: { primary: '#4F46E5', secondary: '#10B981', dark: '#0F172A' },
                    animation: { 'blob': 'blob 7s infinite' },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        /* Custom Scrollbar for Left Panel */
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-white lg:h-screen lg:overflow-hidden">

    <div class="flex flex-col lg:flex-row h-full">
        
        <div class="w-full lg:w-[450px] xl:w-[500px] flex flex-col bg-white h-full relative z-10 custom-scroll lg:overflow-y-auto">
            <div class="flex-1 flex flex-col justify-center px-6 py-8 sm:px-12 lg:px-12">
                
                <div class="mb-6 text-center lg:text-left">
                    <a href="index.php" class="inline-flex items-center gap-2 mb-6 group">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">R</div>
                        <span class="font-display font-bold text-xl text-slate-900">ReturnIt</span>
                    </a>
                    <h2 class="text-2xl font-display font-bold text-slate-900">Get Started</h2>
                    <p class="text-sm text-slate-600 mt-1">
                        Already have an account? <a href="login.php" class="font-medium text-primary hover:underline">Sign in</a>
                    </p>
                </div>

                <?php if($error): ?>
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-3 rounded-r-md flex items-center gap-3">
                    <i class="fas fa-circle-exclamation text-red-500 text-sm"></i>
                    <p class="text-sm text-red-700 font-medium"><?php echo htmlspecialchars($error); ?></p>
                </div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-3" id="regForm">
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Username</label>
                        <div class="relative">
                            <i class="fas fa-user text-slate-400 absolute left-3 top-3 text-xs"></i>
                            <input type="text" name="username" required class="block w-full pl-9 pr-3 py-2.5 border border-slate-300 rounded-lg bg-slate-50 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="johndoe">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope text-slate-400 absolute left-3 top-3 text-xs"></i>
                            <input type="email" name="email" required class="block w-full pl-9 pr-3 py-2.5 border border-slate-300 rounded-lg bg-slate-50 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Password</label>
                            <div class="relative">
                                <i class="fas fa-lock text-slate-400 absolute left-3 top-3 text-xs"></i>
                                <input type="password" name="password" id="password" required class="block w-full pl-9 pr-3 py-2.5 border border-slate-300 rounded-lg bg-slate-50 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="6+ chars">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Confirm</label>
                            <div class="relative">
                                <i class="fas fa-check-double text-slate-400 absolute left-3 top-3 text-xs"></i>
                                <input type="password" name="confirm_password" id="confirm_password" required class="block w-full pl-9 pr-3 py-2.5 border border-slate-300 rounded-lg bg-slate-50 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Re-enter">
                                <i class="fas fa-check-circle text-green-500 absolute right-3 top-3 text-xs hidden" id="matchIcon"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-red-500 hidden" id="matchError">Passwords do not match</p>

                    <div class="flex items-center pt-1">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-primary focus:ring-primary border-slate-300 rounded cursor-pointer">
                        <label for="terms" class="ml-2 block text-xs text-slate-600 cursor-pointer">
                            I agree to the <a href="#" class="text-primary hover:underline">Terms</a> & <a href="#" class="text-primary hover:underline">Privacy</a>
                        </label>
                    </div>

                    <button type="submit" id="submitBtn" class="w-full flex justify-center py-3 px-4 rounded-xl shadow-lg text-sm font-semibold text-white bg-slate-900 hover:bg-primary transition-all duration-300 transform hover:-translate-y-0.5 mt-2">
                        Create Account
                    </button>
                </form>

                <div class="mt-6 border-t border-slate-200 pt-4">
                    <div class="text-center text-xs text-slate-400 mb-3">Or register with</div>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="flex justify-center py-2 border border-slate-200 rounded-lg hover:bg-slate-50 transition"><i class="fab fa-google"></i></button>
                        <button class="flex justify-center py-2 border border-slate-200 rounded-lg hover:bg-slate-50 transition"><i class="fab fa-github"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden lg:block flex-1 bg-slate-900 relative overflow-hidden">
            <div class="absolute top-0 -left-4 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 -right-4 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center items-center px-12">
                <div class="glass-card p-8 rounded-2xl max-w-md w-full border-l-4 border-l-secondary shadow-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-xl bg-secondary/20 flex items-center justify-center text-secondary font-bold text-xl">
                                <i class="fas fa-tent"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">Camping Gear</h3>
                                <p class="text-slate-300 text-sm">Lent to Alex</p>
                            </div>
                        </div>
                        <span class="bg-blue-500/20 text-blue-300 text-xs font-bold px-3 py-1 rounded-full border border-blue-500/30">Active</span>
                    </div>
                    
                    <div class="relative pt-2">
                        <div class="flex text-xs text-slate-400 justify-between mb-2">
                            <span>Borrowed: Mon</span>
                            <span>Due: Friday</span>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-slate-700">
                            <div style="width: 60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-secondary"></div>
                        </div>
                    </div>
                    <div class="h-px bg-white/10 w-full mb-4"></div>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        "Never lose track of your stuff again. Keep a log of everything that leaves your house."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const confirm = document.getElementById('confirm_password');
        const matchIcon = document.getElementById('matchIcon');
        const matchError = document.getElementById('matchError');
        const submitBtn = document.getElementById('submitBtn');

        function checkMatch() {
            if (confirm.value === '') {
                matchIcon.classList.add('hidden');
                matchError.classList.add('hidden');
                confirm.classList.remove('border-red-500', 'focus:ring-red-500');
                return;
            }
            if (password.value === confirm.value) {
                matchIcon.classList.remove('hidden');
                matchError.classList.add('hidden');
                confirm.classList.remove('border-red-500', 'focus:ring-red-500');
                confirm.classList.add('border-green-500', 'focus:ring-green-500');
            } else {
                matchIcon.classList.add('hidden');
                matchError.classList.remove('hidden');
                confirm.classList.remove('border-green-500', 'focus:ring-green-500');
                confirm.classList.add('border-red-500', 'focus:ring-red-500');
            }
        }

        password.addEventListener('input', checkMatch);
        confirm.addEventListener('input', checkMatch);

        document.getElementById('regForm').addEventListener('submit', function(e) {
            if(password.value !== confirm.value) {
                e.preventDefault();
                alert("Passwords do not match!");
            } else {
                submitBtn.innerText = 'Creating Account...';
                submitBtn.classList.add('opacity-75');
            }
        });
    </script>
</body>
</html>