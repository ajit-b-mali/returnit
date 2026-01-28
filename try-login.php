<?php
session_start();
require_once __DIR__ . '/config/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ReturnIt</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], display: ['Space Grotesk', 'sans-serif'] },
                    colors: { primary: '#4F46E5', secondary: '#10B981', dark: '#0F172A' },
                    animation: { 'float': 'float 6s ease-in-out infinite', 'blob': 'blob 7s infinite' },
                    keyframes: {
                        float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-20px)' } },
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
            <div class="flex-1 flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-12">
                
                <div class="mb-8 text-center lg:text-left">
                    <a href="index.php" class="inline-flex items-center gap-2 mb-8 group">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                            R
                        </div>
                        <span class="font-display font-bold text-xl text-slate-900">ReturnIt</span>
                    </a>

                    <h2 class="text-3xl font-display font-bold text-slate-900">Welcome back</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        New here? 
                        <a href="register.php" class="font-medium text-primary hover:text-indigo-500 transition-colors">Create an account</a>
                    </p>
                </div>

                <?php if(isset($_GET['registered'])): ?>
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-3 rounded-r-md flex items-center gap-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <p class="text-sm text-green-700 font-medium">Account created! Please log in.</p>
                </div>
                <?php endif; ?>

                <?php if($error): ?>
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-3 rounded-r-md flex items-center gap-3 animate-pulse">
                    <i class="fas fa-circle-exclamation text-red-500"></i>
                    <p class="text-sm text-red-700 font-medium"><?php echo htmlspecialchars($error); ?></p>
                </div>
                <?php endif; ?>

                <div class="mt-4">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-5">
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-slate-400"></i>
                                </div>
                                <input id="email" name="email" type="email" required 
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all outline-none" 
                                    placeholder="you@example.com">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required 
                                    class="block w-full pl-10 pr-10 py-3 border border-slate-300 rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all outline-none" 
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-slate-400 hover:text-slate-600" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-slate-300 rounded cursor-pointer">
                                <label for="remember-me" class="ml-2 block text-sm text-slate-900 cursor-pointer">Remember me</label>
                            </div>
                            <div class="text-sm">
                                <a href="#" class="font-medium text-slate-500 hover:text-primary transition-colors">Forgot password?</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" id="submitBtn" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-slate-900 hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:-translate-y-0.5">
                                <span id="btnText">Sign in</span>
                                <i id="btnSpinner" class="fas fa-circle-notch fa-spin ml-2 hidden"></i>
                            </button>
                        </div>
                    </form>

                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-slate-500">Or continue with</span>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <button class="w-full inline-flex justify-center py-2.5 px-4 border border-slate-200 rounded-xl shadow-sm bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors">
                                <i class="fab fa-google text-lg"></i>
                            </button>
                            <button class="w-full inline-flex justify-center py-2.5 px-4 border border-slate-200 rounded-xl shadow-sm bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors">
                                <i class="fab fa-github text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden lg:block flex-1 bg-slate-900 relative overflow-hidden">
            <div class="absolute top-0 -left-4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 -right-4 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center items-center px-12">
                <div class="glass-card p-8 rounded-2xl max-w-md w-full transform rotate-1 hover:rotate-0 transition-transform duration-500 shadow-2xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            JD
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Debt Settled!</h3>
                            <p class="text-indigo-200 text-sm">Just now</p>
                        </div>
                        <div class="ml-auto">
                            <span class="bg-green-500/20 text-green-300 text-xs font-bold px-2 py-1 rounded-full border border-green-500/30">+$45.00</span>
                        </div>
                    </div>
                    <div class="h-px bg-white/10 w-full mb-4"></div>
                    <p class="text-slate-300 italic text-lg leading-relaxed">
                        "Finally, a simple way to track who has my power tools. I stopped losing money on forgotten loans the first week I used ReturnIt."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const txt = document.getElementById('btnText');
            const spinner = document.getElementById('btnSpinner');
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            txt.innerText = 'Signing in...';
            spinner.classList.remove('hidden');
        });
    </script>
</body>
</html>