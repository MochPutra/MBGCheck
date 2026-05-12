<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Gizi - MBGCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm shrink-0">
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <h1 class="text-2xl font-extrabold text-blue-600 tracking-tight">MBGCheck</h1>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Area Publik</p>
                <a href="/" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Makanan
                </a>
                <a href="/dashboard" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Dashboard Analitik
                </a>
                <a href="/jadwal-menu" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Jadwal Menu
                </a>
                <a href="/kalkulator" class="flex items-center px-2 py-2.5 bg-blue-50 text-blue-700 rounded-lg group font-medium">
                    <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Kalkulator Gizi
                </a>

                @if(session('is_admin'))
                    <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6">Manajemen (Admin)</p>
                    <a href="/admin/makanan" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        Kelola Data Makanan
                    </a>
                @endif
            </nav>
            <div class="p-4 border-t border-gray-200">
                @if(session('is_admin'))
                    <a href="/logout" class="flex items-center px-2 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout ({{ session('admin_nama') }})
                    </a>
                @else
                    <a href="/login" class="flex items-center px-2 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Login Admin
                    </a>
                @endif
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm shrink-0">
                <h2 class="text-xl font-semibold text-gray-800">Kalkulator Gizi & Rekomendasi Makanan</h2>
                <span class="text-sm text-gray-500">Hitung kebutuhan nutrisi harianmu</span>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-3xl mx-auto">

                    {{-- INTRO --}}
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 mb-8 text-white shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold mb-2">Hitung Kebutuhan Kalori Harianmu</h3>
                                <p class="text-blue-100">Masukkan data tubuhmu dan kami akan menghitung kebutuhan kalori, makronutrien, serta memberikan rekomendasi makanan yang sesuai dari database kami.</p>
                            </div>
                        </div>
                    </div>

                    {{-- FORM --}}
                    <form action="/kalkulator" method="POST" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-200">
                        @csrf

                        {{-- Gender --}}
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Jenis Kelamin</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="gender" value="pria" class="peer sr-only" checked>
                                    <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all hover:border-gray-300">
                                        <span class="text-3xl block mb-1">👨</span>
                                        <span class="font-semibold text-gray-700">Pria</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="gender" value="wanita" class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-pink-500 peer-checked:bg-pink-50 transition-all hover:border-gray-300">
                                        <span class="text-3xl block mb-1">👩</span>
                                        <span class="font-semibold text-gray-700">Wanita</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Metrics row --}}
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Berat Badan (kg)</label>
                                <input type="number" name="berat" step="0.1" min="20" max="300" required placeholder="70"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-lg font-medium text-center">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi" step="0.1" min="100" max="250" required placeholder="170"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-lg font-medium text-center">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Usia (tahun)</label>
                                <input type="number" name="usia" min="10" max="100" required placeholder="25"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-lg font-medium text-center">
                            </div>
                        </div>

                        {{-- Activity Level --}}
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tingkat Aktivitas Fisik</label>
                            <select name="aktivitas" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
                                <option value="1.2">🪑 Sangat Jarang Olahraga (kerja kantoran)</option>
                                <option value="1.375">🚶 Ringan (olahraga 1-3x/minggu)</option>
                                <option value="1.55" selected>🏃 Sedang (olahraga 3-5x/minggu)</option>
                                <option value="1.725">🏋️ Berat (olahraga 6-7x/minggu)</option>
                                <option value="1.9">⚡ Sangat Berat (atlet / kerja fisik berat)</option>
                            </select>
                        </div>

                        {{-- Goal --}}
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Tujuan</label>
                            <div class="grid grid-cols-3 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="tujuan" value="deficit" class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-green-500 peer-checked:bg-green-50 transition-all hover:border-gray-300">
                                        <span class="text-2xl block mb-1">📉</span>
                                        <span class="font-semibold text-sm text-gray-700">Turun BB</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="tujuan" value="maintain" class="peer sr-only" checked>
                                    <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all hover:border-gray-300">
                                        <span class="text-2xl block mb-1">⚖️</span>
                                        <span class="font-semibold text-sm text-gray-700">Jaga BB</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="tujuan" value="surplus" class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-xl text-center peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all hover:border-gray-300">
                                        <span class="text-2xl block mb-1">💪</span>
                                        <span class="font-semibold text-sm text-gray-700">Naik Otot</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl hover:bg-blue-700 font-bold text-lg transition-colors shadow-md hover:shadow-lg">
                            🔬 Hitung Kebutuhan Gizi
                        </button>
                    </form>

                    {{-- INFO --}}
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-5 text-sm text-blue-800">
                        <p class="font-semibold mb-1">ℹ️ Metode Perhitungan</p>
                        <p>Menggunakan rumus <strong>Mifflin-St Jeor</strong> yang direkomendasikan oleh American Dietetic Association untuk menghitung BMR (Basal Metabolic Rate), dikalikan faktor aktivitas fisik untuk mendapatkan TDEE (Total Daily Energy Expenditure).</p>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>
