<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Event - Admin Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#121212] text-white min-h-screen p-8 flex items-center justify-center">
    <div class="w-full max-w-[800px] bg-[#1a1a1a] rounded-xl border border-gray-800 p-8 shadow-2xl">
        
        <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-4">
            <h1 class="text-2xl font-bold text-[#d9138a]">Edit Event: <?= $event->title ?></h1>
            <a href="<?= base_url('admin/events') ?>" class="border border-gray-600 px-4 py-1.5 rounded-full text-sm hover:bg-gray-800 transition">Batal & Kembali</a>
        </div>

        <form action="<?= base_url('admin/update_event') ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="hidden" name="id" value="<?= $event->id ?>">

            <div>
                <label class="block text-xs mb-1 text-gray-400 font-bold">Judul Event</label>
                <input type="text" name="title" value="<?= $event->title ?>" class="w-full bg-black border border-gray-700 p-2.5 rounded outline-none focus:border-[#d9138a]" required>
            </div>
            
            <div>
                <label class="block text-xs mb-1 text-gray-400 font-bold">Pihak Penyelenggara</label>
                <input type="text" name="organizer" value="<?= !empty($event->organizer) ? $event->organizer : '' ?>" class="w-full bg-black border border-gray-700 p-2.5 rounded outline-none focus:border-[#d9138a]" required>
            </div>

            <div>
                <label class="block text-xs mb-1 text-gray-400 font-bold">Kategori Event</label>
                <select name="category_id" class="w-full bg-black border border-gray-700 text-white rounded p-2.5 outline-none focus:border-[#d9138a]" required>
                    <option value="" disabled>-- Pilih Kategori --</option>
                    <?php if(!empty($categories)): foreach($categories as $cat): ?>
                        <option value="<?= $cat->id ?>" <?= (isset($current_category) && $current_category == $cat->id) ? 'selected' : '' ?>><?= $cat->name ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs mb-1 text-gray-400 font-bold">Lokasi Penyelenggaraan</label>
                <input type="text" name="location" value="<?= $event->location ?>" class="w-full bg-black border border-gray-700 p-2.5 rounded outline-none focus:border-[#d9138a]" required>
            </div>

            <div>
                <label class="block text-xs mb-1 text-gray-400 font-bold">Tanggal & Waktu</label>
                <input type="datetime-local" name="event_date" value="<?= date('Y-m-d\TH:i', strtotime($event->event_date)) ?>" class="w-full bg-black border border-gray-700 p-2.5 rounded outline-none focus:border-[#d9138a] [color-scheme:dark]" required>
            </div>

            <div class="flex gap-4">
                <div class="w-1/2">
                    <label class="block text-xs mb-1 text-gray-400 font-bold">Harga (Rp)</label>
                    <input type="number" name="price" value="<?= $event->price ?>" class="w-full bg-black border border-gray-700 p-2.5 rounded outline-none focus:border-[#d9138a]" required>
                </div>
                <div class="w-1/2">
                    <label class="block text-xs mb-1 text-gray-400 font-bold">Kuota Tiket</label>
                    <input type="number" name="quota" value="<?= $event->quota ?>" class="w-full bg-black border border-gray-700 p-2.5 rounded outline-none focus:border-[#d9138a]" required>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs mb-1 text-gray-400 font-bold">Deskripsi Event</label>
                <textarea name="description" rows="3" class="w-full bg-black border border-gray-700 p-2.5 rounded outline-none focus:border-[#d9138a]"><?= $event->description ?></textarea>
            </div>

            <div class="md:col-span-2 bg-black/50 p-4 rounded-xl border border-gray-800">
                <label class="block text-xs mb-2 text-gray-400 font-bold">Ganti Banner/Poster Event <span class="text-pink-400 font-normal">(Biarkan kosong jika tidak diganti)</span></label>
                <div class="flex items-center gap-6">
                    <img src="<?= base_url('uploads/events/'.$event->image) ?>" class="w-24 h-16 object-cover rounded border border-gray-700 shadow-md">
                    <input type="file" name="image" class="w-full bg-black border border-gray-700 text-white rounded outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l file:border-0 file:text-sm file:font-semibold file:bg-[#d9138a] file:text-white cursor-pointer" accept="image/*">
                </div>
            </div>

            <div class="md:col-span-2 mt-2">
                <button type="submit" class="bg-[#d9138a] w-full py-3 rounded-lg font-bold hover:bg-pink-700 transition shadow-[0_0_15px_rgba(217,19,138,0.4)]">Simpan Perubahan Event</button>
            </div>
        </form>
    </div>
</body>
</html>