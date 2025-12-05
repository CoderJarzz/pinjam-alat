<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script>
            (() => {
                const saved = localStorage.getItem('guest-theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (saved === 'dark' || (!saved && prefersDark)) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 transition-colors duration-200 dark:bg-slate-950 dark:text-slate-100">
        <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-indigo-50 via-white to-purple-100 dark:from-slate-900 dark:via-slate-950 dark:to-slate-900">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(79,70,229,0.15),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(236,72,153,0.12),_transparent_35%)] dark:bg-[radial-gradient(circle_at_top,_rgba(15,23,42,0.7),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(76,29,149,0.4),_transparent_35%)]"></div>

            <div class="relative z-10 flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
                <div class="w-full max-w-5xl rounded-3xl bg-white/95 shadow-2xl ring-1 ring-indigo-50 backdrop-blur dark:bg-slate-900/80 dark:ring-slate-800">
                    <div class="flex justify-end px-6 pt-6 sm:px-10">
                        <button id="theme-toggle" type="button" class="inline-flex items-center space-x-2 rounded-full border border-slate-200 bg-white/80 px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-600 dark:border-slate-700 dark:bg-slate-800/80 dark:text-slate-200 dark:hover:border-indigo-500 dark:hover:text-indigo-400">
                            <svg id="theme-toggle-icon-sun" aria-hidden="true" class="h-4 w-4 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 15a5 5 0 100-10 5 5 0 000 10z" />
                                <path fill-rule="evenodd" d="M10 1a1 1 0 011 1v1a1 1 0 11-2 0V2a1 1 0 011-1zm0 15a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm9-6a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm11.071-6.071a1 1 0 010 1.414L14.657 5.757a1 1 0 11-1.414-1.414l.414-.414a1 1 0 011.414 0zM6.757 14.657a1 1 0 010 1.414l-.414.414a1 1 0 11-1.414-1.414l.414-.414a1 1 0 011.414 0zm9.9 0a1 1 0 10-1.414-1.414l-.414.414a1 1 0 101.414 1.414l.414-.414zM6.757 5.757a1 1 0 00-1.414-1.414l-.414.414A1 1 0 105.343 6.17l.414-.414z" clip-rule="evenodd" />
                            </svg>
                            <svg id="theme-toggle-icon-moon" aria-hidden="true" class="hidden h-4 w-4 text-indigo-200" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                            <span id="theme-toggle-label">Mode Terang</span>
                        </button>
                    </div>
                    <div class="grid gap-10 p-6 pt-4 sm:p-10 sm:pt-6 lg:grid-cols-[1.15fr,0.85fr]">
                        <div class="relative hidden rounded-2xl bg-slate-900 px-8 py-10 text-white lg:flex lg:flex-col lg:justify-between dark:bg-slate-950">
                            <div class="absolute inset-0 overflow-hidden rounded-2xl">
                                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-sky-500 to-purple-500 opacity-80"></div>
                                <div class="absolute -bottom-16 -right-10 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
                            </div>
                            <div class="relative z-10">
                                <a href="/" class="inline-flex items-center space-x-3 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white/90 ring-1 ring-white/20 backdrop-blur">
                                    <x-application-logo class="h-8 w-8 text-white" />
                                    <span>{{ config('app.name', 'Laravel') }}</span>
                                </a>
                                <p class="mt-10 text-3xl font-semibold leading-tight text-white">
                                    Wujudkan pengalaman sewa HP yang cepat, transparan, dan tanpa ribet.
                                </p>
                                <p class="mt-4 text-sm text-white/80">
                                    Optimalkan operasional rental dengan dashboard ringkas, manajemen stok real-time, dan histori sewa yang mudah diawasi.
                                </p>
                            </div>
                            <dl class="relative z-10 grid gap-6 text-sm text-white/90 sm:grid-cols-2">
                                <div>
                                    <dt class="text-xs uppercase tracking-widest text-white/60">Perangkat</dt>
                                    <dd class="mt-1 text-2xl font-semibold">150+</dd>
                                </div>
                                <div>
                                    <dt class="text-xs uppercase tracking-widest text-white/60">Customer</dt>
                                    <dd class="mt-1 text-2xl font-semibold">1.2K</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="rounded-2xl bg-white/90 p-6 shadow-lg ring-1 ring-gray-100 transition dark:bg-slate-900/70 dark:ring-slate-800 sm:p-8">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const btn = document.getElementById('theme-toggle');
                const label = document.getElementById('theme-toggle-label');
                const sun = document.getElementById('theme-toggle-icon-sun');
                const moon = document.getElementById('theme-toggle-icon-moon');
                if (!btn || !label || !sun || !moon) return;

                const updateLabel = () => {
                    const isDark = document.documentElement.classList.contains('dark');
                    label.textContent = isDark ? 'Mode Gelap' : 'Mode Terang';
                    sun.classList.toggle('hidden', isDark);
                    moon.classList.toggle('hidden', !isDark);
                };

                btn.addEventListener('click', () => {
                    const root = document.documentElement;
                    const willBeDark = !root.classList.contains('dark');
                    root.classList.toggle('dark', willBeDark);
                    localStorage.setItem('guest-theme', willBeDark ? 'dark' : 'light');
                    updateLabel();
                });

                updateLabel();
            });
        </script>
    </body>
</html>
