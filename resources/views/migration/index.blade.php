<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Migration DashboardX</title>
    <!-- Menggunakan CDN Tailwind CSS untuk tampilan cepat -->
    {{-- <script src="https://jsdelivr.net"></script> --}}
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Antarmuka Migrasi Laravel</h1>

        <!-- Notifikasi Sukses / Error -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {!! session('success') !!}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex gap-4">
            <!-- Tombol Migrate -->
            <form action="{{ route('migration.run') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition">
                    Jalankan Migrate
                </button>
            </form>

            <!-- Tombol Rollback -->
            <form action="{{ route('migration.rollback') }}" method="POST">
                @csrf
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded shadow transition">
                    Rollback (Mundur 1 Batch)
                </button>
            </form>
        </div>
    </div>

</body>
</html>
