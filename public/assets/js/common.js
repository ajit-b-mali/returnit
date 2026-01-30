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
// On page load or when changing themes, best to add inline in the `head` to avoid FOUC
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark');
  // KEY CHANGE: Check the toggle if dark mode is active
  document.getElementById('theme-toggle').checked = true; 
} else {
  document.documentElement.classList.remove('dark');
  document.getElementById('theme-toggle').checked = false;
}

function toggleTheme() {
  const html = document.documentElement;
  const toggle = document.getElementById('theme-toggle');
  
  if (html.classList.contains('dark')) {
    html.classList.remove('dark');
    localStorage.setItem('theme', 'light');
    toggle.checked = false; // Sync UI
  } else {
    html.classList.add('dark');
    localStorage.setItem('theme', 'dark');
    toggle.checked = true; // Sync UI
  }
}