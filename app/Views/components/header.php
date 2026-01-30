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
                    
                    <label class="relative inline-flex items-center cursor-pointer group scale-75 md:scale-90">
                        <input type="checkbox" id="theme-toggle" class="sr-only peer" onclick="toggleTheme()">
                        
                        <div class="w-16 h-8 bg-sky-400 peer-checked:bg-slate-800 rounded-full transition-colors duration-500 ease-in-out shadow-inner relative overflow-hidden ring-2 ring-transparent peer-focus:ring-indigo-500">
                            
                            <div class="absolute inset-0 z-0 transition-transform duration-500 peer-checked:translate-y-10">
                                <i class="fas fa-cloud text-white absolute top-1 left-2 text-[8px] opacity-80"></i>
                                <i class="fas fa-cloud text-white absolute top-4 left-5 text-[6px] opacity-60"></i>
                                <i class="fas fa-cloud text-white absolute top-2 right-8 text-[7px] opacity-70"></i>
                            </div>

                            <div class="absolute inset-0 z-0 transition-transform duration-500 -translate-y-10 peer-checked:translate-y-0">
                                <i class="fas fa-star text-yellow-100 absolute top-2 left-2 text-[4px] animate-pulse"></i>
                                <i class="fas fa-star text-white absolute top-5 left-5 text-[3px] opacity-50"></i>
                                <i class="fas fa-star text-white absolute top-2 right-8 text-[4px] opacity-80"></i>
                                <i class="fas fa-star text-blue-200 absolute top-4 right-3 text-[3px] animate-pulse delay-75"></i>
                            </div>

                        </div>

                        <div class="absolute left-1 top-1 bg-yellow-300 w-6 h-6 rounded-full shadow-md transform transition-all duration-500 ease-[cubic-bezier(0.68,-0.55,0.27,1.55)] peer-checked:translate-x-8 peer-checked:bg-slate-200 z-10 flex items-center justify-center overflow-hidden">
                            
                            <div class="absolute w-full h-full opacity-0 peer-checked:opacity-100 transition-opacity duration-300">
                                <div class="absolute top-1 right-2 w-1.5 h-1.5 bg-slate-300 rounded-full"></div>
                                <div class="absolute bottom-2 left-1.5 w-1 h-1 bg-slate-300 rounded-full"></div>
                                <div class="absolute top-3 left-3 w-1 h-1 bg-slate-300 rounded-full"></div>
                            </div>

                        </div>
                    </label>

                    <a href="/login" class="text-sm font-semibold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        Log in
                    </a>
                    
                    <a href="/register" class="px-5 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-medium rounded-full hover:bg-indigo-600 dark:hover:bg-indigo-50 transition-all duration-300 shadow-lg shadow-slate-900/20 dark:shadow-none hover:-translate-y-0.5">
                        Get Started
                    </a>
                </div>
            </div>

            <div class="md:hidden flex items-center gap-4">
                <label class="relative inline-flex items-center cursor-pointer group scale-75 md:scale-90">
                    <input type="checkbox" id="theme-toggle" class="sr-only peer" onclick="toggleTheme()">
                    
                    <div class="w-16 h-8 bg-sky-400 peer-checked:bg-slate-800 rounded-full transition-colors duration-500 ease-in-out shadow-inner relative overflow-hidden ring-2 ring-transparent peer-focus:ring-indigo-500">
                        
                        <div class="absolute inset-0 z-0 transition-transform duration-500 peer-checked:translate-y-10">
                            <i class="fas fa-cloud text-white absolute top-1 left-2 text-[8px] opacity-80"></i>
                            <i class="fas fa-cloud text-white absolute top-4 left-5 text-[6px] opacity-60"></i>
                            <i class="fas fa-cloud text-white absolute top-2 right-8 text-[7px] opacity-70"></i>
                        </div>

                        <div class="absolute inset-0 z-0 transition-transform duration-500 -translate-y-10 peer-checked:translate-y-0">
                            <i class="fas fa-star text-yellow-100 absolute top-2 left-2 text-[4px] animate-pulse"></i>
                            <i class="fas fa-star text-white absolute top-5 left-5 text-[3px] opacity-50"></i>
                            <i class="fas fa-star text-white absolute top-2 right-8 text-[4px] opacity-80"></i>
                            <i class="fas fa-star text-blue-200 absolute top-4 right-3 text-[3px] animate-pulse delay-75"></i>
                        </div>

                    </div>

                    <div class="absolute left-1 top-1 bg-yellow-300 w-6 h-6 rounded-full shadow-md transform transition-all duration-500 ease-[cubic-bezier(0.68,-0.55,0.27,1.55)] peer-checked:translate-x-8 peer-checked:bg-slate-200 z-10 flex items-center justify-center overflow-hidden">
                        
                        <div class="absolute w-full h-full opacity-0 peer-checked:opacity-100 transition-opacity duration-300">
                            <div class="absolute top-1 right-2 w-1.5 h-1.5 bg-slate-300 rounded-full"></div>
                            <div class="absolute bottom-2 left-1.5 w-1 h-1 bg-slate-300 rounded-full"></div>
                            <div class="absolute top-3 left-3 w-1 h-1 bg-slate-300 rounded-full"></div>
                        </div>

                    </div>
                </label>

                <button class="text-slate-600 dark:text-white hover:text-indigo-600 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>
</header>
