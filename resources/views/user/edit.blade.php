<x-app-layout>
    <div class="py-10 max-w-5xl mx-auto sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="mb-6 text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('user.index') }}" class="hover:text-emerald-600">User</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-200 font-medium">Edit</span>
        </nav>

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 border-b dark:border-gray-700">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Edit User
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Kelola dan perbarui informasi akun pengguna
                </p>
            </div>

            {{-- Content --}}
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Sidebar Profile --}}
                <div class="md:col-span-1 bg-gray-50 dark:bg-gray-900 rounded-xl p-5 text-center">
                    <div class="w-24 h-24 mx-auto rounded-full bg-emerald-600
                                flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <h2 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->email }}
                    </p>

                    <span class="inline-block mt-3 px-3 py-1 text-xs rounded-full
                        {{ $user->role === 'admin'
                            ? 'bg-red-100 text-red-700'
                            : 'bg-emerald-100 text-emerald-700' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                {{-- Form --}}
                <div class="md:col-span-2">

                    {{-- Alert --}}
                    @if ($errors->any())
                        <div class="mb-5 p-4 bg-red-100 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.update', $user->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Nama --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama
                                </label>
                                <input type="text" name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600
                                           dark:bg-gray-700 dark:text-gray-200
                                           focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email
                                </label>
                                <input type="email" name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600
                                           dark:bg-gray-700 dark:text-gray-200
                                           focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>

                            {{-- Role --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Role
                                </label>
                                <select name="role"
                                    class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-600
                                           dark:bg-gray-700 dark:text-gray-200
                                           focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>
                                        Petugas
                                    </option>
                                </select>
                            </div>

                        </div>

                        {{-- Action --}}
                        <div class="flex justify-between pt-6 border-t dark:border-gray-700">
                            <a href="{{ route('user.show', $user->id) }}"
                               class="px-5 py-2 bg-gray-200 hover:bg-gray-300
                                      dark:bg-gray-700 dark:hover:bg-gray-600
                                      text-gray-800 dark:text-gray-200 rounded-lg transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700
                                       text-white rounded-lg font-semibold transition shadow-md">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
