<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Menu Mingguan - MBGCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['system-ui', 'Segoe UI', 'sans-serif'] },
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

@php
    $dayThemes = [
        'Senin'    => ['from' => 'from-sky-600', 'to' => 'to-blue-700', 'badge' => 'bg-sky-50 text-sky-800'],
        'Selasa'   => ['from' => 'from-violet-600', 'to' => 'to-purple-700', 'badge' => 'bg-violet-50 text-violet-800'],
        'Rabu'     => ['from' => 'from-emerald-600', 'to' => 'to-teal-700', 'badge' => 'bg-emerald-50 text-emerald-800'],
        'Kamis'    => ['from' => 'from-amber-500', 'to' => 'to-orange-600', 'badge' => 'bg-amber-50 text-amber-900'],
        'Jumat'    => ['from' => 'from-rose-600', 'to' => 'to-pink-700', 'badge' => 'bg-rose-50 text-rose-800'],
        'Sabtu'    => ['from' => 'from-indigo-600', 'to' => 'to-indigo-800', 'badge' => 'bg-indigo-50 text-indigo-800'],
        'Minggu'   => ['from' => 'from-cyan-600', 'to' => 'to-cyan-800', 'badge' => 'bg-cyan-50 text-cyan-900'],
    ];
    $totalMenu = collect($haris)->sum(fn ($h) => isset($jadwalMenus[$h]) ? $jadwalMenus[$h]->count() : 0);
@endphp

