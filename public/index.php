<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<?php require '../app/Views/components/head.php'; ?>

<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden">
    <?php require '../app/Views/components/header.php'; ?>

    <main>
        <section id="hero" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-primary text-sm font-semibold mb-6 border border-blue-100">
                            <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                            </span>
                            v1.0 is Live
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-display font-bold text-slate-900 leading-tight mb-6">
                            Track your <br>
                            <span id="typewriter" class="text-gradient"></span><span class="cursor-blink text-primary">|</span>
                        </h1>
                        <p class="text-xl text-slate-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            Stop wondering "Who has my lawnmower?" or "Did John pay me back?". ReturnIt is the secure, minimalist dashboard for your personal lending.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="register.php" class="px-8 py-4 bg-slate-900 text-white rounded-xl font-semibold hover:bg-primary transition-all duration-300 shadow-xl hover:shadow-primary/25 transform hover:-translate-y-1 text-center">
                                Create Free Account
                            </a>
                            <a href="#features" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-xl font-semibold hover:bg-slate-50 transition-all duration-300 hover:border-slate-300 text-center">
                                Learn More
                            </a>
                        </div>
                        
                        <div class="mt-10 flex items-center justify-center lg:justify-start gap-4 text-sm text-slate-500 font-medium">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-check-circle text-emerald-500"></i> No credit card
                            </div>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-check-circle text-emerald-500"></i> Secure Encryption
                            </div>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-check-circle text-emerald-500"></i> Open Source
                            </div>
                        </div>
                    </div>

                    <div class="relative lg:h-[500px] flex items-center justify-center">
                        <div class="relative w-full max-w-md animate-float">
                            <div class="glass-card absolute top-0 right-0 p-6 rounded-2xl shadow-2xl z-20 w-64 transform rotate-3 transition hover:rotate-0">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                    <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded">Owed</span>
                                </div>
                                <h3 class="text-slate-500 text-sm">Pizza Night</h3>
                                <p class="text-2xl font-bold text-slate-900">$45.00</p>
                                <div class="mt-4 flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-xs">JD</div>
                                </div>
                            </div>

                            <div class="glass-card absolute top-24 left-0 p-6 rounded-2xl shadow-2xl z-30 w-64 bg-white transform -rotate-3 transition hover:rotate-0">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <span class="text-xs font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded">Lent</span>
                                </div>
                                <h3 class="text-slate-500 text-sm">Power Drill</h3>
                                <p class="text-lg font-bold text-slate-900">With Sarah</p>
                                <div class="mt-4 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: 70%"></div>
                                </div>
                                <p class="text-xs text-slate-400 mt-2">Due in 2 days</p>
                            </div>

                            <div class="glass-card absolute bottom-[-50px] left-16 p-4 rounded-2xl shadow-2xl z-10 w-72 opacity-90 scale-90">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                    <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                                    <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-8 bg-slate-100 rounded w-full"></div>
                                    <div class="h-8 bg-slate-100 rounded w-3/4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-base text-primary font-semibold tracking-wide uppercase mb-2">Features</h2>
                    <p class="text-3xl sm:text-4xl font-display font-bold text-slate-900 mb-4">
                        Everything you need to settle up.
                    </p>
                    <p class="text-slate-600 text-lg">
                        Clean, simple, and effective. We stripped away the complexity so you can focus on getting your stuff back.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="group p-8 rounded-2xl bg-slate-50 hover:bg-white border border-slate-100 hover:border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-indigo-100 text-primary rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-hand-holding-dollar"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Debt Tracking</h3>
                        <p class="text-slate-600">
                            Remember who owes you lunch money or who paid for the concert tickets. Mark debts as paid with one click.
                        </p>
                    </div>

                    <div class="group p-8 rounded-2xl bg-slate-50 hover:bg-white border border-slate-100 hover:border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-dolly"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Item Inventory</h3>
                        <p class="text-slate-600">
                            Lent a book? A tool? A hoodie? Log it instantly. View your entire lending history in a clean table view.
                        </p>
                    </div>

                    <div class="group p-8 rounded-2xl bg-slate-50 hover:bg-white border border-slate-100 hover:border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Secure Sessions</h3>
                        <p class="text-slate-600">
                            Built with robust PHP sessions and password hashing. Your data is private, isolated, and safe.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="py-24 bg-slate-900 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-primary opacity-10 rounded-full blur-3xl"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-display font-bold mb-6">Start organizing in seconds</h2>
                        <p class="text-slate-400 text-lg mb-12">
                            No complex setup. No bank connections required. Just a simple digital ledger for your life.
                        </p>
                        
                        <div class="space-y-8">
                            <div class="flex gap-4 group">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-primary text-primary flex items-center justify-center font-bold group-hover:bg-primary group-hover:text-white transition-colors">1</div>
                                <div>
                                    <h4 class="text-xl font-bold mb-2">Create an Account</h4>
                                    <p class="text-slate-400">Sign up securely using just a username and password.</p>
                                </div>
                            </div>
                            <div class="flex gap-4 group">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-secondary text-secondary flex items-center justify-center font-bold group-hover:bg-secondary group-hover:text-white transition-colors">2</div>
                                <div>
                                    <h4 class="text-xl font-bold mb-2">Log a Transaction</h4>
                                    <p class="text-slate-400">Click "Add Item" or "Add Debt" and fill in the details.</p>
                                </div>
                            </div>
                            <div class="flex gap-4 group">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-blue-400 text-blue-400 flex items-center justify-center font-bold group-hover:bg-blue-400 group-hover:text-white transition-colors">3</div>
                                <div>
                                    <h4 class="text-xl font-bold mb-2">Mark as Returned</h4>
                                    <p class="text-slate-400">When you get it back, hit the checkbox. It's that easy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-slate-800 rounded-2xl p-2 border border-slate-700 shadow-2xl transform rotate-1 hover:rotate-0 transition-transform duration-500">
                        <div class="bg-slate-900 rounded-xl overflow-hidden">
                            <div class="bg-slate-800 px-4 py-3 flex items-center gap-2 border-b border-slate-700">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <div class="ml-4 bg-slate-900 text-xs text-slate-400 px-3 py-1 rounded-full flex-1 text-center font-mono">
                                    localhost:8000/dashboard
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-end mb-6">
                                    <div>
                                        <div class="text-xs text-slate-400 uppercase tracking-wider">Total Owed To You</div>
                                        <div class="text-3xl font-bold text-white">$1,250.00</div>
                                    </div>
                                    <button class="bg-primary text-white text-xs px-3 py-1.5 rounded-lg">New Debt</button>
                                </div>
                                <div class="space-y-3">
                                    <div class="bg-slate-800/50 p-3 rounded-lg flex justify-between items-center border border-slate-700">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-gamepad"></i></div>
                                            <div>
                                                <div class="text-sm font-medium text-white">PS5 Controller</div>
                                                <div class="text-xs text-slate-500">Lent to Mike</div>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-yellow-500/10 text-yellow-500 px-2 py-1 rounded">Pending</span>
                                    </div>
                                    <div class="bg-slate-800/50 p-3 rounded-lg flex justify-between items-center border border-slate-700">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded bg-secondary/20 text-secondary flex items-center justify-center"><i class="fas fa-dollar-sign"></i></div>
                                            <div>
                                                <div class="text-sm font-medium text-white">Dinner Bill</div>
                                                <div class="text-xs text-slate-500">Owed by Sarah</div>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-secondary/10 text-secondary px-2 py-1 rounded">Paid</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require '../app/Views/components/footer.php'; ?>

    <script src="/assets/js/typewriter.js"></script>

</body>
</html>