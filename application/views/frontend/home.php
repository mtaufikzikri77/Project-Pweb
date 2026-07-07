<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-8">
    <nav class="flex justify-between items-center mb-10 border-b border-gray-800 pb-4">
        <h1 class="text-2xl font-bold text-pink-500">Ticketify</h1>
        <div>
            <span class="mr-4 text-gray-400">Halo, <?= $this->session->userdata('username') ?></span>
            <a href="https://wa.me/628563700011?text=Halo%20Admin%20Ticketify,%20saya%20ingin%20mengajukan%20event%20baru.%0A%0A*Nama%20Event:*%20%0A*Tanggal:*%20%0A*Lokasi:*%20%0A*Harga%20Tiket:*%20%0A*Kuota:*%20%0A*Deskripsi%20Singkat:*%20%0A%0AMohon%20bantuannya%20untuk%20di-publish%20ke%20website." target="_blank" class="border border-[#d9138a] text-[#d9138a] px-5 py-1.5 rounded-full text-xs font-bold hover:bg-[#d9138a] hover:text-white transition">
                Create Event
            </a>
        </div>
    </nav>

    <h2 class="text-xl font-bold mb-6">Browse Event</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <?php foreach($events as $e): ?>
        <div class="bg-black border border-gray-800 rounded-xl overflow-hidden p-4">
            <div class="h-32 bg-gray-700 rounded-lg mb-4"></div> <h3 class="font-bold text-lg"><?= $e->title ?></h3>
            <p class="text-pink-500 font-bold my-2">Rp <?= number_format($e->price, 0, ',', '.') ?></p>
            <a href="<?= base_url('app/detail/'.$e->id) ?>" class="block text-center border border-pink-500 text-pink-500 py-1 rounded-full text-sm">Lihat Detail</a>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>