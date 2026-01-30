// Initialize Dark Mode from LocalStorage or System Preference
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
} else {
    document.documentElement.classList.remove('dark')
}

// --------------------------------------------------------------------------
// Dark Mode Toggle Logic
// --------------------------------------------------------------------------
function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
    } else {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
    }
}

// --------------------------------------------------------------------------
// Password Visibility Toggle
// --------------------------------------------------------------------------
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

// --------------------------------------------------------------------------
// Close Error Alert
// --------------------------------------------------------------------------
function closeError() {
    const alert = document.getElementById('errorAlert');
    if(alert) {
        alert.style.display = 'none';
    }
}

// --------------------------------------------------------------------------
// Form Submission Loading State
// --------------------------------------------------------------------------
document.querySelector('form').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    const txt = document.getElementById('btnText');
    const spinner = document.getElementById('btnSpinner');
    
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    txt.innerText = 'Signing in...';
    spinner.classList.remove('hidden');
});