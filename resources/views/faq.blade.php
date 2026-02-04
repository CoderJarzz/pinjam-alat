<x-app-layout>

    {{-- ANIMASI GLOBAL --}}
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn .7s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* floating halus */
        .float-card {
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .float-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }

        /* animasi floating perlahan */
        @keyframes gentleFloat {
            0% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
            100% { transform: translateY(0); }
        }

        .floating {
            animation: gentleFloat 4s ease-in-out infinite;
        }
    </style>

    <div class="max-w-5xl mx-auto py-12 sm:px-6 lg:px-8 space-y-10 fade-in">

        <div class="rounded-3xl border border-indigo-100 bg-white/90 px-8 py-10 shadow-xl 
            dark:border-slate-800 dark:bg-slate-900/80 float-card floating">
            <p class="text-sm font-semibold uppercase tracking-[0.4em] text-indigo-500">FAQ & S&K</p>
            <h1 class="mt-2 text-4xl font-bold text-slate-900 dark:text-white">
                Syarat & Ketentuan Peminjaman Alat Sekolah
            </h1>
            <p class="mt-3 text-base text-slate-600 dark:text-slate-300 max-w-3xl">
                Harap membaca dan memahami ketentuan berikut sebelum melakukan peminjaman alat sekolah. 
                Dengan mengajukan peminjaman, peminjam dianggap menyetujui seluruh peraturan yang berlaku.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 fade-in">

            <div class="rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-sm 
                dark:border-slate-800 dark:bg-slate-900/70 float-card">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">1. Persyaratan Peminjam</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                    <li>• Peminjam merupakan siswa, guru, atau staf sekolah.</li>
                    <li>• Peminjaman wajib menggunakan identitas resmi (NIS/NIP).</li>
                    <li>• Telah mendapatkan izin dari guru atau penanggung jawab terkait.</li>
                </ul>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-sm 
                dark:border-slate-800 dark:bg-slate-900/70 float-card">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">2. Durasi & Pengembalian</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                    <li>• Lama peminjaman disesuaikan dengan kebutuhan kegiatan belajar.</li>
                    <li>• Alat harus dikembalikan sesuai tanggal yang telah disepakati.</li>
                    <li>• Keterlambatan pengembalian akan dicatat dan dikenakan sanksi.</li>
                </ul>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-sm 
                dark:border-slate-800 dark:bg-slate-900/70 float-card">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">3. Tanggung Jawab & Keamanan Alat</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                    <li>• Peminjam bertanggung jawab penuh atas alat yang dipinjam.</li>
                    <li>• Dilarang memodifikasi, membongkar, atau menyalahgunakan alat.</li>
                    <li>• Kerusakan atau kehilangan menjadi tanggung jawab peminjam.</li>
                </ul>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-sm 
                dark:border-slate-800 dark:bg-slate-900/70 float-card">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">4. Sanksi & Ketentuan Lainnya</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                    <li>• Peminjam yang melanggar aturan dapat diblokir dari peminjaman.</li>
                    <li>• Kerusakan berat dapat dikenakan penggantian alat.</li>
                    <li>• Aturan dapat berubah sesuai kebijakan sekolah.</li>
                </ul>
            </div>

        </div>

        <div class="rounded-2xl border border-blue-200 bg-indigo-50/80 p-6 text-sm text-slate-700 
            dark:border-indigo-500/40 dark:bg-indigo-500/10 dark:text-indigo-100 float-card fade-in">
            <p class="font-semibold text-indigo-700 dark:text-indigo-100">Perhatian:</p>
            <p class="mt-2">
                Pastikan alat yang dipinjam digunakan hanya untuk keperluan sekolah 
                dan dikembalikan dalam kondisi baik agar dapat digunakan kembali oleh siswa lainnya.
            </p>
        </div>

    </div>

</x-app-layout>
