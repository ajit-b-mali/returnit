<header class="fixed w-full z-50 transition-all duration-300 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer group" onclick="window.scrollTo(0,0)">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30 transition-transform group-hover:scale-105">
                    R
                </div>
                <span class="font-display font-bold text-2xl tracking-tight text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                    ReturnIt
                </span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    Features
                </a>
                <a href="#how-it-works" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    How it Works
                </a>
                
                <div class="flex items-center gap-4 pl-6 border-l border-slate-200 dark:border-slate-700 ml-2">
                    
                    <?php require __DIR__ . '/themeToggle.php'; ?>

                    <a href="/login" class="text-sm font-semibold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        Log in
                    </a>
                    
                    <a href="/register" class="px-5 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-medium rounded-full hover:bg-indigo-600 dark:hover:bg-indigo-50 transition-all duration-300 shadow-lg shadow-slate-900/20 dark:shadow-none hover:-translate-y-0.5">
                        Get Started
                    </a>
                </div>
            </div>

            <div class="md:hidden flex items-center gap-4">

                <?php require __DIR__ . '/themeToggle.php'; ?>

                <button class="text-slate-600 dark:text-white hover:text-indigo-600 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>
</header>
