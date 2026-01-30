<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "404 - ReturnIt";
require '../app/Views/components/head.php' ?>

<body class="bg-slate-50 h-screen flex flex-col items-center justify-center text-center p-4">
    
    <div class="text-9xl font-bold text-indigo-100 font-[Space_Grotesk]">404</div>
    
    <div class="absolute">
        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-2xl mx-auto mb-6 text-6xl">
            🤔
        </div>
        <h1 class="text-4xl font-bold text-slate-900 mb-2 font-[Space_Grotesk]">Lost something?</h1>
        <p class="text-slate-500 mb-8 text-lg">We tracked your items, but we couldn't track this page.</p>
        
        <a href="/" class="px-8 py-3 bg-indigo-600 text-white rounded-full font-bold shadow-lg hover:bg-indigo-700 transition hover:-translate-y-1 inline-block">
            Go Back Home
        </a>
    </div>

    <script src="/assets/js/common.js"></script>

</body>
</html>