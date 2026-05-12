<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $makanan->nama_makanan }} - MBGCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <div class="min-h-screen flex flex-col">
        
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 py-4 px-6 sticky top-0 z-50">
            <div class="max-w-5xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-blue-600 text-white p-1.5 rounded-lg shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">MBG<span class="text-blue-600">Check</span></h1>
                </div>
                <a href="/" class="flex items-center text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors bg-slate-100 hover:bg-blue-50 px-4 py-2 rounded-full">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>
        </header>

        <main class="flex-1 py-10 px-6">
            <div class="max-w-5xl mx-auto">
                
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    
                    <div class="relative bg-gradient-to-br from-blue-50 via-indigo-50/40 to-white p-10 border-b border-slate-100">
                        <div class="relative flex items-start justify-between">
                            <div>
                                <span class="inline-flex items-center gap-1.5 bg-white text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm border border-blue-100 mb-4 tracking-wide uppercase">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    {{ $makanan->kategori }}
                                </span>
                                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">{{ $makanan->nama_makanan }}</h2>
                                <p class="text-slate-500 mt-2 font-medium">Informasi rincian nutrisi dan komposisi bahan per porsi.</p>
                            </div>
                            <div class="hidden sm:flex h-20 w-20 bg-white rounded-2xl shadow-sm border border-slate-100 items-center justify-center text-4xl">
                                🍽️
                            </div>
                        </div>
                    </div>

                    <div class="p-10 grid grid-cols-1 lg:grid-cols-12 gap-10">
                        
                        <div class="lg:col-span-7 space-y-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="bg-green-100 p-2 rounded-lg text-green-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800">Kandungan Gizi</h3>
                            </div>
                            
                            @if($makanan->nilaiGizi)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    
                                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm relative overflow-hidden group">
                                        <div class="absolute right-0 top-0 w-16 h-16 bg-orange-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                                        <p class="text-sm font-semibold text-slate-500 mb-1 relative z-10">Kalori Total</p>
                                        <div class="flex items-end gap-2 relative z-10">
                                            <span class="text-3xl font-extrabold text-slate-800">{{ $makanan->nilaiGizi->kalori }}</span>
                                            <span class="text-orange-500 font-bold mb-1">Kkal</span>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm relative overflow-hidden group">
                                        <div class="absolute right-0 top-0 w-16 h-16 bg-green-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                                        <p class="text-sm font-semibold text-slate-500 mb-1 relative z-10">Protein</p>
                                        <div class="flex items-end gap-2 relative z-10">
                                            <span class="text-3xl font-extrabold text-slate-800">{{ $makanan->nilaiGizi->protein }}</span>
                                            <span class="text-green-600 font-bold mb-1">g</span>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm relative overflow-hidden group">
                                        <div class="absolute right-0 top-0 w-16 h-16 bg-yellow-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                                        <p class="text-sm font-semibold text-slate-500 mb-1 relative z-10">Karbohidrat</p>
                                        <div class="flex items-end gap-2 relative z-10">
                                            <span class="text-3xl font-extrabold text-slate-800">{{ $makanan->nilaiGizi->karbohidrat }}</span>
                                            <span class="text-yellow-600 font-bold mb-1">g</span>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2 bg-slate-50 rounded-2xl p-5 border border-slate-200 mt-2">
                                        <div class="flex items-start gap-3">
                                            <div class="bg-blue-100 p-2 rounded-lg text-blue-600 shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-500 mb-1">Nutrisi Lainnya</p>
                                                <p class="font-bold text-slate-800 leading-relaxed">{{ $makanan->nilaiGizi->vitamin ?? 'Tidak ada data' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center p-8 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 text-center">
                                    <div class="bg-red-100 text-red-500 p-3 rounded-full mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                    <p class="text-slate-600 font-medium">Data gizi belum diinput.</p>
                                </div>
                            @endif
                        </div>

                        <div class="lg:col-span-5">
                            <div class="bg-amber-50/50 rounded-3xl p-8 border border-amber-100 h-full">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="bg-amber-100 p-2 rounded-lg text-amber-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-800">Bahan-bahan</h3>
                                </div>
                                
                                @if($makanan->resep && $makanan->resep->bahan_bahan)
                                    <div class="text-slate-700 whitespace-pre-wrap leading-relaxed">
                                        {{ $makanan->resep->bahan_bahan }}
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center py-10 text-center">
                                        <svg class="w-16 h-16 text-amber-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                        <p class="text-amber-800/60 font-medium">Informasi bahan makanan<br>belum tersedia.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>