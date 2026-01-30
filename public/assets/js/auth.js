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

// Real-time password matching
function checkMatch() {
    const matchIcon = document.getElementById('matchIcon');
    const matchError = document.getElementById('matchError');
    
    if (confirm.value === '') {
        matchIcon.classList.add('hidden');
        matchError.classList.add('hidden');
        confirm.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
        return;
    }

    if (password.value === confirm.value) {
        // Match
        matchIcon.classList.remove('hidden');
        matchError.classList.add('hidden');
        confirm.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
        confirm.classList.add('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
    } else {
        // No Match
        matchIcon.classList.add('hidden');
        matchError.classList.remove('hidden');
        confirm.classList.remove('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
        confirm.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
    }
}
