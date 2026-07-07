<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pemesanan - Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { background-color: #121212; color: white; } </style>
</head>
<body class="min-h-screen flex items-center justify-center py-10 px-6">

    <div class="bg-[#1a1a1a] border border-[#d9138a] rounded-3xl p-8 max-w-[500px] w-full shadow-2xl shadow-[#d9138a]/10">
        
        <div class="flex items-center justify-center gap-3 mb-6 pb-6 border-b border-gray-800">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-10 h-10 object-contain">
            <span class="text-2xl font-bold tracking-wide text-white">Ticketify</span>
        </div>

        <h2 class="text-xl font-bold mb-6 text-center">Konfirmasi Pesanan</h2>

        <div class="space-y-4 text-sm mb-8">
            <div class="flex justify-between items-start">
                <span class="text-gray-400">Event</span>
                <span class="font-bold text-right text-white max-w-[200px]"><?= $event->title ?></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-400">Kuantitas</span>
                <span class="font-bold text-white"><?= $qty ?> Tiket</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-400">Harga Satuan</span>
                <span class="font-bold text-white">Rp <?= number_format($price, 0, ',', '.') ?></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-400">Metode Pembayaran</span>
                <span class="font-bold text-blue-400 bg-blue-900/30 px-3 py-1 rounded-full text-xs"><?= $payment_method ?></span>
            </div>
        </div>

        <div class="flex justify-between items-center mb-8 bg-black/50 p-4 rounded-xl border border-gray-800">
            <span class="font-bold text-gray-300">Total Tagihan</span>
            <span class="font-bold text-2xl text-[#d9138a]">Rp <?= number_format($total_price, 0, ',', '.') ?></span>
        </div>

        <form action="<?= base_url('app/proses_bayar') ?>" method="POST">
            <input type="hidden" name="event_id" value="<?= $event_id ?>">
            <input type="hidden" name="qty" value="<?= $qty ?>">
            <input type="hidden" name="total_price" value="<?= $total_price ?>">
            <input type="hidden" name="payment_method" value="<?= $payment_method ?>">
            
            <button type="submit" class="w-full bg-[#d9138a] text-white py-3.5 rounded-xl font-bold hover:bg-pink-700 transition">
                Konfirmasi & Bayar Sekarang
            </button>
        </form>
        
        <a href="javascript:history.back()" class="block text-center mt-4 text-sm text-gray-400 hover:text-white transition">
            Batalkan & Kembali
        </a>
    </div>

</body>
</html>