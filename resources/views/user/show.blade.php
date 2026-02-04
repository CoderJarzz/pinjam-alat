<x-app-layout>
    <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="mb-6 text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('user.index') }}" class="hover:text-emerald-600">User</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-200 font-medium">Detail</span>
        </nav>

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 border-b dark:border-gray-700">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Detail User
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Informasi lengkap akun pengguna
                </p>
            </div>

            {{-- Content --}}
            <div class="p-6 flex flex-col md:flex-row gap-6">

                {{-- Profile Card --}}
                <div class="md:w-1/3 bg-gray-50 dark:bg-gray-900 rounded-xl p-6 text-center">
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

                {{-- Detail Info --}}
                <div class="md:w-2/3 space-y-4">

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">
                            {{ $user->name }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Role</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">
                            {{ ucfirst($user->role) }}
                        </p>
                    </div>

                    {{-- Action --}}
<div class="flex justify-between items-center pt-4 border-t dark:border-gray-700">

    <a href="{{ route('user.index') }}"
       class="px-5 py-2 bg-gray-200 hover:bg-gray-300
              dark:bg-gray-700 dark:hover:bg-gray-600
              text-gray-800 dark:text-gray-200 rounded-lg transition">
        Kembali
    </a>

    @auth
        <div class="flex gap-3">

            {{-- EDIT (ADMIN ATAU USER ITU SENDIRI) --}}
            @if(auth()->user()->isAdmin() || auth()->id() === $user->id)
                <a href="{{ route('user.edit', $user->id) }}"
                   class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700
                          text-white rounded-lg font-semibold transition shadow-md">
                    Edit
                </a>
            @endif

            {{-- HAPUS (ADMIN ATAU USER ITU SENDIRI) --}}
            @if(auth()->user()->isAdmin() || auth()->id() === $user->id)
                <form action="{{ route('user.destroy', $user->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan!')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700
                               text-white rounded-lg font-semibold transition shadow-md">
                        Hapus
                    </button>
                </form>
            @endif

        </div>
    @endauth
</div>

</div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
