<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Sukses - Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { background-color: #121212; color: white; } </style>
</head>
<body class="min-h-screen flex items-center justify-center px-6">

    <div class="text-center bg-[#1a1a1a] p-10 rounded-3xl border border-green-500 shadow-2xl shadow-green-500/10 max-w-md w-full">
        <div class="w-24 h-24 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <h2 class="text-3xl font-bold mb-2 text-white">Berhasil!</h2>
        <p class="text-gray-400 mb-8 leading-relaxed">Pesanan tiket Anda telah masuk ke dalam sistem. Silakan lakukan pembayaran agar tiket Anda aktif.</p>
        
        <div class="flex flex-col gap-3">
            <a href="<?= base_url('app/history') ?>" class="w-full bg-[#d9138a] text-white py-3 rounded-full font-bold hover:bg-pink-700 transition shadow-lg shadow-[#d9138a]/30">
                Lihat My Ticket
            </a>
            <a href="<?= base_url('app/home') ?>" class="w-full border border-gray-600 text-gray-300 py-3 rounded-full font-bold hover:bg-gray-800 hover:text-white transition">
                Kembali ke Home
            </a>
        </div>
    </div>

</body>
</html>