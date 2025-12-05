<x-guest-layout>
    <div class="space-y-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.4em] text-indigo-600 dark:text-indigo-400">Selamat Datang</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">Masuk ke dashboard sewa HP</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">Pantau stok, kelola pesanan, dan proses penyewaan lebih cepat dari satu tempat.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" value="Email" class="text-sm font-semibold text-slate-700 dark:text-slate-200" />
                <x-text-input id="email"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500"
                    type="email"
                    name="email"
                    :value="old('email')"
                    placeholder="nama@email.com"
                    required
                    autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="text-sm font-semibold text-slate-700 dark:text-slate-200" />
                <x-text-input id="password"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500"
                    type="password"
                    name="password"
                    placeholder="********"
                    required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                <label for="remember_me" class="inline-flex items-center space-x-2 text-slate-600 dark:text-slate-300">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-900" name="remember">
                    <span>Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <x-primary-button class="flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3 text-base font-semibold tracking-wide shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-500 focus:ring-offset-slate-100 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus:ring-offset-slate-900">
                Masuk
            </x-primary-button>
        </form>

        <div class="flex flex-wrap items-center justify-center gap-2 rounded-xl bg-indigo-50 px-4 py-3 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-200">
            <span class="text-slate-600 dark:text-slate-300">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                Daftar sekarang
            </a>
        </div>
    </div>
</x-guest-layout>
