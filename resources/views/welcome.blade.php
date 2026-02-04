<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Sekolah') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
(() => {
    const saved = localStorage.getItem('guest-theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (saved === 'dark' || (!saved && prefersDark)) {
        document.documentElement.classList.add('dark');
    }
})();
</script>

<style>
body {
    background: linear-gradient(135deg, #D1FAE5 0%, #6EE7B7 100%);
    overflow-x: hidden;
}
.floating-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.15;
    animation: float 10s ease-in-out infinite alternate;
}
@keyframes float {
    0% { transform: translateY(0px) translateX(0px) rotate(0deg);}
    100% { transform: translateY(-30px) translateX(20px) rotate(15deg);}
}
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 30px rgba(0,0,0,0.15);
}
.icon-container svg {
    width: 40px;
    height: 40px;
    color: #16a34a;
    transition: transform 0.3s, color 0.3s;
}
.icon-container:hover svg {
    transform: scale(1.3) rotate(10deg);
    color: #059669;
}
.cta-button {
    transition: all 0.3s ease;
}
.cta-button:hover {
    transform: translateY(-3px) scale(1.05);
    background-color: #059669;
}
.animate-fade-in {
    opacity: 0;
    animation: fadeIn 1s forwards;
}
@keyframes fadeIn { to { opacity: 1; } }
.animate-slide-up {
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.8s forwards;
}
@keyframes slideUp { to { opacity: 1; transform: translateY(0); } }
</style>
</head>
<body class="font-sans antialiased dark:bg-gray-900 dark:text-white transition-colors duration-500">

<div class="relative min-h-screen flex flex-col items-center justify-center px-4 py-16">

    <!-- Floating shapes -->
    <div class="floating-shape w-72 h-72 bg-green-300 top-10 left-10"></div>
    <div class="floating-shape w-56 h-56 bg-emerald-300 bottom-10 right-20"></div>
    <div class="floating-shape w-64 h-64 bg-lime-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>

    <!-- Header -->
    <div class="text-center mb-16 relative z-10">
        <h1 class="text-5xl sm:text-6xl font-extrabold text-green-800 dark:text-green-300 animate-fade-in">Peminjaman Alat & Fasilitas Sekolah</h1>
        <p class="mt-4 text-gray-700 dark:text-gray-300 text-lg sm:text-xl animate-fade-in">Kelola laboratorium, ruang kelas, dan fasilitas sekolah secara cepat, mudah, dan transparan.</p>
    </div>

    <!-- Feature Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16 w-full max-w-6xl relative z-10">
        <div class="card-hover bg-white/90 dark:bg-gray-900/70 rounded-3xl p-8 flex flex-col items-center text-center shadow-md transition transform animate-slide-up">
            <div class="icon-container mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8"></path><polyline points="7 10 12 15 17 10"></polyline></svg>
            </div>
            <h3 class="text-lg font-semibold text-green-700 dark:text-green-300">Alat Laboratorium</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Peminjaman alat laboratorium dengan catatan lengkap.</p>
        </div>

        <div class="card-hover bg-white/90 dark:bg-gray-900/70 rounded-3xl p-8 flex flex-col items-center text-center shadow-md transition transform animate-slide-up">
            <div class="icon-container mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" class="feather feather-book-open"><path d="M2 7h20M2 12h20M2 17h20"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-green-700 dark:text-green-300">Ruang Kelas</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Reservasi ruang kelas untuk kegiatan sekolah atau praktikum.</p>
        </div>

        <div class="card-hover bg-white/90 dark:bg-gray-900/70 rounded-3xl p-8 flex flex-col items-center text-center shadow-md transition transform animate-slide-up">
            <div class="icon-container mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-green-700 dark:text-green-300">Siswa & Guru</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Kelola peminjaman siswa dan guru dengan mudah.</p>
        </div>
    </div>

    <!-- Button menuju halaman login -->
    <a href="{{ route('login') }}" 
       class="cta-button px-10 py-4 bg-green-600 text-white rounded-full shadow-lg text-lg font-semibold hover:bg-green-700 transition relative z-10">
       Masuk / Login
    </a>

</div>

<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace();</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const fadeEls = document.querySelectorAll('.animate-fade-in');
    fadeEls.forEach((el, i) => {
        el.style.opacity = 0;
        setTimeout(() => { el.style.transition = 'opacity 1s ease-out'; el.style.opacity = 1; }, i * 300);
    });
    const slideEls = document.querySelectorAll('.animate-slide-up');
    slideEls.forEach((el, i) => {
        el.style.opacity = 0;
        el.style.transform = 'translateY(20px)';
        setTimeout(() => { el.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out'; el.style.opacity = 1; el.style.transform = 'translateY(0)'; }, 500 + i*200);
    });
});
</script>
</body>
</html>
