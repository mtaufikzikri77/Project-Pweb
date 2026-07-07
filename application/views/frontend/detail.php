<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Event - Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #121212; color: white; }
        input[type="number"]::-webkit-inner-spin-button, input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type="number"] { -moz-appearance: textfield; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <nav class="w-full px-10 py-5 flex items-center justify-between border-b border-gray-800 bg-[#121212] sticky top-0 z-50">
        <a href="<?= base_url('app/home') ?>" class="flex items-center gap-2 cursor-pointer">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-8 h-8 object-contain drop-shadow-[0_0_10px_rgba(217,19,138,0.8)]">
            <span class="text-white font-semibold text-lg tracking-wide">Ticketify</span>
        </a>
        <div class="flex items-center gap-6">
            <a href="<?= base_url('app/history') ?>" class="text-sm font-medium hover:text-[#d9138a] transition">My Tickets</a>
            <a href="<?= base_url('auth/logout') ?>" class="border border-[#d9138a] text-white px-6 py-1.5 rounded-full text-sm font-medium hover:bg-red-600 hover:border-red-600 transition">Logout</a>
        </div>
    </nav>

    <div class="max-w-[1200px] w-full mx-auto px-6 py-10 flex-grow flex flex-col md:flex-row gap-10">
        
        <div class="w-full md:w-2/3">
            <a href="javascript:history.back()" class="text-[#d9138a] text-sm font-semibold flex items-center gap-2 mb-6 hover:text-pink-400 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali
            </a>

            <div class="w-full h-[300px] rounded-2xl overflow-hidden mb-6 border border-gray-800 bg-gray-900">
                <img src="<?= base_url('uploads/events/'.$event->image) ?>" class="w-full h-full object-cover">
            </div>

            <h1 class="text-3xl font-bold mb-4"><?= $event->title ?></h1>

            <div class="flex items-center gap-3 mb-6 bg-black/40 border border-gray-800 p-3 rounded-xl inline-flex shadow-inner">
                <div class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center text-[#d9138a] font-bold border border-gray-700 shadow-[0_0_10px_rgba(217,19,138,0.3)]">
                    <?= !empty($event->organizer) ? strtoupper(substr($event->organizer, 0, 1)) : 'A' ?>
                </div>
                <div class="pr-4">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-0.5">Diselenggarakan oleh</p>
                    <p class="text-sm font-bold text-white"><?= !empty($event->organizer) ? $event->organizer : 'Anonim' ?></p>
                </div>
            </div>

            <p class="text-gray-400 text-sm mb-6 flex flex-wrap items-center gap-6 border-y border-gray-800 py-4">
                <span class="flex items-center gap-2"><span class="text-lg">📅</span> <?= date('d M Y, H:i', strtotime($event->event_date)) ?> WIB</span>
                <span class="flex items-center gap-2"><span class="text-lg">📍</span> <?= !empty($event->location) ? $event->location : 'Belum Ditentukan' ?></span>
                <span class="flex items-center gap-2 text-pink-400 font-bold"><span class="text-lg">🎫</span> Sisa Kuota: <?= $event->quota ?></span>
            </p>

            <div class="mb-10">
                <h3 class="font-bold text-lg mb-3">Deskripsi Event</h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    <?= nl2br(!empty($event->description) ? $event->description : 'Tidak ada deskripsi.') ?>
                </p>
            </div>

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-400 text-sm">Pilih tiket yang ingin kamu pesan:</h3>
            </div>

            <div class="bg-[#1a1a1a] border border-[#d9138a]/50 rounded-2xl p-6 relative overflow-hidden">
                <h4 class="font-bold text-lg mb-1">Tiket Reguler</h4>
                <p class="text-xs text-gray-500 mb-4 pb-4 border-b border-gray-700 border-dashed">Price includes tax and administrative fees.</p>
                
                <?php if($event->quota > 0): ?>
                    <div class="flex justify-between items-center mt-6">
                        <span class="text-2xl font-bold text-white">Rp <?= number_format($event->price, 0, ',', '.') ?></span>
                        <div class="flex items-center gap-2 bg-black border border-gray-700 rounded-full px-2 py-1">
                            <button type="button" id="btnMinus" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-[#d9138a] transition font-bold text-lg">-</button>
                            <input type="number" id="displayQty" value="1" min="1" max="<?= $event->quota ?>" class="font-bold text-lg w-10 text-center bg-transparent outline-none text-white">
                            <button type="button" id="btnPlus" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-[#d9138a] transition font-bold text-lg">+</button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex justify-between items-center opacity-50 mt-6">
                        <span class="text-xl font-bold text-white">Rp <?= number_format($event->price, 0, ',', '.') ?></span>
                        <div class="bg-gray-800 px-4 py-2 rounded-full text-sm font-bold text-red-400">Sold Out</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="w-full md:w-1/3 md:mt-16">
            <form action="<?= base_url('app/checkout') ?>" method="POST" class="bg-[#1a1a1a] border border-[#d9138a] rounded-2xl p-6 sticky top-24 shadow-[0_0_20px_rgba(217,19,138,0.15)]">    
                <h3 class="font-bold text-lg mb-6">Detail pemesanan</h3>
                
                <div class="flex justify-between items-center mb-4 text-sm">
                    <span class="flex items-center gap-2 text-gray-300">
                        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-6 h-6 object-contain">
                        Tiket Reguler
                    </span>
                    <span class="font-bold text-white">Rp <span id="pricePerItem"><?= number_format($event->price, 0, ',', '.') ?></span></span>
                </div>

                <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-700 border-dashed text-sm">
                    <span class="text-gray-400"><span id="summaryQty">1</span>x Pembelian</span>
                </div>

                <div class="mb-6">
                    <label class="block text-xs text-gray-400 font-bold mb-2 uppercase tracking-wider">Metode Pembayaran</label>
                    <select name="payment_method" class="w-full bg-black border border-gray-700 text-sm p-3 rounded-xl text-white outline-none focus:border-[#d9138a]" required <?= $event->quota <= 0 ? 'disabled' : '' ?>>
                        <option value="" disabled selected>Pilih Pembayaran...</option>
                        <option value="BCA Virtual Account">BCA Virtual Account</option>
                        <option value="Mandiri Virtual Account">Mandiri Virtual Account</option>
                        <option value="QRIS">QRIS (GoPay/Dana/OVO)</option>
                        <option value="Alfamart / Indomaret">Alfamart / Indomaret</option>
                    </select>
                </div>

                <div class="flex justify-between items-center mb-8 bg-black/50 p-4 rounded-xl border border-gray-800">
                    <span class="font-bold text-gray-300">Total Harga</span>
                    <span class="font-bold text-xl text-[#d9138a]">Rp <span id="totalPrice"><?= number_format($event->price, 0, ',', '.') ?></span></span>
                </div>

                <input type="hidden" name="event_id" value="<?= $event->id ?>">
                <input type="hidden" name="price" value="<?= $event->price ?>">
                <input type="hidden" name="qty" id="inputQty" value="1">
                
                <button type="submit" class="w-full <?= $event->quota > 0 ? 'bg-[#d9138a] hover:bg-pink-700 shadow-[#d9138a]/30' : 'bg-gray-700 cursor-not-allowed opacity-50' ?> text-white py-3 rounded-xl font-bold transition shadow-lg" <?= $event->quota <= 0 ? 'disabled' : '' ?>>
                    <?= $event->quota > 0 ? 'Lanjutkan & Pesan' : 'Tiket Habis' ?>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pricePerTicket = <?= $event->price ?>;
            const maxQuota = <?= $event->quota ?>;
            const btnMinus = document.getElementById('btnMinus');
            const btnPlus = document.getElementById('btnPlus');
            const displayQty = document.getElementById('displayQty'); 
            const summaryQty = document.getElementById('summaryQty');
            const totalPrice = document.getElementById('totalPrice');
            const inputQty = document.getElementById('inputQty'); 

            if(!displayQty) return;

            function updateUI(qty) {
                if (isNaN(qty) || qty < 1) qty = 1;
                if (qty > maxQuota) {
                    qty = maxQuota;
                    alert("Sisa kuota tiket hanya tinggal " + maxQuota);
                }

                displayQty.value = qty;
                summaryQty.innerText = qty;
                inputQty.value = qty; 
                totalPrice.innerText = new Intl.NumberFormat('id-ID').format(qty * pricePerTicket);
            }

            displayQty.addEventListener('input', (e) => updateUI(parseInt(e.target.value)));
            displayQty.addEventListener('blur', (e) => { if(!e.target.value || parseInt(e.target.value) < 1) updateUI(1); });
            btnPlus.addEventListener('click', () => updateUI((parseInt(displayQty.value) || 1) + 1));
            btnMinus.addEventListener('click', () => {
                let current = parseInt(displayQty.value) || 1;
                if (current > 1) updateUI(current - 1);
            });
        });
    </script>
</body>
</html>