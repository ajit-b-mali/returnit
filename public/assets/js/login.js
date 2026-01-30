// --------------------------------------------------------------------------
// Form Submission Loading State
// --------------------------------------------------------------------------
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    const txt = document.getElementById('btnText');
    const spinner = document.getElementById('btnSpinner');
    
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    txt.innerText = 'Signing in...';
    spinner.classList.remove('hidden');
});
