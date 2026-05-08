<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBGCheck - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm">
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <h1 class="text-2xl font-extrabold text-blue-600 tracking-tight">MBGCheck</h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <a href="/" class="flex items-center px-2 py-2.5 bg-blue-50 text-blue-700 rounded-lg group font-medium">
                    <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda
                </a>

                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6">Mastering Data</p>
                
                <a href="/admin/makanan" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Data Makanan
                </a>
                <a href="#" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan Gizi
                </a>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <a href="/logout" class="flex items-center px-2 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </a>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm shrink-0">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Makanan</h2>
                <div class="text-sm text-gray-500">
                    Transparansi Program Makan Bergizi Gratis
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-5xl mx-auto">
                    
                    <form action="/" method="GET" class="mb-8 flex gap-3 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <input type="text" name="search" value="{{ $keyword }}" placeholder="Cari nama makanan... (misal: Nasi)" 
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-lg hover:bg-blue-700 font-medium transition-colors shadow-sm">
                            Cari
                        </button>
                    </form>

                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                        @forelse($makanans as $item)
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                                <h3 class="text-lg font-bold text-gray-800">{{ $item->nama_makanan }}</h3>
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2.5 py-1 rounded-full mt-2 mb-4 font-medium">
                                    {{ $item->kategori }}
                                </span>
                                
                                @if($item->nilaiGizi)
                                    <div class="grid grid-cols-2 gap-3 mt-2">
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-500 mb-1">Kalori</p>
                                            <p class="font-bold text-gray-800">{{ $item->nilaiGizi->kalori }} <span class="text-xs font-normal text-gray-500">Kkal</span></p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-500 mb-1">Protein</p>
                                            <p class="font-bold text-green-600">{{ $item->nilaiGizi->protein }} <span class="text-xs font-normal text-green-600/70">g</span></p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-500 mb-1">Karbohidrat</p>
                                            <p class="font-bold text-gray-800">{{ $item->nilaiGizi->karbohidrat }} <span class="text-xs font-normal text-gray-500">g</span></p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-xs text-gray-500 mb-1">Vitamin</p>
                                            <p class="font-bold text-sm text-gray-800 truncate" title="{{ $item->nilaiGizi->vitamin ?? '-' }}">
                                                {{ $item->nilaiGizi->vitamin ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-4 bg-red-50 text-red-600 rounded-lg text-sm mt-4 text-center border border-red-100">
                                        Data gizi belum tersedia.
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full bg-white text-center py-12 rounded-xl border border-gray-200">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <p class="text-gray-500 font-medium">Makanan tidak ditemukan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>