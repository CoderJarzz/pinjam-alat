<style>/* ================= NAVBAR ANIMATION ================= */

.nav-link {
    position: relative;
    transition: all 0.3s ease;
}

.nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0;
    height: 2px;
    background: white;
    border-radius: 2px;
    transition: width 0.35s ease;
}

.nav-link:hover::after,
.nav-active::after {
    width: 100%;
}

.nav-link:hover {
    transform: translateY(-2px);
    text-shadow: 0 4px 12px rgba(255,255,255,0.45);
}

/* Logo glow */
.logo-hover:hover svg {
    filter: drop-shadow(0 0 8px rgba(255,255,255,0.7));
    transform: scale(1.1);
    transition: all 0.3s ease;
}

/* User name hover */
.user-trigger:hover {
    transform: scale(1.05);
    text-shadow: 0 4px 12px rgba(255,255,255,0.5);
}

/* Dropdown animation */
[x-dropdown-content] {
    animation: dropdownFade 0.25s ease forwards;
}

@keyframes dropdownFade {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<nav class="fixed top-0 w-full z-50 bg-gradient-to-r from-emerald-400 via-lime-300 to-emerald-200
            dark:from-green-900 dark:via-lime-700 dark:to-green-900
            backdrop-blur-md shadow-lg border-b border-green-300 dark:border-green-700
            transition-all duration-500 animate-slide-down">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        {{-- Logo & Menu --}}
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}"
               class="logo-hover flex items-center gap-2 text-white font-bold text-lg transition transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 10h4v10H3V10zM9 3h4v17H9V3zm6 6h4v11h-4V9z"/>
                </svg>
                <span>Sewa Alat</span>
            </a>

            {{-- Desktop Menu --}}
<div class="hidden md:flex items-center gap-6">

    <a href="{{ route('dashboard') }}"
       class="nav-link text-white text-sm font-medium
       {{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">
        Dashboard
    </a>

    @if(Auth::user()->role !== 'petugas')
        <a href="{{ route('barang.index') }}"
           class="nav-link text-white text-sm font-medium
           {{ request()->routeIs('barang.*') ? 'nav-active' : '' }}">
            Alat & Barang
        </a>
    @endif

    {{-- ✅ KATEGORI (ADMIN ONLY) --}}
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('category.index') }}"
           class="nav-link text-white text-sm font-medium
           {{ request()->routeIs('category.*') ? 'nav-active' : '' }}">
            Kategori
        </a>
    @endif

    <a href="{{ route('sewa.index') }}"
       class="nav-link text-white text-sm font-medium
       {{ request()->routeIs('sewa.*') ? 'nav-active' : '' }}">
        Riwayat
    </a>

    <a href="{{ route('faq') }}"
       class="nav-link text-white text-sm font-medium
       {{ request()->routeIs('faq') ? 'nav-active' : '' }}">
        FAQ
    </a>

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('user.index') }}"
           class="nav-link text-white text-sm font-medium
           {{ request()->routeIs('user.*') ? 'nav-active' : '' }}">
            Data User
        </a>
    @endif
</div>

        </div>

        {{-- Right Side --}}
        <div class="flex items-center gap-4">

            {{-- Theme Toggle --}}
            <button id="theme-toggle"
                class="p-2 rounded-full bg-white/30 hover:bg-white/50
                       dark:bg-gray-800/30 dark:hover:bg-gray-800/50
                       transition transform hover:scale-110 hover:drop-shadow-lg">
                <svg id="icon-sun" class="w-5 h-5 hidden text-yellow-400" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 18a6 6 0 110-12 6 6 0 010 12z"/>
                </svg>
                <svg id="icon-moon" class="w-5 h-5 hidden text-gray-200" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/>
                </svg>
            </button>

            {{-- User Dropdown --}}
            <div class="hidden md:block">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="user-trigger flex items-center text-sm font-medium text-white transition">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<script>
(function(){
    const btn = document.getElementById('theme-toggle');
    const sun = document.getElementById('icon-sun');
    const moon = document.getElementById('icon-moon');

    function updateIcons(){
        if(!sun || !moon) return;
        if(document.documentElement.classList.contains('dark')){
            sun.classList.remove('hidden');
            moon.classList.add('hidden');
        } else {
            moon.classList.remove('hidden');
            sun.classList.add('hidden');
        }
    }

    function setTheme(theme){
        if(theme === 'dark') document.documentElement.classList.add('dark');
        else document.documentElement.classList.remove('dark');
        try { localStorage.setItem('theme', theme); } catch(e){}
        updateIcons();
    }

    (function init(){
        try{
            const stored = localStorage.getItem('theme');
            if(stored === 'dark') setTheme('dark');
            else if(stored === 'light') setTheme('light');
            else if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) setTheme('dark');
            else setTheme('light');

            if(btn) btn.addEventListener('click', function(){
                setTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark');
            });
        }catch(e){ console.error(e); }
    })();
})();
</script>
