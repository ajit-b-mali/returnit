const password = document.getElementById('password');
const confirm = document.getElementById('confirm_password');
const submitBtn = document.getElementById('submitBtn');

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