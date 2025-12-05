<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script>
        (() => {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const saved = localStorage.getItem('theme');
            const useDark = saved ? saved === 'dark' : prefersDark;
            document.documentElement.classList.toggle('dark', useDark);
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-950">
    <div class="min-h-screen">
        @include('layouts.navigation')
        <main class="pt-20 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>
</html>
