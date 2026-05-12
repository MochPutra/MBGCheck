<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analitik - MBGCheck</title>
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
                <a href="/dashboard" class="flex items-center px-2 py-2.5 bg-blue-50 text-blue-700 rounded-lg group font-medium">
                    <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Dashboard Analitik
                </a>
                <a href="/jadwal-menu" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Jadwal Menu
                </a>
                <a href="/kalkulator" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
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

        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm shrink-0">
                <h2 class="text-xl font-semibold text-gray-800">Dashboard Analitik Gizi</h2>
                <span class="text-sm text-gray-500">Visualisasi Data Program MBG</span>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-7xl mx-auto space-y-8">

                    {{-- STAT CARDS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Total Makanan</p>
                                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalMakanan) }}</p>
                                </div>
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Jumlah Kategori</p>
                                    <p class="text-3xl font-bold text-purple-600">{{ $totalKategori }}</p>
                                </div>
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Rata-rata Kalori</p>
                                    <p class="text-3xl font-bold text-orange-500">{{ $avgKalori }} <span class="text-base font-normal text-gray-400">Kkal</span></p>
                                </div>
                                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Rata-rata Protein</p>
                                    <p class="text-3xl font-bold text-green-600">{{ $avgProtein }} <span class="text-base font-normal text-gray-400">g</span></p>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ROW 1: Donut + Bar --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Distribusi Kategori Makanan</h3>
                            <div id="chartKategori"></div>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Rata-rata Gizi per Kategori</h3>
                            <div id="chartGiziKategori"></div>
                        </div>
                    </div>

                    {{-- ROW 2: Top Kalori + Top Protein --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">🔥 Top 10 Makanan Tertinggi Kalori</h3>
                            <div id="chartTopKalori"></div>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">💪 Top 10 Makanan Tertinggi Protein</h3>
                            <div id="chartTopProtein"></div>
                        </div>
                    </div>

                    {{-- ROW 3: Histogram + Rasio --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Distribusi Rentang Kalori</h3>
                            <div id="chartHistogram"></div>
                        </div>
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Rasio Makronutrien Keseluruhan</h3>
                            <div id="chartRasio"></div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

<script>
// Color palette
const colors = ['#3b82f6','#8b5cf6','#f59e0b','#10b981','#ef4444','#ec4899','#06b6d4'];

// 1. Donut - Kategori
new ApexCharts(document.querySelector("#chartKategori"), {
    chart: { type: 'donut', height: 350 },
    series: {!! json_encode($kategoriData->pluck('total')) !!},
    labels: {!! json_encode($kategoriData->pluck('kategori')) !!},
    colors: colors,
    plotOptions: { pie: { donut: { size: '60%', labels: { show: true, total: { show: true, label: 'Total', fontSize: '16px' } } } } },
    legend: { position: 'bottom', fontSize: '13px' },
    dataLabels: { style: { fontSize: '12px' } }
}).render();

// 2. Bar - Rata-rata Gizi per Kategori
new ApexCharts(document.querySelector("#chartGiziKategori"), {
    chart: { type: 'bar', height: 350, toolbar: { show: false } },
    series: [
        { name: 'Kalori (Kkal)', data: {!! json_encode($giziPerKategori->pluck('avg_kalori')) !!} },
        { name: 'Protein (g)', data: {!! json_encode($giziPerKategori->pluck('avg_protein')) !!} },
        { name: 'Karbohidrat (g)', data: {!! json_encode($giziPerKategori->pluck('avg_karbohidrat')) !!} }
    ],
    xaxis: { categories: {!! json_encode($giziPerKategori->pluck('kategori')) !!}, labels: { style: { fontSize: '11px' } } },
    colors: ['#f59e0b','#10b981','#3b82f6'],
    plotOptions: { bar: { borderRadius: 4, columnWidth: '60%' } },
    dataLabels: { enabled: false },
    legend: { position: 'top' }
}).render();

// 3. Horizontal Bar - Top Kalori
new ApexCharts(document.querySelector("#chartTopKalori"), {
    chart: { type: 'bar', height: 380, toolbar: { show: false } },
    series: [{ name: 'Kalori', data: {!! json_encode($topKalori->pluck('kalori')) !!} }],
    xaxis: { categories: {!! json_encode($topKalori->pluck('nama_makanan')) !!} },
    plotOptions: { bar: { horizontal: true, borderRadius: 6, barHeight: '65%' } },
    colors: ['#ef4444'],
    dataLabels: { enabled: true, formatter: v => v + ' Kkal', style: { fontSize: '11px' } }
}).render();

// 4. Horizontal Bar - Top Protein
new ApexCharts(document.querySelector("#chartTopProtein"), {
    chart: { type: 'bar', height: 380, toolbar: { show: false } },
    series: [{ name: 'Protein', data: {!! json_encode($topProtein->pluck('protein')) !!} }],
    xaxis: { categories: {!! json_encode($topProtein->pluck('nama_makanan')) !!} },
    plotOptions: { bar: { horizontal: true, borderRadius: 6, barHeight: '65%' } },
    colors: ['#10b981'],
    dataLabels: { enabled: true, formatter: v => v + ' g', style: { fontSize: '11px' } }
}).render();

// 5. Area - Distribusi Kalori
new ApexCharts(document.querySelector("#chartHistogram"), {
    chart: { type: 'area', height: 350, toolbar: { show: false } },
    series: [{ name: 'Jumlah Makanan', data: {!! json_encode($kaloriRanges->pluck('total')) !!} }],
    xaxis: { categories: {!! json_encode($kaloriRanges->pluck('range_label')) !!}, title: { text: 'Rentang Kalori (Kkal)' } },
    yaxis: { title: { text: 'Jumlah Makanan' } },
    colors: ['#8b5cf6'],
    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.5, opacityTo: 0.1 } },
    dataLabels: { enabled: true, style: { fontSize: '12px' } },
    stroke: { curve: 'smooth', width: 3 }
}).render();

// 6. Radial - Rasio Makronutrien
new ApexCharts(document.querySelector("#chartRasio"), {
    chart: { type: 'radialBar', height: 350 },
    series: [{{ $rasioProtein }}, {{ $rasioKarbo }}],
    labels: ['Protein', 'Karbohidrat'],
    colors: ['#10b981','#3b82f6'],
    plotOptions: {
        radialBar: {
            hollow: { size: '40%' },
            dataLabels: {
                name: { fontSize: '16px' },
                value: { fontSize: '20px', formatter: v => v + '%' },
                total: { show: true, label: 'Dominan', formatter: () => '{{ $rasioKarbo > $rasioProtein ? "Karbohidrat" : "Protein" }}' }
            },
            track: { background: '#f3f4f6' }
        }
    }
}).render();
</script>
</body>
</html>
