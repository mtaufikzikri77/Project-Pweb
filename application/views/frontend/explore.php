<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Explore Events - Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #121212; color: white; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <nav class="w-full px-10 py-5 flex items-center justify-between border-b border-gray-800 bg-[#121212] sticky top-0 z-50 shadow-md shadow-black/20">
        <a href="<?= base_url('app/home') ?>" class="flex items-center gap-2 cursor-pointer">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-8 h-8 object-contain drop-shadow-[0_0_10px_rgba(217,19,138,0.8)]">
            <span class="text-white font-semibold text-lg tracking-wide">Ticketify</span>
        </a>
        <div class="flex items-center gap-6">
            <a href="<?= base_url('app/history') ?>" class="text-sm font-medium hover:text-[#d9138a] transition">My Tickets</a>
            <a href="<?= base_url('app/home') ?>" class="text-sm font-medium hover:text-[#d9138a] transition">Home</a>
        </div>
    </nav>

    <div class="max-w-[1300px] w-full mx-auto px-6 py-8 flex-grow flex gap-8">
        
        <div class="w-64 flex-shrink-0">
            <div class="bg-[#1a1a1a] border border-[#d9138a] rounded-2xl p-6 sticky top-28">
                <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-2">
                    <h3 class="font-bold text-white">Filters</h3>
                    <a href="<?= base_url('app/explore') ?>" class="text-xs text-[#d9138a] hover:underline">Reset</a>
                </div>

                <form action="<?= base_url('app/explore') ?>" method="GET" id="filterForm">
                    
                    <div class="mb-6">
                        <label class="block text-xs text-gray-400 font-bold mb-3 uppercase tracking-wider">Sorting Harga</label>
                        <select name="sort" onchange="document.getElementById('filterForm').submit()" class="w-full bg-black border border-gray-700 text-sm p-3 rounded-xl text-white outline-none focus:border-[#d9138a]">
                            <option value="terbaru" <?= ($current_sort == 'terbaru' || !$current_sort) ? 'selected' : '' ?>>Event Terbaru</option>
                            <option value="termurah" <?= ($current_sort == 'termurah') ? 'selected' : '' ?>>Termurah ke Termahal</option>
                            <option value="termahal" <?= ($current_sort == 'termahal') ? 'selected' : '' ?>>Termahal ke Termurah</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-xs text-gray-400 font-bold mb-3 uppercase tracking-wider">Kategori</label>
                        <div class="flex flex-wrap gap-2">
                            <label class="cursor-pointer">
                                <input type="radio" name="category" value="All" class="peer sr-only" onchange="document.getElementById('filterForm').submit()" <?= (!isset($current_cat) || $current_cat == 'All') ? 'checked' : '' ?>>
                                <div class="px-4 py-1.5 rounded-full border border-gray-600 text-gray-400 text-xs peer-checked:bg-[#d9138a] peer-checked:text-white peer-checked:border-[#d9138a] transition hover:border-[#d9138a]">Semua</div>
                            </label>
                            <?php if(!empty($categories)): foreach($categories as $cat): ?>
                            <label class="cursor-pointer">
                                <input type="radio" name="category" value="<?= $cat->name ?>" class="peer sr-only" onchange="document.getElementById('filterForm').submit()" <?= (isset($current_cat) && $current_cat == $cat->name) ? 'checked' : '' ?>>
                                <div class="px-4 py-1.5 rounded-full border border-gray-600 text-gray-400 text-xs peer-checked:bg-[#d9138a] peer-checked:text-white peer-checked:border-[#d9138a] transition hover:border-[#d9138a]"><?= $cat->name ?></div>
                            </label>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs text-gray-400 font-bold mb-3 uppercase tracking-wider">Lokasi / Kota</label>
                        <div class="flex flex-wrap gap-2">
                            <label class="cursor-pointer">
                                <input type="radio" name="location" value="All" class="peer sr-only" onchange="document.getElementById('filterForm').submit()" <?= (!isset($current_loc) || $current_loc == 'All') ? 'checked' : '' ?>>
                                <div class="px-4 py-1.5 rounded-full border border-gray-600 text-gray-400 text-xs peer-checked:bg-[#d9138a] peer-checked:text-white peer-checked:border-[#d9138a] transition hover:border-[#d9138a]">Semua Lokasi</div>
                            </label>
                            <?php if(!empty($locations)): foreach($locations as $loc): ?>
                            <label class="cursor-pointer">
                                <input type="radio" name="location" value="<?= $loc->location ?>" class="peer sr-only" onchange="document.getElementById('filterForm').submit()" <?= (isset($current_loc) && $current_loc == $loc->location) ? 'checked' : '' ?>>
                                <div class="px-4 py-1.5 rounded-full border border-gray-600 text-gray-400 text-xs peer-checked:bg-[#d9138a] peer-checked:text-white peer-checked:border-[#d9138a] transition hover:border-[#d9138a]"><?= $loc->location ?></div>
                            </label>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs text-gray-400 font-bold mb-3 uppercase tracking-wider">Status Tiket</label>
                        <div class="flex items-center gap-2 mb-2">
                            <input type="checkbox" name="tersedia" value="1" class="accent-[#d9138a] w-4 h-4 cursor-pointer" onchange="document.getElementById('filterForm').submit()" <?= (isset($tersedia) && $tersedia == '1') ? 'checked' : '' ?>>
                            <span class="text-sm text-gray-300">Tersedia (Sisa > 0)</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex-grow">
            <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-2">
                <h2 class="text-2xl font-bold">Jelajahi Semua Event</h2>
                <span class="text-sm text-gray-400">Menampilkan <?= count($events) ?> hasil</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(!empty($events)): foreach($events as $e): ?>
                    <div class="bg-[#1a1a1a] border border-gray-800 rounded-2xl p-4 hover:border-[#d9138a] hover:-translate-y-1 transition duration-300 cursor-pointer flex flex-col justify-between h-[420px] shadow-lg">
                        <div>
                            <div class="relative w-full h-44 rounded-xl overflow-hidden mb-4 bg-gray-700 group">
                                <img src="<?= base_url('uploads/events/'.$e->image) ?>" onerror="this.src='https://via.placeholder.com/150'" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <div class="absolute top-2 right-2 bg-black/70 px-2 py-1 rounded text-[10px] text-pink-400 font-bold">
                                    <?= isset($e->category_name) ? $e->category_name : 'Umum' ?>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent flex items-end px-3 pb-3">
                                    <span class="text-white text-[10px] font-bold tracking-wider bg-[#d9138a] px-2 py-1 rounded">Sisa: <?= $e->quota ?> Tiket</span>
                                </div>
                            </div>
                            
                            <h3 class="font-bold text-sm mb-1 leading-tight line-clamp-2 h-10"><?= $e->title ?></h3>
                            <p class="text-[10px] text-[#d9138a] mb-2 font-semibold">By: <?= !empty($e->organizer) ? $e->organizer : 'Anonim' ?></p>
                            <p class="text-[10px] text-gray-400 mb-1 flex items-center gap-1">📍 <?= !empty($e->location) ? $e->location : 'Lokasi Belum Ditentukan' ?></p>
                            <p class="text-[10px] text-gray-400 mb-2 flex items-center gap-1">📅 <?= date('d M Y, H:i', strtotime($e->event_date)) ?> WIB</p>
                            <p class="font-bold text-xl text-white">Rp <?= number_format($e->price, 0, ',', '.') ?></p>
                        </div>
                        <a href="<?= base_url('app/detail/'.$e->id) ?>" class="bg-gray-800 text-white rounded-full px-4 py-2 text-xs text-center hover:bg-[#d9138a] transition font-semibold w-full mt-4">
                            Lihat Detail Event
                        </a>
                    </div>
                <?php endforeach; else: ?>
                    <div class="col-span-3 flex flex-col items-center justify-center py-20 text-gray-500 border border-dashed border-gray-700 rounded-2xl">
                        <span class="text-5xl mb-4">🔍</span>
                        <h3 class="text-lg font-bold text-white mb-1">Event Tidak Ditemukan</h3>
                        <p>Tidak ada event yang sesuai dengan filter Anda.</p>
                        <a href="<?= base_url('app/explore') ?>" class="mt-4 text-[#d9138a] hover:underline font-bold text-sm">Reset Filter</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>