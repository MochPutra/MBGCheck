<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kalkulator Gizi - MBGCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                <h2 class="text-xl font-semibold text-gray-800">Hasil Perhitungan Gizi</h2>
                <a href="/kalkulator" class="text-sm text-blue-600 hover:text-blue-800 font-medium">← Hitung Ulang</a>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-5xl mx-auto space-y-8">

                    {{-- PROFIL USER --}}
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div>
                                <p class="text-blue-200 text-sm mb-1">Profil Anda</p>
                                <p class="text-xl font-bold">{{ $gender === 'pria' ? '👨' : '👩' }} {{ ucfirst($gender) }}, {{ $usia }} tahun — {{ $berat }} kg / {{ $tinggi }} cm</p>
                                <p class="text-blue-200 text-sm mt-1">🎯 {{ $tujuanLabel }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-blue-200 text-sm">BMI</p>
                                <p class="text-4xl font-black">{{ $bmi }}</p>
                                <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-bold
                                    {{ $bmiStatus === 'Normal' ? 'bg-green-400/30 text-green-100' :
                                       ($bmiStatus === 'Kurus' ? 'bg-yellow-400/30 text-yellow-100' :
                                       'bg-red-400/30 text-red-100') }}">
                                    {{ $bmiStatus }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- KALORI CARDS --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm text-center">
                            <p class="text-sm text-gray-500 mb-1">BMR (Metabolisme Basal)</p>
                            <p class="text-3xl font-bold text-gray-800">{{ number_format(round($bmr)) }}</p>
                            <p class="text-xs text-gray-400 mt-1">Kkal/hari</p>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm text-center">
                            <p class="text-sm text-gray-500 mb-1">TDEE (Kebutuhan Harian)</p>
                            <p class="text-3xl font-bold text-blue-600">{{ number_format($tdee) }}</p>
                            <p class="text-xs text-gray-400 mt-1">Kkal/hari</p>
                        </div>
                        <div class="bg-white rounded-xl p-6 border-2 border-blue-500 shadow-md text-center relative">
                            <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-xs px-3 py-1 rounded-full font-bold">TARGET</span>
                            <p class="text-sm text-gray-500 mb-1 mt-1">Kalori Target</p>
                            <p class="text-4xl font-black text-blue-600">{{ number_format($targetKalori) }}</p>
                            <p class="text-xs text-gray-400 mt-1">Kkal/hari</p>
                        </div>
                    </div>

                    {{-- MACRO CHART + TABLE --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Target Makronutrien Harian</h3>
                            <div id="chartMakro"></div>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Detail Kebutuhan</h3>
                            <div class="space-y-4 mt-2">
                                <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl border border-green-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center text-white font-bold">P</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Protein</p>
                                            <p class="text-xs text-gray-500">Pembentukan & perbaikan otot</p>
                                        </div>
                                    </div>
                                    <p class="text-2xl font-bold text-green-600">{{ $targetProtein }}g</p>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border border-blue-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold">K</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Karbohidrat</p>
                                            <p class="text-xs text-gray-500">Sumber energi utama</p>
                                        </div>
                                    </div>
                                    <p class="text-2xl font-bold text-blue-600">{{ $targetKarbo }}g</p>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-orange-50 rounded-xl border border-orange-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold">L</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Lemak</p>
                                            <p class="text-xs text-gray-500">Hormon & penyerapan vitamin</p>
                                        </div>
                                    </div>
                                    <p class="text-2xl font-bold text-orange-500">{{ $targetLemak }}g</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FOOD RECOMMENDATIONS --}}
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-gray-800">🍽️ Rekomendasi Makanan dari Database</h3>

                        {{-- High Protein --}}
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h4 class="font-bold text-green-700 mb-1 flex items-center gap-2">
                                <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center text-green-600">💪</span>
                                Tinggi Protein — Cocok untuk Pembentukan Otot
                            </h4>
                            <p class="text-sm text-gray-500 mb-4">Makanan dengan protein tertinggi dari database MBG</p>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="bg-green-50 text-green-800">
                                            <th class="p-3 text-left rounded-l-lg">Nama Makanan</th>
                                            <th class="p-3 text-center">Kategori</th>
                                            <th class="p-3 text-center">Kalori</th>
                                            <th class="p-3 text-center">Protein</th>
                                            <th class="p-3 text-center rounded-r-lg">Karbo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($rekomendasiProtein as $item)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 font-medium"><a href="/makanan/{{ $item->id_makanan }}" class="text-blue-600 hover:underline">{{ $item->nama_makanan }}</a></td>
                                            <td class="p-3 text-center"><span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $item->kategori }}</span></td>
                                            <td class="p-3 text-center">{{ $item->kalori }} Kkal</td>
                                            <td class="p-3 text-center font-bold text-green-600">{{ $item->protein }}g</td>
                                            <td class="p-3 text-center">{{ $item->karbohidrat }}g</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Low Calorie --}}
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h4 class="font-bold text-blue-700 mb-1 flex items-center gap-2">
                                <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">🥗</span>
                                Rendah Kalori & Bernutrisi — Cocok untuk Diet
                            </h4>
                            <p class="text-sm text-gray-500 mb-4">Makanan di bawah 150 Kkal dengan protein cukup</p>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="bg-blue-50 text-blue-800">
                                            <th class="p-3 text-left rounded-l-lg">Nama Makanan</th>
                                            <th class="p-3 text-center">Kategori</th>
                                            <th class="p-3 text-center">Kalori</th>
                                            <th class="p-3 text-center">Protein</th>
                                            <th class="p-3 text-center rounded-r-lg">Karbo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($rekomendasiRendahKalori as $item)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 font-medium"><a href="/makanan/{{ $item->id_makanan }}" class="text-blue-600 hover:underline">{{ $item->nama_makanan }}</a></td>
                                            <td class="p-3 text-center"><span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $item->kategori }}</span></td>
                                            <td class="p-3 text-center font-bold text-blue-600">{{ $item->kalori }} Kkal</td>
                                            <td class="p-3 text-center">{{ $item->protein }}g</td>
                                            <td class="p-3 text-center">{{ $item->karbohidrat }}g</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- High Energy --}}
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h4 class="font-bold text-orange-700 mb-1 flex items-center gap-2">
                                <span class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">⚡</span>
                                Tinggi Karbohidrat — Sumber Energi untuk Latihan
                            </h4>
                            <p class="text-sm text-gray-500 mb-4">Makanan kaya karbohidrat untuk mendukung aktivitas fisik intens</p>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="bg-orange-50 text-orange-800">
                                            <th class="p-3 text-left rounded-l-lg">Nama Makanan</th>
                                            <th class="p-3 text-center">Kategori</th>
                                            <th class="p-3 text-center">Kalori</th>
                                            <th class="p-3 text-center">Protein</th>
                                            <th class="p-3 text-center rounded-r-lg">Karbo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($rekomendasiEnergi as $item)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 font-medium"><a href="/makanan/{{ $item->id_makanan }}" class="text-blue-600 hover:underline">{{ $item->nama_makanan }}</a></td>
                                            <td class="p-3 text-center"><span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $item->kategori }}</span></td>
                                            <td class="p-3 text-center">{{ $item->kalori }} Kkal</td>
                                            <td class="p-3 text-center">{{ $item->protein }}g</td>
                                            <td class="p-3 text-center font-bold text-orange-600">{{ $item->karbohidrat }}g</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- BACK BUTTON --}}
                    <div class="text-center pb-4">
                        <a href="/kalkulator" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Hitung Ulang
                        </a>
                    </div>

                </div>
            </div>
        </main>
    </div>

<script>
// Donut chart for macros
new ApexCharts(document.querySelector("#chartMakro"), {
    chart: { type: 'donut', height: 300 },
    series: [{{ $targetProtein * 4 }}, {{ $targetKarbo * 4 }}, {{ $targetLemak * 9 }}],
    labels: ['Protein ({{ $targetProtein }}g)', 'Karbohidrat ({{ $targetKarbo }}g)', 'Lemak ({{ $targetLemak }}g)'],
    colors: ['#10b981', '#3b82f6', '#f59e0b'],
    plotOptions: { pie: { donut: { size: '55%', labels: { show: true, total: { show: true, label: 'Total Kalori', fontSize: '13px', formatter: () => '{{ number_format($targetKalori) }} Kkal' } } } } },
    legend: { position: 'bottom', fontSize: '12px' },
    dataLabels: { enabled: true, formatter: (val) => Math.round(val) + '%' }
}).render();
</script>
</body>
</html>
