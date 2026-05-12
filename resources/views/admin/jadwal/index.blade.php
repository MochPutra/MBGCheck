<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Menu Mingguan - MBGCheck</title>
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

                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6">Manajemen Menu</p>
                
                <a href="/admin/dashboard" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Dashboard Analitik
                </a>

                <a href="/admin/makanan" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 hover:text-blue-600 rounded-lg group transition-colors">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Data Makanan
                </a>

                <a href="/admin/jadwal-menu" class="flex items-center px-2 py-2.5 bg-blue-50 text-blue-700 rounded-lg group font-medium">
                    <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
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
                <h2 class="text-xl font-semibold text-gray-800">Jadwal Menu Mingguan</h2>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-6xl mx-auto">
                    
                    <!-- Alert Messages -->
                    @if ($message = Session::get('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                            <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Form tambah menu -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-8 max-h-[calc(100vh-150px)] overflow-y-auto">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Menu</h3>
                                <form method="POST" action="/admin/jadwal-menu" id="formMenu" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Hari</label>
                                        <select name="hari" id="hariSelect" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">-- Pilih Hari --</option>
                                            @foreach($haris as $hari)
                                                <option value="{{ $hari }}">{{ $hari }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="foodItemsContainer" class="space-y-3 max-h-60 overflow-y-auto">
                                        <div class="food-item bg-gray-50 p-3 rounded-lg space-y-3">
                                            <div class="flex items-center justify-between">
                                                <label class="block text-sm font-medium text-gray-700">Makanan #1</label>
                                                <button type="button" class="text-xs text-red-500 hover:text-red-700 remove-item-btn" style="display: none;">Hapus</button>
                                            </div>

                                            <div class="relative">
                                                <input type="hidden" name="id_makanan_pilih[]" value="" class="id-makanan-pilih">
                                                <input type="text" name="nama_makanan[]" placeholder="Ketik nama makanan..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 food-search text-sm" required autocomplete="off">
                                                <small class="text-gray-400 text-xs">Pencarian atau custom</small>
                                                <ul class="food-results absolute bg-white border border-gray-300 rounded-lg max-h-32 overflow-y-auto w-full hidden z-20 hidden" style="display: none;"></ul>
                                            </div>

                                            <div class="grid grid-cols-2 gap-1 text-sm">
                                                <div>
                                                    <label class="text-xs text-gray-600">Kalori</label>
                                                    <input type="number" name="kalori[]" placeholder="0" step="0.01" class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-600">Protein</label>
                                                    <input type="number" name="protein[]" placeholder="0" step="0.01" class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-600">Karbo</label>
                                                    <input type="number" name="karbohidrat[]" placeholder="0" step="0.01" class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-600">Vitamin</label>
                                                    <input type="text" name="vitamin[]" placeholder="A,B,C..." class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="minggu" value="{{ $minggu }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">

                                    <button type="button" id="addItemBtn" class="w-full bg-gray-300 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-400 font-medium transition-colors text-sm flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        Tambah Makanan
                                    </button>

                                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium transition-colors">
                                        Simpan Menu
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Jadwal mingguan -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6 border-b border-gray-200">
                                    <h3 class="text-lg font-bold text-gray-800">Menu Minggu {{ $minggu }}, {{ $tahun }}</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                                    @foreach($haris as $hari)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                            <h4 class="font-semibold text-gray-800 mb-3 text-center">{{ $hari }}</h4>
                                            
                                            @if(isset($jadwalMenus[$hari]) && count($jadwalMenus[$hari]) > 0)
                                                @foreach($jadwalMenus[$hari] as $jadwal)
                                                    <div class="bg-blue-50 p-3 rounded-lg mb-2">
                                                        <p class="text-sm font-medium text-gray-800">
                                                            {{ $jadwal->nama_makanan_custom ?? ($jadwal->makanan->nama_makanan ?? 'N/A') }}
                                                        </p>
                                                        @if($jadwal->makanan)
                                                            <p class="text-xs text-gray-600 mt-1">
                                                                Kategori: {{ $jadwal->makanan->kategori }}
                                                            </p>
                                                        @endif
                                                        
                                                        @php
                                                            $kalori = $jadwal->kalori_custom ?? ($jadwal->makanan->nilaiGizi->kalori ?? null);
                                                            $protein = $jadwal->protein_custom ?? ($jadwal->makanan->nilaiGizi->protein ?? null);
                                                            $karbo = $jadwal->karbohidrat_custom ?? ($jadwal->makanan->nilaiGizi->karbohidrat ?? null);
                                                            $vitamin = $jadwal->vitamin_custom ?? ($jadwal->makanan->nilaiGizi->vitamin ?? null);
                                                        @endphp
                                                        
                                                        @if($kalori || $protein || $karbo || $vitamin)
                                                            <div class="text-xs text-gray-600 mt-2 space-y-0.5">
                                                                @if($kalori)
                                                                    <p>Kalori: {{ $kalori }} Kkal</p>
                                                                @endif
                                                                @if($protein)
                                                                    <p>Protein: {{ $protein }} g</p>
                                                                @endif
                                                                @if($karbo)
                                                                    <p>Karbo: {{ $karbo }} g</p>
                                                                @endif
                                                                @if($vitamin)
                                                                    <p>Vitamin: {{ $vitamin }}</p>
                                                                @endif
                                                            </div>
                                                        @endif
                                                        
                                                        <form method="POST" action="/admin/jadwal-menu/{{ $jadwal->id_jadwal }}" class="mt-2" onsubmit="return confirm('Yakin akan menghapus menu ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-medium">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center py-4">
                                                    <p class="text-gray-400 text-sm">Belum ada menu</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

    </div>

    <script>
        const makananList = {!! json_encode($makanans->map(function($m) {
            return [
                'id' => $m->id_makanan,
                'text' => $m->nama_makanan . ' (' . $m->kategori . ')',
                'kalori' => $m->nilaiGizi->kalori ?? 0,
                'protein' => $m->nilaiGizi->protein ?? 0,
                'karbohidrat' => $m->nilaiGizi->karbohidrat ?? 0,
                'vitamin' => $m->nilaiGizi->vitamin ?? '-',
            ];
        })) !!};

        let itemCount = 1;

        function initFoodSearch(container) {
            const input = container.querySelector('.food-search');
            const resultsList = container.querySelector('.food-results');

            const hiddenId = container.querySelector('.id-makanan-pilih');

            input.addEventListener('input', function() {
                if (hiddenId) hiddenId.value = '';
                const query = this.value.toLowerCase().trim();
                if (query.length === 0) {
                    resultsList.style.display = 'none';
                    return;
                }

                const filtered = makananList.filter(m => m.text.toLowerCase().includes(query));
                
                if (filtered.length === 0) {
                    resultsList.style.display = 'none';
                    return;
                }

                resultsList.innerHTML = filtered.map(m => 
                    `<li class="px-3 py-2 cursor-pointer hover:bg-blue-50 border-b text-sm" data-id="${m.id}" data-name="${m.text}" data-kalori="${m.kalori}" data-protein="${m.protein}" data-karbohidrat="${m.karbohidrat}" data-vitamin="${m.vitamin}">
                        ${m.text}
                    </li>`
                ).join('');
                
                resultsList.style.display = 'block';

                resultsList.querySelectorAll('li').forEach(li => {
                    li.addEventListener('click', function() {
                        input.value = this.dataset.name;
                        if (hiddenId) hiddenId.value = this.dataset.id;
                        
                        // Auto-fill nutrition if empty
                        const kaloriInput = container.querySelector('input[name="kalori[]"]');
                        if (!kaloriInput.value) kaloriInput.value = this.dataset.kalori;
                        
                        const proteinInput = container.querySelector('input[name="protein[]"]');
                        if (!proteinInput.value) proteinInput.value = this.dataset.protein;
                        
                        const karboInput = container.querySelector('input[name="karbohidrat[]"]');
                        if (!karboInput.value) karboInput.value = this.dataset.karbohidrat;
                        
                        const vitaminInput = container.querySelector('input[name="vitamin[]"]');
                        if (!vitaminInput.value) vitaminInput.value = this.dataset.vitamin;
                        
                        resultsList.style.display = 'none';
                    });
                });
            });

            input.addEventListener('blur', function() {
                setTimeout(() => {
                    resultsList.style.display = 'none';
                }, 200);
            });
        }

        document.getElementById('foodItemsContainer').querySelectorAll('.food-item').forEach(item => {
            initFoodSearch(item);
        });

        document.getElementById('addItemBtn').addEventListener('click', function() {
            itemCount++;
            const newItem = document.createElement('div');
            newItem.className = 'food-item bg-gray-50 p-3 rounded-lg space-y-3';
            newItem.innerHTML = `
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-medium text-gray-700">Makanan #${itemCount}</label>
                    <button type="button" class="text-xs text-red-500 hover:text-red-700 remove-item-btn">Hapus</button>
                </div>

                <div class="relative">
                    <input type="hidden" name="id_makanan_pilih[]" value="" class="id-makanan-pilih">
                    <input type="text" name="nama_makanan[]" placeholder="Ketik nama makanan..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 food-search text-sm" required autocomplete="off">
                    <small class="text-gray-400 text-xs">Pencarian atau custom</small>
                    <ul class="food-results absolute bg-white border border-gray-300 rounded-lg max-h-32 overflow-y-auto w-full hidden z-20" style="display: none;"></ul>
                </div>

                <div class="grid grid-cols-2 gap-1 text-sm">
                    <div>
                        <label class="text-xs text-gray-600">Kalori</label>
                        <input type="number" name="kalori[]" placeholder="0" step="0.01" class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                    </div>
                    <div>
                        <label class="text-xs text-gray-600">Protein</label>
                        <input type="number" name="protein[]" placeholder="0" step="0.01" class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                    </div>
                    <div>
                        <label class="text-xs text-gray-600">Karbo</label>
                        <input type="number" name="karbohidrat[]" placeholder="0" step="0.01" class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                    </div>
                    <div>
                        <label class="text-xs text-gray-600">Vitamin</label>
                        <input type="text" name="vitamin[]" placeholder="A,B,C..." class="w-full px-2 py-1 text-xs border border-gray-300 rounded">
                    </div>
                </div>
            `;
            
            document.getElementById('foodItemsContainer').appendChild(newItem);
            initFoodSearch(newItem);

            newItem.querySelector('.remove-item-btn').addEventListener('click', function(e) {
                e.preventDefault();
                newItem.remove();
                updateRemoveButtons();
            });

            updateRemoveButtons();
        });

        function updateRemoveButtons() {
            const items = document.querySelectorAll('.food-item');
            items.forEach((item, index) => {
                const btn = item.querySelector('.remove-item-btn');
                const label = item.querySelector('label');
                label.textContent = `Makanan #${index + 1}`;
                if (items.length > 1) {
                    btn.style.display = 'inline-block';
                } else {
                    btn.style.display = 'none';
                }
            });
        }

        document.querySelectorAll('.remove-item-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                this.closest('.food-item').remove();
                updateRemoveButtons();
            });
        });
    </script>

</body>
</html>
