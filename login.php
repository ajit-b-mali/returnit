<!-- <?php

// require __DIR__ . '/../config/session.php';
// require __DIR__ . '/../config/db.php';

// $error = '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $email = trim($_POST['email']);
//     $password = $_POST['password'];

//     $stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = ?");
//     $stmt->execute([$email]);

//     $user = $stmt->fetch();

//     if ($user && password_verify($password, $user['password'])) {
//         session_regenerate_id(true);
//         $_SESSION['user_id'] = $user['id'];

//         header('Location: /');
//         exit;
//     }

//     $error = "Invalid email or password";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ReturnIt</title>
</head>
<body>
    <h2>Login</h2>
    

    <form method="post">
        <input type="email" name="email" id="email">
        <br><br>
        <input type="password" name="password" id="password">
        <br><br>
        <button type="submit">Login</button>
    </form>

</body>
</html> -->

<?php
session_start();
require_once __DIR__ . '/../config/db.php'; // Assuming you have this file for DB connection

// 1. Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

// 2. Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Prepare Statement
        $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Success: Set Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Optional: 'Remember Me' logic would go here (setting a cookie)
            
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
                        'float': 'float 6s ease-in-out infinite',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
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
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-white h-screen overflow-hidden">

    <div class="flex min-h-full">
        
        <div class="flex-1 flex flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 z-10 bg-white relative">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                
                <a href="index.php" class="flex items-center gap-2 mb-10 group">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        R
                    </div>
                    <span class="font-display font-bold text-xl text-slate-900">ReturnIt</span>
                </a>

                <div class="mb-8">
                    <h2 class="mt-6 text-3xl font-display font-bold text-slate-900">Welcome back</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        New here? 
                        <a href="register.php" class="font-medium text-primary hover:text-indigo-500 transition-colors">Create an account</a>
                    </p>
                </div>

                <?php if($error): ?>
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md animate-pulse">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-circle-exclamation text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-medium"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(isset($_GET['registered']) && $_GET['registered'] == 'true'): ?>
                    <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-md">
                        <div class="flex">
                            <div class="flex-shrink-0"><i class="fas fa-check-circle text-green-500"></i></div>
                            <div class="ml-3"><p class="text-sm text-green-700 font-medium">Account created! Please log in.</p></div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mt-8">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-6">
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-slate-400"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all duration-200" 
                                    placeholder="you@example.com">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="block w-full pl-10 pr-10 py-3 border border-slate-300 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all duration-200" 
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-slate-400 hover:text-slate-600" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-slate-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-slate-900">Remember me</label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-slate-500 hover:text-primary transition-colors">Forgot password?</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" id="submitBtn" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-slate-900 hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg">
                                <span id="btnText">Sign in</span>
                                <i id="btnSpinner" class="fas fa-circle-notch fa-spin ml-2 hidden"></i>
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
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

        <div class="hidden lg:block relative w-0 flex-1 bg-slate-900 overflow-hidden">
            <div class="absolute top-0 -left-4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 -right-4 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center items-center z-10 px-12">
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
                    <div class="mt-4 flex items-center gap-2">
                        <div class="flex text-yellow-400 text-sm">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-sm text-slate-400 font-medium">Verified User</span>
                    </div>
                </div>
            </div>

            <svg class="absolute bottom-0 right-0 h-full w-auto opacity-5 transform translate-x-1/3" viewBox="0 0 404 384" fill="none" aria-hidden="true">
                <defs>
                    <pattern id="de316486-4a29-4312-bdfc-fbce2132a2c1" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-white" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#de316486-4a29-4312-bdfc-fbce2132a2c1)" />
            </svg>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
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

        // Add loading state to button on submit
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