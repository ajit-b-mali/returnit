const password = document.getElementById('password');
const confirm = document.getElementById('confirm_password');
const matchIcon = document.getElementById('matchIcon');
const matchError = document.getElementById('matchError');
const submitBtn = document.getElementById('submitBtn');

// Real-time password matching
function checkMatch() {
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

password.addEventListener('input', checkMatch);
confirm.addEventListener('input', checkMatch);

// Prevent submit if passwords don't match
document.getElementById('regForm').addEventListener('submit', function(e) {
    if(password.value !== confirm.value) {
        e.preventDefault();
        alert("Passwords do not match!");
    } else {
        submitBtn.innerText = 'Creating Account...';
        submitBtn.classList.add('opacity-75');
    }
});