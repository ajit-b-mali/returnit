<?php
    session_start();
    require_once __DIR__ . '/../../config/db.php';

    // 1. Redirect if already logged in
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit;
    }

    $error = '';
    $success = '';

    // 2. Handle Form Submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize inputs
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Basic Validation
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $error = "All fields are required.";
        } elseif ($password !== $confirm_password) {
            $error = "Passwords do not match.";
        } elseif (strlen($password) < 6) {
            $error = "Password must be at least 6 characters.";
        } else {
            // Check if email or username already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email OR username = :username");
            $stmt->execute(['email' => $email, 'username' => $username]);
            
            if ($stmt->rowCount() > 0) {
                $error = "Username or Email already taken.";
            } else {
                // Hash Password
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                // Insert User
                $sql = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute(['username' => $username, 'email' => $email, 'password_hash' => $password_hash])) {
                    // Redirect to login with success message
                    header("Location: /login?registered=true");
                    exit;
                } else {
                    $error = "Something went wrong. Please try again.";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php
    $pageTitle = 'Register - ReturnIt';
    require '../../app/Views/components/head.php'
?>

<body class="bg-white h-screen overflow-hidden">

    <div class="flex min-h-full">

        <!-- ======================================================================= -->
        <!-- LEFT COLUMN: Registration Form -->
        <!-- ======================================================================= -->
        <div class="flex-1 flex flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 z-10 bg-white h-full overflow-y-auto no-scrollbar">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                
                <a href="/" class="flex items-center gap-2 mb-8 group">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        R
                    </div>
                    <span class="font-display font-bold text-xl text-slate-900">ReturnIt</span>
                </a>

                <div>
                    <h2 class="mt-2 text-3xl font-display font-bold text-slate-900">Create Account</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Already have an account? 
                        <a href="/login" class="font-medium text-primary hover:text-indigo-500 transition-colors">Sign in here</a>
                    </p>
                </div>

                <?php if($error): ?>
                <div class="mt-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md animate-pulse">
                    <div class="flex">
                        <div class="flex-shrink-0"><i class="fas fa-circle-exclamation text-red-500"></i></div>
                        <div class="ml-3"><p class="text-sm text-red-700 font-medium"><?php echo htmlspecialchars($error); ?></p></div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mt-8">
                    <form action="/register" method="POST" class="space-y-5" id="regForm">
                        
                        <div>
                            <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-slate-400"></i>
                                </div>
                                <input type="text" name="username" id="username" required 
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all" 
                                    placeholder="johndoe">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-slate-400"></i>
                                </div>
                                <input type="email" name="email" id="email" required 
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all" 
                                    placeholder="you@example.com">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400"></i>
                                </div>
                                <input type="password" name="password" id="password" required 
                                    class="block w-full pl-10 pr-10 py-3 border border-slate-300 rounded-xl bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all" 
                                    placeholder="Min 6 characters">
                            </div>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-check-double text-slate-400"></i>
                                </div>
                                <input type="password" name="confirm_password" id="confirm_password" required 
                                    class="block w-full pl-10 pr-10 py-3 border border-slate-300 rounded-xl bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all" 
                                    placeholder="Re-enter password">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none hidden" id="matchIcon">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-red-500 hidden" id="matchError">Passwords do not match</p>
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-primary focus:ring-primary border-slate-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-slate-900">
                                I agree to the <a href="#" class="text-primary hover:underline">Terms</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit" id="submitBtn" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-slate-900 hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:-translate-y-0.5">
                                Start Tracking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ======================================================================= -->
        <!-- RIGHT COLUMN: Decorative Image (Hidden on Mobile) -->
        <!-- ======================================================================= -->
        <div class="hidden lg:block relative w-0 flex-1 bg-slate-900 overflow-hidden">
            <div class="absolute top-0 -left-4 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 -right-4 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center items-center z-10 px-12">
                
                <div class="glass-card p-8 rounded-2xl max-w-md w-full transform -rotate-1 hover:rotate-0 transition-transform duration-500 shadow-2xl border-l-4 border-l-secondary">
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
                        <span class="bg-blue-500/20 text-blue-300 text-xs font-bold px-3 py-1 rounded-full border border-blue-500/30">
                            Active
                        </span>
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
                        <i class="fas fa-quote-left text-slate-500 mr-2"></i>
                        Never lose track of your stuff again. From books to expensive electronics, keep a log of everything that leaves your house.
                    </p>
                </div>
            </div>

            <svg class="absolute top-0 left-0 h-full w-auto opacity-5 transform -translate-x-1/2" viewBox="0 0 404 384" fill="none" aria-hidden="true">
                <defs>
                    <pattern id="dot-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1" class="text-white" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#dot-pattern)" />
            </svg>
        </div>
    </div>

    <script src="/assets/js/register.js"></script>
</body>
</html>