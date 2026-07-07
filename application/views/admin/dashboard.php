<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - Ticketify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#121212] text-white font-sans min-h-screen p-8">
    
    <div class="max-w-[1200px] mx-auto">
        <div class="flex justify-between items-center mb-8 border-b border-gray-800 pb-4">
            <h1 class="text-3xl font-bold text-[#d9138a]">Ticketify Admin Panel</h1>
            <div class="flex gap-4">
                <a href="<?= base_url('admin/events') ?>" class="bg-[#d9138a] px-6 py-2 rounded-full font-bold hover:bg-pink-700 transition shadow-lg shadow-[#d9138a]/30">Kelola Event</a>
                
                <a href="<?= base_url('auth/logout') ?>" class="bg-red-600 px-6 py-2 rounded-full font-bold hover:bg-red-700 transition">Logout</a>
            </div>
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-500/20 text-green-400 p-4 rounded-lg mb-6 border border-green-500">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="bg-[#1a1a1a] rounded-xl border border-gray-800 overflow-hidden">
            <div class="p-6 border-b border-gray-800">
                <h2 class="text-xl font-bold">Manajemen Transaksi & Check-In</h2>
            </div>
            
            <table class="w-full text-left text-sm">
                <thead class="bg-black/50 text-gray-400">
                    <tr>
                        <th class="p-4">ID Order</th>
                        <th class="p-4">Pembeli</th>
                        <th class="p-4">Event</th>
                        <th class="p-4">Qty & Total</th>
                        <th class="p-4">Status Bayar</th>
                        <th class="p-4">Status Check-in</th>
                        <th class="p-4 text-center">Aksi (Validasi)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    <?php foreach($transactions as $trx): ?>
                    <tr class="hover:bg-gray-800/50">
                        <td class="p-4 font-mono text-[#d9138a]">#TRX-<?= $trx->id ?></td>
                        <td class="p-4"><?= $trx->name ?> <br> <span class="text-xs text-gray-500"><?= $trx->email ?></span></td>
                        <td class="p-4 font-semibold"><?= $trx->title ?></td>
                        <td class="p-4"><?= $trx->ticket_qty ?> Tiket <br> <span class="text-[#d9138a]">Rp<?= number_format($trx->total_price,0,',','.') ?></span></td>
                        
                        <td class="p-4">
                            <?php if($trx->payment_status == 'Pending'): ?>
                                <span class="bg-yellow-500/20 text-yellow-500 px-3 py-1 rounded-full text-xs">Pending</span>
                            <?php else: ?>
                                <span class="bg-green-500/20 text-green-500 px-3 py-1 rounded-full text-xs">Lunas</span>
                            <?php endif; ?>
                        </td>

                        <td class="p-4">
                            <?php if($trx->check_in_status == 'Digunakan'): ?>
                                <span class="bg-purple-500/20 text-purple-400 px-3 py-1 rounded-full text-xs">Digunakan</span>
                            <?php else: ?>
                                <span class="bg-gray-700 text-gray-400 px-3 py-1 rounded-full text-xs">Belum Check-in</span>
                            <?php endif; ?>
                        </td>

                        <td class="p-4 flex justify-center gap-2">
                            <?php if($trx->payment_status == 'Pending'): ?>
                                <a href="<?= base_url('admin/acc_pembayaran/'.$trx->id) ?>" class="bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded text-xs font-bold transition">ACC Bayar</a>
                            <?php endif; ?>

                            <?php if($trx->payment_status == 'Lunas' && $trx->check_in_status != 'Digunakan'): ?>
                                <a href="<?= base_url('admin/check_in/'.$trx->id) ?>" class="bg-[#d9138a] hover:bg-pink-600 px-3 py-1.5 rounded text-xs font-bold transition">Check-In Masuk</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>