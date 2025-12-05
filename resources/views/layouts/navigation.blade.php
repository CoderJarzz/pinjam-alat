<nav class="fixed top-0 w-full z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur border-b border-gray-200 dark:border-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 20 20" fill="currentColor"><path d="M11 17a1 1 0 01-1-1V4.414l3.707 3.707a1 1 0 001.414-1.414l-5.414-5.414a1 1 0 00-1.414 0L2.88 6.707a1 1 0 001.414 1.414L8 4.414V16a1 1 0 001 1h2z"/></svg>
                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">Sewa HP</span>
            </a>
            <div class="hidden md:flex items-center gap-6 ml-6">
                <a href="{{ route('dashboard') }}" class="px-1 pb-1 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 dark:text-gray-300 hover:text-blue-500' }}">Dashboard</a>
                <a href="{{ route('barang.index') }}" class="px-1 pb-1 text-sm font-medium {{ request()->routeIs('barang.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 dark:text-gray-300 hover:text-blue-500' }}">Barang</a>
                <a href="{{ route('sewa.index') }}" class="px-1 pb-1 text-sm font-medium {{ request()->routeIs('sewa.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 dark:text-gray-300 hover:text-blue-500' }}">Riwayat</a>
                <a href="{{ route('faq') }}" class="px-1 pb-1 text-sm font-medium {{ request()->routeIs('faq') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 dark:text-gray-300 hover:text-blue-500' }}">FAQ</a>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button id="theme-toggle" class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                <svg id="icon-sun" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M12 18a6 6 0 110-12 6 6 0 010 12zM12 2a1 1 0 011 1v1a1 1 0 01-2 0V3a1 1 0 011-1zm0 18a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.222 5.636a1 1 0 011.414 0l.707.707A1 1 0 015.636 8.05l-.707-.707a1 1 0 010-1.414z"/></svg>
                <svg id="icon-moon" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/></svg>
            </button>

            <div class="hidden md:flex">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-500 transition">
                            <svg class="h-5 w-5 mr-1 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.646 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ Auth::user()->name }}
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const btn = document.getElementById('theme-toggle');
    const sun = document.getElementById('icon-sun');
    const moon = document.getElementById('icon-moon');

    function updateIcons() {
        const dark = html.classList.contains('dark');
        sun.classList.toggle('hidden', !dark);
        moon.classList.toggle('hidden', dark);
    }

    btn.addEventListener('click', () => {
        html.classList.toggle('dark');
        localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        updateIcons();
    });

    updateIcons();
});
</script>
@endpush
