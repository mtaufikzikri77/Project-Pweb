<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Tickets - Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style> 
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #121212; color: white; } 
    </style>
</head>
<body class="min-h-screen flex flex-col">
    
    <nav class="w-full px-10 py-5 flex items-center justify-between bg-[#121212] border-b border-gray-800 sticky top-0 z-50">
        <a href="<?= base_url('app/home') ?>" class="flex items-center gap-2">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-8 h-8 object-contain drop-shadow-[0_0_10px_rgba(217,19,138,0.8)]">
            <span class="font-bold tracking-wide text-lg">Ticketify</span>
        </a>
        <div class="flex items-center gap-6">
            <a href="<?= base_url('app/explore') ?>" class="text-sm font-medium hover:text-[#d9138a] transition">Explore Events</a>
            <a href="<?= base_url('app/home') ?>" class="text-sm font-medium hover:text-[#d9138a] transition">Kembali ke Home</a>
        </div>
    </nav>

    <div class="max-w-[1000px] w-full mx-auto px-6 py-10 flex-grow">
        <h2 class="text-3xl font-bold mb-2">Riwayat Tiket Saya</h2>
        <?php if($this->session->flashdata('success_order')): ?>
            <div class="bg-green-500/20 text-green-400 border border-green-500 p-4 rounded-xl mb-6 font-semibold">
                🎉 <?= $this->session->flashdata('success_order') ?>
            </div>
        <?php endif; ?>
        <p class="text-gray-400 mb-8">Pantau status pembayaran dan seluruh riwayat pemesanan e-ticket Anda di sini.</p>

        <?php if(!empty($histories)): ?>
            <div class="flex flex-col gap-4">
                <?php foreach($histories as $h): ?>
                
                <div class="bg-[#1a1a1a] border border-gray-800 rounded-2xl p-6 flex items-center justify-between hover:border-[#d9138a]/50 transition">
                    <div class="flex gap-6 items-center">
                        <div class="w-16 h-16 bg-pink-900/30 rounded-xl flex items-center justify-center text-[#d9138a]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        
                        <div>
                            <h3 class="font-bold text-lg"><?= $h->title ?></h3>
                            <p class="text-sm text-gray-400">Order ID: <span class="font-mono text-[#d9138a]">#TRX-<?= $h->id ?></span> • <?= date('d M Y, H:i', strtotime($h->order_date)) ?></p>
                            <p class="text-sm mt-1">
                                Kuantitas: <span class="font-bold text-white"><?= $h->ticket_qty ?> Tiket</span> | 
                                Total: <span class="font-bold text-[#d9138a]">Rp <?= number_format($h->total_price, 0, ',', '.') ?></span> | 
                                Metode: <span class="font-bold text-blue-400"><?= $h->payment_method ?></span>
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 items-end">
                        
                        <?php if($h->payment_status == 'Pending'): ?>
                            <span class="bg-yellow-500/10 text-yellow-500 px-4 py-1.5 rounded-full text-xs font-semibold border border-yellow-500/30">
                                ⌛ Menunggu Validasi Admin
                            </span>
                        <?php else: ?>
                            <span class="bg-green-500/10 text-green-400 px-4 py-1.5 rounded-full text-xs font-semibold border border-green-500/30">
                                ✔️ Lunas / E-Ticket Aktif
                            </span>
                        <?php endif; ?>

                        <?php if($h->check_in_status == 'Digunakan'): ?>
                            <span class="bg-purple-500/10 text-purple-400 px-4 py-1.5 rounded-full text-xs font-semibold border border-purple-500/30">
                                🎟️ Tiket Telah Digunakan
                            </span>
                        <?php else: ?>
                            <span class="bg-gray-800 text-gray-400 px-4 py-1.5 rounded-full text-xs font-semibold">
                                Belum Check-In
                            </span>
                        <?php endif; ?>

                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-[#1a1a1a] rounded-2xl p-10 text-center border border-gray-800 mt-10">
                <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Belum ada tiket</h3>
                <p class="text-gray-400">Anda belum pernah melakukan pemesanan tiket event.</p>
                <a href="<?= base_url('app/explore') ?>" class="inline-block mt-6 bg-[#d9138a] text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-pink-700 transition">Cari Event Sekarang</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>