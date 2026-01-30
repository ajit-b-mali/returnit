<?php
/**
 * Login Page
 * Handles user authentication and session creation.
 */

session_start();
require_once __DIR__ . '/../../config/db.php';

// --------------------------------------------------------------------------
// 1. Redirect if already logged in
// --------------------------------------------------------------------------
if (isset($_SESSION['user_id'])) {
    header("Location: /dashboard");
    exit;
}

$error = '';

// --------------------------------------------------------------------------
// 2. Handle Form Submission
// --------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Check database connection
        if (isset($pdo)) {
            // Fetch user by email
            $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            // Verify password
            if ($user && password_verify($password, $user['password_hash'])) {
                // Success: Set Session Variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Database connection error.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-full">

<?php
    $pageTitle = 'login - ReturnIt';
    require '../../app/Views/components/head.php'
?>

<body class="bg-white dark:bg-slate-900 transition-colors duration-200">

    <div class="flex min-h-screen">
        
        <!-- ======================================================================= -->
        <!-- LEFT COLUMN: Login Form -->
        <!-- ======================================================================= -->
        <div class="flex-1 flex flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 z-10 bg-white dark:bg-slate-900 relative transition-colors duration-200">
            
            <!-- Dark Mode Toggle (Absolute Top Right of Left Panel) -->
            <button onclick="toggleTheme()" class="absolute top-6 right-6 p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 transition-colors">
                <i class="fas fa-moon hidden dark:block"></i> <!-- Icon for when it is dark (to switch to light) -->
                <i class="fas fa-sun block dark:hidden"></i>   <!-- Icon for when it is light (to switch to dark) -->
            </button>

            <div class="mx-auto w-full max-w-sm lg:w-96">
                
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 mb-10 group">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        R
                    </div>
                    <span class="font-display font-bold text-xl text-slate-900 dark:text-white transition-colors">ReturnIt</span>
                </a>

                <!-- Header Text -->
                <div class="mb-8">
                    <h2 class="mt-6 text-3xl font-display font-bold text-slate-900 dark:text-white transition-colors">Welcome back</h2>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 transition-colors">
                        New here? 
                        <a href="/register" class="font-medium text-primary hover:text-indigo-500 transition-colors">Create an account</a>
                    </p>
                </div>

                <!-- Error Message (Dismissible) -->
                <?php if($error): ?>
                <div id="errorAlert" class="mb-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-r-md animate-pulse flex justify-between items-start">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-circle-exclamation text-red-500 dark:text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 dark:text-red-300 font-medium"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    </div>
                    <!-- Close Button -->
                    <button onclick="closeError()" class="text-red-400 hover:text-red-600 dark:hover:text-red-200 ml-2 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endif; ?>

                <!-- Registration Success Message -->
                <?php if(isset($_GET['registered']) && $_GET['registered'] == 'true'): ?>
                    <div class="mb-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 rounded-r-md">
                        <div class="flex">
                            <div class="flex-shrink-0"><i class="fas fa-check-circle text-green-500"></i></div>
                            <div class="ml-3"><p class="text-sm text-green-700 dark:text-green-300 font-medium">Account created! Please log in.</p></div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mt-8">
                    <!-- Login Form -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-6">
                        
                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email address</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-slate-400 dark:text-slate-500"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 dark:border-slate-700 rounded-xl leading-5 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all duration-200" 
                                    placeholder="you@example.com">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400 dark:text-slate-500"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="block w-full pl-10 pr-10 py-3 border border-slate-300 dark:border-slate-700 rounded-xl leading-5 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all duration-200" 
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-slate-300 dark:border-slate-600 rounded bg-white dark:bg-slate-700">
                                <label for="remember-me" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">Remember me</label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary transition-colors">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" id="submitBtn" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-slate-900 dark:bg-primary hover:bg-slate-800 dark:hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg">
                                <span id="btnText">Sign in</span>
                                <i id="btnSpinner" class="fas fa-circle-notch fa-spin ml-2 hidden"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-200 dark:border-slate-700"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 transition-colors">Or continue with</span>
                            </div>
                        </div>

                        <!-- Social Login -->
                        <div class="mt-6">
                            <!-- Google Button (Styled & Full Width) -->
                            <button class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm bg-white dark:bg-slate-800 text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-200 transform hover:scale-[1.01]">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5 mr-3" alt="Google Logo">
                                Sign in with Google
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================================================================= -->
        <!-- RIGHT COLUMN: Decorative Image (Hidden on Mobile) -->
        <!-- ======================================================================= -->
        <div class="hidden lg:block relative w-0 flex-1 bg-slate-900 overflow-hidden sticky top-0 h-screen">
            <!-- Background Gradient Blobs -->
            <div class="absolute top-0 -left-4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 -right-4 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            
            <!-- Glass Card Testimonial -->
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

            <!-- Dot Pattern SVG -->
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

    <script src="/assets/js/dark.js"></script>
</body>
</html>