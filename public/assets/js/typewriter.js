const words = ["Lent Items.", "Owed Money.", "Borrowed Tools.", "Shared Expenses."];
let i = 0;
let timer;

function typeWriter() {
    const element = document.getElementById("typewriter");
    const word = words[i];
    const current = element.innerText;

    if (current.length < word.length) {
        element.innerText = word.substring(0, current.length + 1);
        timer = setTimeout(typeWriter, 100);
    } else {
        setTimeout(deleteWriter, 2000);
    }
}

function deleteWriter() {
    const element = document.getElementById("typewriter");
    const current = element.innerText;

    if (current.length > 0) {
        element.innerText = current.substring(0, current.length - 1);
        timer = setTimeout(deleteWriter, 50);
    } else {
        i = (i + 1) % words.length;
        setTimeout(typeWriter, 200);
    }
}

// Start the effect
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(typeWriter, 1000);
});
