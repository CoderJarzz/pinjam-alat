<x-guest-layout>
    <div class="space-y-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.4em] text-rose-500 dark:text-rose-300">Mulai Sekarang</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">Buat akun baru</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">Daftar untuk mengelola katalog HP, memproses penyewaan, dan memantau performa bisnis secara real-time.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" value="Nama lengkap" class="text-sm font-semibold text-slate-700 dark:text-slate-200" />
                <x-text-input id="name"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-rose-500 focus:ring-rose-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500"
                    type="text"
                    name="name"
                    :value="old('name')"
                    placeholder="Misal: Prabowo Subianto"
                    required
                    autofocus
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" value="Email" class="text-sm font-semibold text-slate-700 dark:text-slate-200" />
                <x-text-input id="email"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-rose-500 focus:ring-rose-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500"
                    type="email"
                    name="email"
                    :value="old('email')"
                    placeholder="nama@email.com"
                    required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="text-sm font-semibold text-slate-700 dark:text-slate-200" />
                <x-text-input id="password"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-rose-500 focus:ring-rose-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500"
                    type="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Konfirmasi password" class="text-sm font-semibold text-slate-700 dark:text-slate-200" />
                <x-text-input id="password_confirmation"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-rose-500 focus:ring-rose-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500"
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm" />
            </div>

            <x-primary-button class="flex w-full justify-center rounded-xl bg-rose-500 px-4 py-3 text-base font-semibold tracking-wide shadow-lg shadow-rose-300 transition hover:bg-rose-400 focus:ring-offset-slate-100 dark:bg-rose-500 dark:hover:bg-rose-400 dark:focus:ring-offset-slate-900">
                Daftar
            </x-primary-button>
        </form>

        <div class="flex flex-wrap items-center justify-center gap-2 rounded-xl bg-rose-50 px-4 py-3 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-200">
            <span class="text-slate-600 dark:text-slate-300">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="font-semibold text-rose-500 hover:text-rose-400 dark:text-rose-300 dark:hover:text-rose-200">
                Masuk sekarang
            </a>
        </div>
    </div>
</x-guest-layout>
