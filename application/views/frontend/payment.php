<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-black p-8 rounded-xl border border-gray-700 max-w-md w-full">
        <h2 class="text-2xl font-bold mb-6">Detail Pembayaran</h2>
        <h3 class="text-xl text-pink-500"><?= $event->title ?></h3>
        <p class="text-gray-400 mb-6">Harga per tiket: Rp <?= number_format($event->price, 0, ',', '.') ?></p>

        <form action="<?= base_url('app/proses_bayar') ?>" method="POST">
            <input type="hidden" name="event_id" value="<?= $event->id ?>">
            <input type="hidden" name="price" value="<?= $event->price ?>">
            
            <label class="block text-sm mb-2">Jumlah Tiket</label>
            <input type="number" name="qty" value="1" min="1" max="<?= $event->quota ?>" class="w-full p-2 rounded bg-gray-800 border border-gray-600 mb-6 text-white" required>
            
            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 py-3 rounded-full font-bold">Bayar Sekarang</button>
        </form>
    </div>
</body>
</html>