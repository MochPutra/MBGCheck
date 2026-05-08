<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Makanan - MBGCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm shrink-0">
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <h1 class="text-2xl font-extrabold text-blue-600 tracking-tight">MBGCheck</h1>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <p class="px-2 text-xs font-semibold text-gray-400 uppercase mb-2">Menu Utama</p>
                <a href="/" class="flex items-center px-2 py-2.5 text-gray-600 hover:bg-gray-100 rounded-lg group">
                    Beranda Publik
                </a>
                <p class="px-2 text-xs font-semibold text-gray-400 uppercase mb-2 mt-6">Mastering Data</p>
                <a href="/admin/makanan" class="flex items-center px-2 py-2.5 bg-blue-50 text-blue-700 rounded-lg font-medium">
                    Data Makanan
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center px-8 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Data Makanan Baru</h2>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-3xl mx-auto">
                    
                    <a href="/admin/makanan" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 mb-6 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Kembali ke Daftar
                    </a>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <form action="/admin/makanan" method="POST" class="p-8">
                            @csrf <div class="mb-8">
                                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Makanan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Makanan</label>
                                        <input type="text" name="nama_makanan" required placeholder="Contoh: Ayam Bakar Madu" 
                                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                        <select name="kategori" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                            <option value="Makanan Pokok">Makanan Pokok</option>
                                            <option value="Lauk Pauk">Lauk Pauk</option>
                                            <option value="Sayuran">Sayuran</option>
                                            <option value="Buah-buahan">Buah-buahan</option>
                                            <option value="Susu">Susu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Nilai Gizi (Per Porsi)</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kalori (Kkal)</label>
                                        <input type="number" name="kalori" required placeholder="0" 
                                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Protein (g)</label>
                                        <input type="number" step="0.01" name="protein" required placeholder="0" 
                                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Karbo (g)</label>
                                        <input type="number" step="0.01" name="karbohidrat" required placeholder="0" 
                                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Vitamin</label>
                                        <input type="text" name="vitamin" placeholder="A, B12, dll" 
                                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3 mt-4">
                                <button type="reset" class="px-6 py-2.5 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition-colors">
                                    Reset
                                </button>
                                <button type="submit" class="px-10 py-2.5 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-md transition-all">
                                    Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>