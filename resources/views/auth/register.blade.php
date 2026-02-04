<x-guest-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="text-center animate-fade-in-down">
            <p class="text-xs font-semibold uppercase tracking-[0.4em] text-green-600 dark:text-green-300">Mulai Sekarang</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">Buat Akun Baru</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300 max-w-md mx-auto">
                Daftar untuk mengelola alat & fasilitas sekolah, memproses peminjaman, dan memantau histori secara real-time.
            </p>
        </div>

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5 animate-fade-in-up delay-200">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" value="Nama Lengkap" class="text-sm font-semibold text-green-700 dark:text-green-300" />
                <x-text-input id="name"
                    class="mt-2 block w-full rounded-xl border-green-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:border-green-700 dark:bg-gray-900 dark:text-green-100 dark:placeholder-green-400"
                    type="text"
                    name="name"
                    :value="old('name')"
                    placeholder="Misal: Fajar Edzt"
                    required
                    autofocus
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" class="text-sm font-semibold text-green-700 dark:text-green-300" />
                <x-text-input id="email"
                    class="mt-2 block w-full rounded-xl border-green-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:border-green-700 dark:bg-gray-900 dark:text-green-100 dark:placeholder-green-400"
                    type="email"
                    name="email"
                    :value="old('email')"
                    placeholder="nama@email.com"
                    required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="text-sm font-semibold text-green-700 dark:text-green-300" />
                <x-text-input id="password"
                    class="mt-2 block w-full rounded-xl border-green-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:border-green-700 dark:bg-gray-900 dark:text-green-100 dark:placeholder-green-400"
                    type="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-sm font-semibold text-green-700 dark:text-green-300" />
                <x-text-input id="password_confirmation"
                    class="mt-2 block w-full rounded-xl border-green-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:border-green-700 dark:bg-gray-900 dark:text-green-100 dark:placeholder-green-400"
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Buttons -->
            <div class="flex flex-col gap-4 mt-4">
                <!-- Register Button -->
                <x-primary-button class="w-full py-3 bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-500 text-white font-semibold rounded-xl transition transform hover:scale-105">
                    Daftar
                </x-primary-button>

                <!-- Login Link -->
                <a href="{{ route('login') }}" 
                   class="w-full text-center py-3 border-2 border-green-600 text-green-700 dark:text-green-300 rounded-xl font-semibold hover:bg-green-600 hover:text-white dark:hover:bg-green-500 transition transform hover:scale-105">
                    Sudah punya akun? Masuk sekarang
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

<!-- Animasi -->
<style>
@keyframes fade-in-up { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
@keyframes fade-in-down { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
.animate-fade-in-up { animation: fade-in-up 0.8s ease forwards; }
.animate-fade-in-down { animation: fade-in-down 0.8s ease forwards; }
.delay-200 { animation-delay: 0.2s; }
</style>
