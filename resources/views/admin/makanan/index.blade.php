<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Makanan - MBGCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm shrink-0">
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <h1 class="text-2xl font-extrabold text-blue-600 tracking-tight">MBGCheck</h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <a href="/" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda Publik
                </a>

                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6">Mastering Data</p>
                
                <a href="/admin/dashboard" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Dashboard Analitik
                </a>

                <a href="/admin/makanan" class="flex items-center px-2 py-2.5 bg-blue-50 text-blue-700 rounded-lg group font-medium">
                    <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Data Makanan
                </a>

                <a href="/admin/jadwal-menu" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Jadwal Menu
                </a>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <a href="/logout" class="flex items-center px-2 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout ({{ session('admin_nama') }})
                </a>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm shrink-0">
                <h2 class="text-xl font-semibold text-gray-800">Manajemen Data Makanan</h2>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-6xl mx-auto">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Daftar Menu Tersedia</h3>
                        <div class="flex gap-3">
                            <button onclick="exportWithFilters()" class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 font-medium transition-colors shadow-sm flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Ekspor Laporan
                            </button>
                            <a href="/admin/makanan/create" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 font-medium transition-colors shadow-sm flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Makanan
                            </a>
                        </div>
                    </div>

                    <!-- Form Filter -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Filter Data Makanan</h4>
                        <form method="GET" action="/admin/makanan" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kalori Min</label>
                                <input type="number" name="kalori_min" value="{{ request('kalori_min') }}" placeholder="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kalori Max</label>
                                <input type="number" name="kalori_max" value="{{ request('kalori_max') }}" placeholder="1000" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Protein Min</label>
                                <input type="number" name="protein_min" value="{{ request('protein_min') }}" placeholder="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Protein Max</label>
                                <input type="number" name="protein_max" value="{{ request('protein_max') }}" placeholder="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2 lg:col-span-5 flex gap-2">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium transition-colors">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                    Filter
                                </button>
                                <a href="/admin/makanan" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 font-medium transition-colors">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-sm text-gray-600 uppercase tracking-wider">
                                    <th class="p-4 font-semibold text-center w-12">No</th>
                                    <th class="p-4 font-semibold">Nama Makanan</th>
                                    <th class="p-4 font-semibold">Kategori</th>
                                    <th class="p-4 font-semibold text-center">Kalori</th>
                                    <th class="p-4 font-semibold text-center">Protein</th>
                                    <th class="p-4 font-semibold text-center">Resep</th>
                                    <th class="p-4 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-gray-800">
                                @forelse($makanans as $index => $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="p-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                        <td class="p-4 font-medium">{{ $item->nama_makanan }}</td>
                                        <td class="p-4">
                                            <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full text-xs font-medium">
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-center">{{ $item->nilaiGizi->kalori ?? '-' }} Kkal</td>
                                        <td class="p-4 text-center text-green-600 font-medium">{{ $item->nilaiGizi->protein ?? '-' }} g</td>
                                        <td class="p-4 text-center" id="resep-status-{{ $item->id_makanan }}">
                                            @if($item->resep && $item->resep->bahan_bahan)
                                                <span class="bg-green-50 text-green-700 px-2.5 py-1 rounded-full text-xs font-medium">✓ Ada</span>
                                            @else
                                                <span class="bg-red-50 text-red-500 px-2.5 py-1 rounded-full text-xs font-medium">✗ Kosong</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-center">
                                            <div class="flex justify-center gap-1">
                                                <button onclick="generateResep({{ $item->id_makanan }}, '{{ addslashes($item->nama_makanan) }}')" 
                                                        id="btn-ai-{{ $item->id_makanan }}"
                                                        class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors group" 
                                                        title="Generate Resep dengan AI">
                                                    <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                                </button>
                                                <a href="/makanan/{{ $item->id_makanan }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="p-8 text-center text-gray-500">
                                            Belum ada data makanan. Silakan tambahkan data baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </main>
    </div>

{{-- MODAL HASIL AI --}}
<div id="aiModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[80vh] overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div>
                <h3 class="text-lg font-bold text-gray-800" id="modalTitle">Resep AI</h3>
                <p class="text-sm text-gray-500">Dihasilkan oleh Gemini AI</p>
            </div>
            <button onclick="closeModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[60vh]">
            <pre id="modalContent" class="whitespace-pre-wrap text-sm text-gray-700 leading-relaxed font-sans"></pre>
        </div>
    </div>
</div>

<script>
function generateResep(id, nama) {
    if (!confirm('Generate resep untuk "' + nama + '" menggunakan AI?')) return;

    const btn = document.getElementById('btn-ai-' + id);
    const statusEl = document.getElementById('resep-status-' + id);
    const originalBtn = btn.innerHTML;

    // Loading state
    btn.disabled = true;
    btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>';
    statusEl.innerHTML = '<span class="bg-purple-50 text-purple-600 px-2.5 py-1 rounded-full text-xs font-medium animate-pulse">⏳ Generating...</span>';

    fetch('/admin/makanan/' + id + '/generate-resep', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = originalBtn;

        if (data.success) {
            statusEl.innerHTML = '<span class="bg-green-50 text-green-700 px-2.5 py-1 rounded-full text-xs font-medium">✓ Ada</span>';
            document.getElementById('modalTitle').textContent = 'Resep: ' + data.nama_makanan;
            document.getElementById('modalContent').textContent = data.resep;
            document.getElementById('aiModal').classList.remove('hidden');
            document.getElementById('aiModal').classList.add('flex');
        } else {
            statusEl.innerHTML = '<span class="bg-red-50 text-red-500 px-2.5 py-1 rounded-full text-xs font-medium">✗ Gagal</span>';
            alert('Gagal: ' + (data.error || 'Terjadi kesalahan'));
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = originalBtn;
        statusEl.innerHTML = '<span class="bg-red-50 text-red-500 px-2.5 py-1 rounded-full text-xs font-medium">✗ Error</span>';
        alert('Error: ' + err.message);
    });
}

function closeModal() {
    document.getElementById('aiModal').classList.add('hidden');
    document.getElementById('aiModal').classList.remove('flex');
}

// Close modal on backdrop click
document.getElementById('aiModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

function exportWithFilters() {
    const urlParams = new URLSearchParams(window.location.search);
    const exportUrl = '/admin/makanan/export?' + urlParams.toString();
    window.location.href = exportUrl;
}
</script>

</body>
</html>