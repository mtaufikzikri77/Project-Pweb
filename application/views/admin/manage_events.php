<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Event - Admin Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #121212; color: white; font-family: 'Inter', sans-serif; }</style>
</head>
<body class="p-8">
    <div class="max-w-5xl mx-auto">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-[#d9138a]">Kelola Event</h1>
            <div class="flex items-center gap-3">
                <a href="<?= base_url('app/home') ?>" class="border border-gray-500 text-gray-300 px-4 py-2 rounded-full text-sm hover:bg-gray-800 hover:text-white transition">Kembali ke Home</a>
                <a href="<?= base_url('admin') ?>" class="border border-white text-white px-4 py-2 rounded-full text-sm hover:bg-white hover:text-black transition">Kembali ke Dashboard</a>
            </div>
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-500/20 text-green-400 p-4 rounded-lg mb-6 border border-green-500 text-sm">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="bg-[#1a1a1a] border border-gray-800 rounded-xl p-6 mb-10 shadow-lg">
            <h2 class="text-xl font-bold text-white mb-6">Buat Event Baru</h2>
            
            <form action="<?= base_url('admin/add_event') ?>" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Judul Event</label>
                        <input type="text" name="title" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]" required>
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Pihak Penyelenggara / Organizer</label>
                        <input type="text" name="organizer" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]" placeholder="Cth: Vipers Syndicate" required>
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Kategori Event</label>
                        <select name="category_id" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <?php if(!empty($categories)): foreach($categories as $cat): ?>
                                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Lokasi Penyelenggaraan</label>
                        <input type="text" name="location" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]" required>
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Tanggal & Waktu</label>
                        <input type="datetime-local" name="event_date" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a] [color-scheme:dark]" required>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="text-xs text-gray-400 mb-1 block">Harga (Rp)</label>
                            <input type="number" name="price" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]" required>
                        </div>
                        <div class="w-1/2">
                            <label class="text-xs text-gray-400 mb-1 block">Kuota Tiket</label>
                            <input type="number" name="quota" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]" required>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="text-xs text-gray-400 mb-1 block">Deskripsi Event</label>
                    <textarea name="description" rows="3" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]"></textarea>
                </div>

                <div class="mb-6">
                    <label class="text-xs text-gray-400 mb-1 block">Upload Banner/Poster Event</label>
                    <input type="file" name="image" accept="image/*" class="w-full bg-black border border-gray-700 text-white rounded p-2 outline-none focus:border-[#d9138a] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#d9138a] file:text-white hover:file:bg-pink-600 cursor-pointer" required>
                </div>

                <button type="submit" class="w-full bg-[#d9138a] hover:bg-pink-700 text-white font-bold py-3 rounded-lg transition">Simpan Event ke Database</button>
            </form>
        </div>

        <div class="bg-[#1a1a1a] border border-gray-800 rounded-xl overflow-hidden shadow-lg">
            <div class="p-6 border-b border-gray-800">
                <h2 class="text-xl font-bold text-white">Daftar Event</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-black/50 text-gray-400">
                        <tr>
                            <th class="p-4">Gambar</th>
                            <th class="p-4">Judul & Organizer</th>
                            <th class="p-4">Lokasi & Kategori</th>
                            <th class="p-4">Harga & Kuota</th>
                            <th class="p-4">Status Utama</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        <?php if(!empty($events)): foreach($events as $e): ?>
                        <tr class="hover:bg-gray-800/50">
                            <td class="p-4">
                                <img src="<?= base_url('uploads/events/'.$e->image) ?>" class="w-16 h-12 object-cover rounded" onerror="this.src='https://via.placeholder.com/150'">
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-white block truncate w-48"><?= $e->title ?></span>
                                <span class="text-xs font-semibold text-[#d9138a] block mt-1">By: <?= !empty($e->organizer) ? $e->organizer : 'Anonim' ?></span>
                            </td>
                            <td class="p-4">
                                <span class="text-[#d9138a] text-xs border border-[#d9138a] px-2 py-0.5 rounded-full mb-1 inline-block"><?= isset($e->category_name) ? $e->category_name : 'Kategori' ?></span>
                                <span class="block text-xs text-gray-400 mt-1 truncate w-32">📍 <?= $e->location ?></span>
                            </td>
                            <td class="p-4">
                                <span class="text-green-400 font-bold block">Rp <?= number_format($e->price,0,',','.') ?></span>
                                <span class="text-xs text-gray-400">Sisa: <?= $e->quota ?></span>
                            </td>
                            <td class="p-4">
                                <?php if($e->is_main_event == 1): ?>
                                    <span class="bg-yellow-500 text-black text-xs font-bold px-2 py-1 rounded">Main Event</span>
                                <?php else: ?>
                                    <span class="text-gray-500 text-xs">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 flex justify-center gap-2">
                                <a href="<?= base_url('admin/edit_event/'.$e->id) ?>" class="border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white px-3 py-1 rounded text-xs transition">Edit</a>
                                
                                <?php if($e->is_main_event == 0): ?>
                                    <a href="<?= base_url('admin/set_main_event/'.$e->id) ?>" class="border border-green-500 text-green-500 hover:bg-green-500 hover:text-white px-3 py-1 rounded text-xs transition">Jadikan Utama</a>
                                <?php else: ?>
                                    <a href="<?= base_url('admin/cancel_main_event/'.$e->id) ?>" class="border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-black px-3 py-1 rounded text-xs transition">Batal Utama</a>
                                <?php endif; ?>
                                
                                <a href="<?= base_url('admin/delete_event/'.$e->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus Event ini permanen?');" class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-3 py-1 rounded text-xs transition">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="p-8 text-center text-gray-500">Belum ada event yang ditambahkan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>