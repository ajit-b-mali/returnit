<footer class="bg-surface pt-16 pb-8 border-t border-border transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            
            <div class="flex items-center gap-2 mb-4 md:mb-0 group cursor-pointer" onclick="window.scrollTo(0,0)">
                <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded flex items-center justify-center text-white font-bold shadow-md shadow-primary/20 transition-transform group-hover:scale-105">
                    R
                </div>
                <span class="font-display font-bold text-xl text-main group-hover:text-primary transition-colors">
                    ReturnIt
                </span>
            </div>

            <div class="flex gap-6 text-muted">
                <a href="https://github.com/ajit-b-mali/returnit" target="_blank" class="hover:text-primary transition-colors duration-200">
                    <i class="fab fa-github text-xl"></i>
                </a>
                <a href="#" class="hover:text-blue-400 transition-colors duration-200">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
            </div>
        </div>

        <div class="border-t border-border pt-8 text-center text-muted text-sm">
            &copy; <?php echo date("Y"); ?> ReturnIt. Built with PHP & Tailwind.
        </div>
        
    </div>
</footer>