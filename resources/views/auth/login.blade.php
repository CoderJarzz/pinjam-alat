<x-guest-layout>
    <x-slot name="slot">
        <div class="w-full max-w-md bg-gradient-to-br from-green-50 via-green-100 to-emerald-100 dark:from-gray-900 dark:via-gray-950 dark:to-gray-900 backdrop-blur-lg rounded-3xl shadow-2xl ring-1 ring-green-200 dark:ring-green-700 p-10 transition transform animate-fade-in hover:scale-[1.02]">

            <!-- Judul -->
            <div class="text-center mb-8 animate-fade-in-down">
                <h1 class="text-3xl font-extrabold text-green-700 dark:text-green-300 mb-2">
                    Selamat Datang
                </h1>
                <p class="text-green-800 dark:text-green-200 text-sm">
                    Masuk untuk mengelola peminjaman alat & fasilitas sekolah
                </p>
            </div>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6 animate-fade-in-up delay-400">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-green-700 dark:text-green-300 mb-1" />
                    <x-text-input 
                        id="email" 
                        class="mt-1 block w-full border-green-300 focus:border-green-500 focus:ring focus:ring-green-200 dark:border-green-700 dark:focus:ring-green-500 rounded-lg transition" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autofocus 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-green-700 dark:text-green-300 mb-1"/>
                    <x-text-input 
                        id="password" 
                        class="mt-1 block w-full border-green-300 focus:border-green-500 focus:ring focus:ring-green-200 dark:border-green-700 dark:focus:ring-green-500 rounded-lg transition" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Remember Me & Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember" class="inline-flex items-center text-green-700 dark:text-green-300">
                        <input id="remember" type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                        <span class="ml-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="underline text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-400 transition" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <!-- Buttons -->
                <div class="flex flex-col gap-4 mt-6">
                    <!-- Login Button -->
                    <x-primary-button class="w-full py-3 bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-500 text-white font-semibold rounded-lg transition transform hover:scale-105">
                        Log in
                    </x-primary-button>

                    <!-- Register Button -->
                    <a href="{{ route('register') }}" 
                       class="w-full py-3 text-center border-2 border-green-600 text-green-700 dark:text-green-300 rounded-lg font-semibold hover:bg-green-600 hover:text-white dark:hover:bg-green-500 transition transform hover:scale-105">
                        Register
                    </a>
                </div>
            </form>
        </div>
    </x-slot>
</x-guest-layout>

<!-- Animasi Form -->
<style>
@keyframes fade-in-up { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
@keyframes fade-in-down { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
.animate-fade-in { animation: fade-in-up 1s ease forwards; }
.animate-fade-in-up { animation: fade-in-up 0.8s ease forwards; }
.animate-fade-in-down { animation: fade-in-down 0.8s ease forwards; }
.delay-200 { animation-delay: 0.2s; }
.delay-400 { animation-delay: 0.4s; }
</style>
