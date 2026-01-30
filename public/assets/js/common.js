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

// Initialize Dark Mode from LocalStorage or System Preference
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
} else {
    document.documentElement.classList.remove('dark')
}

