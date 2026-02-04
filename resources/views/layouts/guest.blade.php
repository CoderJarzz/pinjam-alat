<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Font -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Vite -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Auto Dark Mode -->
<script>
(() => {
    const saved = localStorage.getItem('guest-theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (saved === 'dark' || (!saved && prefersDark)) {
        document.documentElement.classList.add('dark');
    }
})();
</script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-emerald-50 via-green-100 to-emerald-200 dark:from-gray-900 dark:via-gray-950 dark:to-gray-900 transition-colors duration-500 overflow-x-hidden">

<!-- Floating Shapes -->
<div class="absolute w-80 h-80 bg-emerald-300 rounded-full top-12 left-12 opacity-20 animate-float"></div>
<div class="absolute w-64 h-64 bg-lime-300 rounded-full bottom-16 right-16 opacity-20 animate-float animation-delay-2000"></div>
<div class="absolute w-96 h-96 bg-green-200 rounded-full top-1/2 left-1/2 opacity-15 transform -translate-x-1/2 -translate-y-1/2 animate-float animation-delay-1000"></div>

<div class="relative z-10 flex min-h-screen items-center justify-center px-4 py-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-7xl grid lg:grid-cols-[1.5fr,1fr] gap-10 rounded-3xl bg-white/95 dark:bg-gray-900/80 shadow-2xl ring-1 ring-gray-100 dark:ring-gray-700 backdrop-blur-xl overflow-hidden transition-all duration-500 hover:scale-[1.01] hover:shadow-3xl">

        <!-- Panel Kiri: Headline & Fitur -->
        <div class="relative flex flex-col justify-center px-12 py-16 bg-gradient-to-br from-green-400 via-lime-300 to-emerald-400 text-white rounded-3xl overflow-hidden shadow-lg animate-fade-in-left">
            <div class="absolute inset-0 opacity-40 bg-gradient-to-br from-green-400 via-lime-300 to-emerald-400 blur-xl"></div>
            <div class="relative z-10">
                <!-- Judul -->
                <h1 class="mt-10 text-4xl font-extrabold leading-snug animate-fade-in-down">
                    Peminjaman Alat & Fasilitas Sekolah
                </h1>

                <!-- Penjelasan -->
                <p class="mt-4 text-white/90 text-lg leading-relaxed animate-fade-in-down delay-200">
                    Pinjam perangkat sekolah dengan cepat, pantau status peminjaman, dan catat histori semua peminjaman melalui dashboard modern & interaktif.
                </p>

                <!-- Fitur Singkat -->
                <div class="mt-10 space-y-4 animate-fade-in-up delay-400">
                    <div class="flex items-center space-x-3">
                        <span class="text-white text-2xl">📦</span>
                        <p class="text-white/90 font-medium">Perangkat Lengkap & Terpercaya</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-white text-2xl">⚡</span>
                        <p class="text-white/90 font-medium">Proses Cepat & Instan</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-white text-2xl">✅</span>
                        <p class="text-white/90 font-medium">Aman & Tercatat</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-white text-2xl">📊</span>
                        <p class="text-white/90 font-medium">Pantau Status & Histori</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kanan: Login Form -->
        <div class="relative rounded-3xl bg-white/95 p-10 shadow-xl ring-1 ring-gray-200 dark:bg-gray-900/70 dark:ring-gray-700 animate-fade-in-right">
            {{ $slot }} <!-- Form login / register -->
        </div>

    </div>
</div>

<!-- Floating & Fade-in Animations -->
<style>
@keyframes float { 
    0% { transform: translateY(0) translateX(0); } 
    50% { transform: translateY(-15px) translateX(10px); } 
    100% { transform: translateY(0) translateX(0); } 
}
.animate-float { animation: float 8s ease-in-out infinite alternate; }
.animation-delay-1000 { animation-delay: 1s; }
.animation-delay-2000 { animation-delay: 2s; }

@keyframes fade-in-left { 0% { opacity: 0; transform: translateX(-40px); } 100% { opacity: 1; transform: translateX(0); } }
.animate-fade-in-left { animation: fade-in-left 1s ease forwards; }

@keyframes fade-in-right { 0% { opacity: 0; transform: translateX(40px); } 100% { opacity: 1; transform: translateX(0); } }
.animate-fade-in-right { animation: fade-in-right 1s ease forwards; }

@keyframes fade-in-down { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
.animate-fade-in-down { animation: fade-in-down 0.8s ease forwards; }
@keyframes fade-in-up { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
.animate-fade-in-up { animation: fade-in-up 0.8s ease forwards; }
.delay-200 { animation-delay: 0.2s; }
.delay-400 { animation-delay: 0.4s; }
</style>
</body>
</html>