<div class="flex min-h-screen">

    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col shadow-sm shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-slate-200">
            <a href="/" class="text-2xl font-extrabold text-blue-600 tracking-tight">MBGCheck</a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Area Publik</p>
            <a href="/" class="flex items-center px-2 py-2.5 text-slate-600 hover:bg-slate-100 hover:text-blue-600 rounded-lg group transition-colors">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Cari Makanan
            </a>
            <a href="/dashboard" class="flex items-center px-2 py-2.5 text-slate-600 hover:bg-slate-100 hover:text-blue-600 rounded-lg group transition-colors">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Dashboard Analitik
            </a>
            <a href="/jadwal-menu" class="flex items-center px-2 py-2.5 bg-blue-50 text-blue-700 rounded-lg group font-medium">
                <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Jadwal Menu
            </a>
            <a href="/kalkulator" class="flex items-center px-2 py-2.5 text-slate-600 hover:bg-slate-100 hover:text-blue-600 rounded-lg group transition-colors">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Kalkulator Gizi
            </a>

            @if(session('is_admin'))
                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Manajemen (Admin)</p>
                <a href="/admin/makanan" class="flex items-center px-2 py-2.5 text-slate-600 hover:bg-slate-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Kelola Data Makanan
                </a>
            @endif
        </nav>
        <div class="p-4 border-t border-slate-200">
            @if(session('is_admin'))
                <a href="/logout" class="flex items-center px-2 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </a>
            @else
                <a href="/login" class="flex items-center px-2 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    Login Admin
                </a>
            @endif
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-h-screen overflow-hidden">
        <header class="h-16 bg-white/90 backdrop-blur border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 shadow-sm shrink-0 z-10">
            <h2 class="text-lg font-semibold text-slate-800">Jadwal Menu Mingguan</h2>
            <span class="hidden sm:inline text-sm text-slate-500">Program Makan Bergizi Gratis</span>
        </header>

        <div class="flex-1 overflow-y-auto">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-8 pb-16">

                {{-- Hero --}}
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-indigo-600 to-violet-700 text-white shadow-xl shadow-indigo-500/25 mb-10">
                    <div class="absolute inset-0 opacity-[0.12]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                    <div class="relative px-8 py-10 lg:px-12 lg:py-12 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
                        <div class="max-w-xl">
                            <p class="text-blue-100 text-sm font-semibold tracking-wide uppercase mb-2">Transparansi menu sekolah</p>
                            <h1 class="text-3xl lg:text-4xl font-extrabold tracking-tight mb-3">Apa saja menu minggu ini?</h1>
                            <p class="text-blue-100/95 text-base leading-relaxed">
                                Lihat jadwal makanan yang telah disusun untuk minggu berjalan. Informasi gizi membantu memahami asupan harian siswa.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-3 lg:justify-end">
                            <div class="rounded-2xl bg-white/15 backdrop-blur border border-white/20 px-5 py-4 min-w-[140px]">
                                <p class="text-blue-100 text-xs font-medium uppercase tracking-wider">Minggu ke</p>
                                <p class="text-3xl font-black tabular-nums">{{ $minggu }}</p>
                            </div>
                            <div class="rounded-2xl bg-white/15 backdrop-blur border border-white/20 px-5 py-4 min-w-[140px]">
                                <p class="text-blue-100 text-xs font-medium uppercase tracking-wider">Tahun</p>
                                <p class="text-3xl font-black tabular-nums">{{ $tahun }}</p>
                            </div>
                            <div class="rounded-2xl bg-white/15 backdrop-blur border border-white/20 px-5 py-4 min-w-[140px]">
                                <p class="text-blue-100 text-xs font-medium uppercase tracking-wider">Total hidangan</p>
                                <p class="text-3xl font-black tabular-nums">{{ $totalMenu }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Grid hari --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
                    @foreach($haris as $hari)
                        @php
                            $theme = $dayThemes[$hari] ?? ['from' => 'from-slate-600', 'to' => 'to-slate-800', 'badge' => 'bg-slate-100 text-slate-800'];
                            $menuHari = isset($jadwalMenus[$hari]) ? $jadwalMenus[$hari] : collect();
                        @endphp
                        <article class="group flex flex-col rounded-2xl bg-white border border-slate-200/80 shadow-sm hover:shadow-lg hover:shadow-slate-200/60 hover:-translate-y-0.5 hover:ring-2 hover:ring-blue-100/80 transition-all duration-300 overflow-hidden">
                            <div class="bg-gradient-to-r {{ $theme['from'] }} {{ $theme['to'] }} px-5 py-4 flex items-center justify-between">
                                <h3 class="text-lg font-bold text-white tracking-tight">{{ $hari }}</h3>
                                <span class="text-white/90 text-xs font-semibold bg-black/10 rounded-full px-2.5 py-1">
                                    {{ $menuHari->count() }} menu
                                </span>
                            </div>

                            <div class="p-5 flex-1 flex flex-col gap-4">
                                @forelse($menuHari as $jadwal)
                                    @php
                                        $nama = $jadwal->nama_makanan_custom ?? optional($jadwal->makanan)->nama_makanan ?? 'Menu';
                                        $m = $jadwal->makanan;
                                        $kalori = $jadwal->kalori_custom ?? optional(optional($m)->nilaiGizi)->kalori;
                                        $protein = $jadwal->protein_custom ?? optional(optional($m)->nilaiGizi)->protein;
                                        $karbo = $jadwal->karbohidrat_custom ?? optional(optional($m)->nilaiGizi)->karbohidrat;
                                        $vitamin = $jadwal->vitamin_custom ?? optional(optional($m)->nilaiGizi)->vitamin;
                                    @endphp
                                    <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4 hover:bg-white hover:border-slate-200 transition-colors">
                                        <div class="flex items-start justify-between gap-2 mb-2">
                                            <h4 class="font-bold text-slate-900 leading-snug">{{ $nama }}</h4>
                                            @if($m && $m->kategori)
                                                <span class="shrink-0 text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-md {{ $theme['badge'] }}">
                                                    {{ $m->kategori }}
                                                </span>
                                            @elseif($jadwal->nama_makanan_custom)
                                                <span class="shrink-0 text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-md bg-slate-200 text-slate-700">Kustom</span>
                                            @endif
                                        </div>

                                        @if($kalori || $protein || $karbo || $vitamin)
                                            <div class="flex flex-wrap gap-1.5 mt-3">
                                                @if($kalori)
                                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-orange-800 bg-orange-100/90 px-2 py-1 rounded-lg">{{ $kalori }} <span class="font-normal opacity-80">Kkal</span></span>
                                                @endif
                                                @if($protein)
                                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-800 bg-emerald-100/90 px-2 py-1 rounded-lg">{{ $protein }}g protein</span>
                                                @endif
                                                @if($karbo)
                                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-blue-800 bg-blue-100/90 px-2 py-1 rounded-lg">{{ $karbo }}g karbo</span>
                                                @endif
                                                @if($vitamin)
                                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-slate-700 bg-slate-200/80 px-2 py-1 rounded-lg max-w-full truncate" title="{{ $vitamin }}">Vit. {{ \Illuminate\Support\Str::limit($vitamin, 24) }}</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if($m)
                                            <a href="/makanan/{{ $m->id_makanan }}" class="inline-flex items-center gap-1 mt-3 text-xs font-semibold text-blue-600 hover:text-blue-800 group/link">
                                                Lihat detail & resep
                                                <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        @endif
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-10 text-center flex-1">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-3 text-slate-300">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <p class="text-sm font-medium text-slate-500">Belum ada menu</p>
                                        <p class="text-xs text-slate-400 mt-1 max-w-[200px]">Admin dapat menambahkan menu di panel jadwal.</p>
                                    </div>
                                @endforelse
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10 rounded-2xl border border-blue-100 bg-gradient-to-r from-blue-50 to-indigo-50/80 px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <p class="text-sm text-slate-700">
                        <span class="font-semibold text-blue-900">Catatan:</span> komposisi dapat disesuaikan kebijakan dapur. Untuk pencarian lengkap database makanan, gunakan halaman Cari Makanan.
                    </p>
                    <a href="/" class="shrink-0 inline-flex justify-center items-center gap-2 rounded-xl bg-blue-600 text-white text-sm font-semibold px-5 py-2.5 shadow-md shadow-blue-600/20 hover:bg-blue-700 transition-colors">
                        Cari makanan di database
                    </a>
                </div>

            </div>
        </div>
    </main>
</div>

</body>
</html>
