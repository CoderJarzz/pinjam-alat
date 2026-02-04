<x-app-layout>
    <div class="py-10 max-w-6xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 border-b dark:border-gray-700 flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    Data User
                </h1>

                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Total: {{ $users->count() }} user
                </span>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Email
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800 dark:text-gray-200">
                                        {{ $user->name }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('user.show', $user->id) }}"
                                       class="inline-flex items-center px-4 py-2 text-sm font-semibold
                                              bg-emerald-600 hover:bg-emerald-700
                                              text-white rounded-lg shadow transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
