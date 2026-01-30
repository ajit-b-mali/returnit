<label class="relative inline-flex items-center cursor-pointer group scale-75">
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