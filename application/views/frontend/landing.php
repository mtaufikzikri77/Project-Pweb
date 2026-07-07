<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #121212;
            color: white;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="overflow-x-hidden">

    <nav class="fixed top-0 w-full z-50 px-10 py-4 flex items-center justify-between bg-black/60 backdrop-blur-md border-b border-white/10 transition-all">
        <a href="<?php echo base_url(); ?>" class="flex items-center gap-2 cursor-pointer">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-8 h-8 object-contain drop-shadow-[0_0_10px_rgba(217,19,138,0.8)]">
            <span class="text-white font-semibold text-lg tracking-wide">Ticketify</span>
        </a>

        <div class="relative w-[400px]">
            <form action="<?= base_url('app/explore') ?>" method="GET">
                <input type="text" name="search" placeholder="Cari Tiketmu Disini.." class="w-full bg-[#2a2a2a] text-sm text-white rounded-full px-5 py-2.5 outline-none focus:ring-1 focus:ring-[#d9138a] border border-gray-700 placeholder-gray-400">
                <button type="submit" class="absolute right-3 top-2 text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-6">
            <?php if($this->session->userdata('user_id')): ?>
                <a href="<?php echo base_url('app/explore'); ?>" class="text-sm font-medium hover:text-[#d9138a] transition">Explore</a>
                <?php if($this->session->userdata('role_id') == 2): ?>
                    <a href="<?php echo base_url('app/history'); ?>" class="text-sm font-medium hover:text-[#d9138a] transition">My Tickets</a>
                <?php endif; ?>
                
                <?php if($this->session->userdata('role_id') == 1): ?>
                    <a href="<?php echo base_url('admin/events'); ?>" class="text-sm font-bold text-[#d9138a] hover:text-pink-400 transition">Admin Panel</a>
                <?php endif; ?>

                <a href="<?php echo base_url('auth/logout'); ?>" class="border border-[#d9138a] text-white px-6 py-1.5 rounded-full text-sm font-medium hover:bg-red-600 hover:border-red-600 transition">Logout</a>
            <?php else: ?>
                <a href="<?php echo base_url('app/explore'); ?>" class="text-sm font-medium hover:text-[#d9138a] transition">Explore</a>
                <a href="<?php echo base_url('auth/login'); ?>" class="border border-[#d9138a] text-white px-6 py-1.5 rounded-full text-sm font-medium hover:bg-[#d9138a] transition">Sign in</a>
                <a href="<?php echo base_url('auth/register'); ?>" class="bg-[#d9138a] border border-[#d9138a] text-white px-6 py-1.5 rounded-full text-sm font-medium hover:bg-pink-700 transition">Sign up</a>
            <?php endif; ?>
        </div>
    </nav>

    <?php if(!empty($main_event) && isset($main_event->image)): ?>
        <div class="relative w-full h-[600px] bg-cover bg-center bg-no-repeat rounded-b-[40px] overflow-hidden" style="background-image: url('<?php echo base_url('uploads/events/'.$main_event->image); ?>');">
            <div class="absolute inset-0 bg-gradient-to-l from-black/90 via-black/50 to-transparent"></div>
            
            <div class="absolute bottom-16 right-12 bg-black/40 backdrop-blur-md border border-white/10 p-8 rounded-3xl w-[500px]">
                <span class="bg-[#d9138a] text-white text-[10px] uppercase tracking-wider font-bold px-3 py-1.5 rounded-full mb-4 inline-block">Highlight Event</span>
                <h2 class="text-4xl font-bold mb-2 leading-tight text-white"><?php echo $main_event->title; ?></h2>
                
                <p class="text-[12px] font-bold text-[#d9138a] mb-2">By: <?= !empty($main_event->organizer) ? $main_event->organizer : 'Anonim' ?></p>
                
                <p class="text-[12px] text-gray-300 mb-2">📍 <?= isset($main_event->location) ? $main_event->location : 'Lokasi Belum Ditentukan' ?></p>
                <p class="text-sm text-gray-300 mb-6 line-clamp-2"><?php echo $main_event->description; ?></p>
                
                <div class="flex gap-4 items-center">
                    <a href="<?php echo base_url('app/detail/'.$main_event->id); ?>" class="bg-[#d9138a] px-8 py-3 rounded-full text-sm font-semibold hover:bg-pink-700 transition shadow-lg shadow-[#d9138a]/40">
                        Beli Tiket Sekarang
                    </a>
                    <span class="font-bold text-xl text-white">Rp <?php echo number_format($main_event->price, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="relative w-full h-[600px] bg-gray-900 rounded-b-[40px] flex items-center justify-center pt-16">
            <div class="text-center">
                <h2 class="text-2xl font-bold mb-2">Selamat Datang di Ticketify</h2>
                <p class="text-gray-500">Penyelenggara belum menetapkan Event Utama.</p>
            </div>
        </div>
    <?php endif; ?>

    <div class="max-w-[1200px] mx-auto px-6 py-10 mt-8">
        
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <h2 class="text-2xl font-bold">Rekomendasi Event untukmu</h2>
                <a href="<?= base_url('app/explore') ?>" class="border border-[#d9138a] text-[#d9138a] px-6 py-1.5 rounded-full text-xs font-bold hover:bg-[#d9138a] hover:text-white transition">
                    Explore Semua Kategori
                </a>
            </div>
            <div class="flex gap-2">
                <button id="btnPrev" class="bg-[#1a1a1a] rounded-full p-2 border border-gray-700 hover:border-[#d9138a] hover:text-[#d9138a] transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button id="btnNext" class="bg-[#1a1a1a] rounded-full p-2 border border-gray-700 hover:border-[#d9138a] hover:text-[#d9138a] transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <div class="relative w-full">
            <div id="carouselContainer" class="flex gap-6 overflow-x-auto no-scrollbar scroll-smooth snap-x snap-mandatory pb-4">
                <?php if(!empty($events)): ?>
                    <?php foreach($events as $e): 
                        $kategori_event = isset($e->category_name) ? $e->category_name : 'Uncategorized';
                    ?>
                    
                    <div class="event-card min-w-[280px] max-w-[280px] bg-[#1a1a1a] border border-[#d9138a]/50 rounded-2xl p-4 hover:border-[#d9138a] transition flex-shrink-0 snap-start flex flex-col justify-between h-[420px]">
                        <div>
                            <div class="relative w-full h-44 rounded-xl overflow-hidden mb-4 bg-gray-700">
                                <img src="<?php echo base_url('uploads/events/'.$e->image); ?>" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#d9138a]/80 to-transparent flex items-end justify-center pb-2">
                                    <span class="text-white text-[10px] font-bold tracking-wider"><?= $kategori_event ?></span>
                                </div>
                            </div>
                            <h3 class="font-bold text-sm mb-1 leading-tight line-clamp-2 h-10"><?php echo $e->title; ?></h3>
                            
                            <p class="text-[10px] text-[#d9138a] mb-2 font-semibold">By: <?= !empty($e->organizer) ? $e->organizer : 'Anonim' ?></p>
                            
                            <p class="text-[11px] text-gray-400 mt-2 truncate">📍 <?= isset($e->location) ? $e->location : 'Lokasi Belum Ditentukan' ?></p>
                            <p class="text-[11px] text-gray-400 mb-2">📅 <?= date('d M Y', strtotime($e->event_date)) ?></p>
                            
                            <p class="font-bold text-lg text-[#d9138a]">Rp <?php echo number_format($e->price, 0, ',', '.'); ?></p>
                        </div>
                        <a href="<?php echo base_url('app/detail/'.$e->id); ?>" class="border border-gray-600 text-gray-300 rounded-full px-4 py-2 text-xs text-center hover:bg-[#d9138a] hover:border-[#d9138a] hover:text-white transition flex items-center justify-center gap-2 mt-4 font-semibold">
                            Pesan Tiket
                        </a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="w-full text-center py-10 text-gray-500 border border-dashed border-gray-700 rounded-xl">
                        Belum ada event yang tersedia di database.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-16 bg-[#0a0a0a] border border-[#d9138a] rounded-2xl flex items-center justify-between p-10 relative overflow-hidden min-h-[240px]">
            
            <div class="max-w-[65%] z-10">
                <div class="flex items-center gap-3 mb-4">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-7 h-7 object-contain drop-shadow-[0_0_10px_rgba(217,19,138,0.8)]">
                    <span class="text-white font-bold text-lg tracking-wide">Ticketify</span>
                </div>
                <p class="text-gray-300 mb-8 font-medium leading-relaxed">
                    "Optimalkan penjualan tiket event Anda bersama Ticketify.<br>
                    Mari berkolaborasi menciptakan pengalaman terbaik bagi audiens Anda."
                </p>
                <a href="https://wa.me/6287811490784?text=Halo%20Admin%20Ticketify%2C%20saya%20ingin%20mengajukan%20event%20baru.%0A%0ANama%20Event%3A%20%0ATanggal%3A%20%0ALokasi%3A%20%0AHarga%20Tiket%3A%20%0AKuota%3A%20%0ADeskripsi%20Singkat%3A%20%0A%0AMohon%20bantuannya%20untuk%20di-publish%20ke%20website." target="_blank" class="bg-[#d9138a] px-8 py-3 rounded-full text-sm font-bold hover:bg-pink-700 transition shadow-[0_0_15px_rgba(217,19,138,0.4)]">
                    Create Event
                </a>
            </div>

            <div class="absolute right-12 bottom-0 h-full pt-8 flex items-end pointer-events-none">
                <img src="<?= base_url('assets/img/illustration.png') ?>" alt="Ilustrasi Promosi" class="h-full w-auto object-contain opacity-70 drop-shadow-xl">
            </div>
            
        </div>
    </div>

    <footer class="bg-black pt-16 pb-8 px-10 mt-10 border-t border-gray-900">
        <div class="max-w-[1200px] mx-auto grid grid-cols-4 gap-8">
            <div>
                <a href="<?php echo base_url(); ?>" class="flex items-center gap-2 mb-4">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Ticketify" class="w-8 h-8 object-contain">
                    <span class="text-white font-bold text-xl">Ticketify</span>
                </a>
                <p class="text-[10px] text-gray-500 leading-relaxed max-w-[200px]">Go Work Central Park, Central Park Mall, Level LG, Unit L109-114, Jl. Letjen S. Parman, Daerah Khusus Ibukota Jakarta 11470</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-sm">Company :</h4>
                <ul class="text-xs text-gray-400 space-y-3">
                    <li><a href="#" class="hover:text-[#d9138a] transition">About us</a></li>
                    <li><a href="#" class="hover:text-[#d9138a] transition">Terms & Condition</a></li>
                    <li><a href="#" class="hover:text-[#d9138a] transition">Pusat Bantuan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-sm">Social Media :</h4>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 bg-gray-800 rounded flex items-center justify-center text-xs hover:bg-[#d9138a] hover:text-white transition cursor-pointer">TK</div>
                    <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center text-xs hover:bg-blue-500 transition cursor-pointer">f</div>
                    <div class="w-6 h-6 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-500 rounded-md flex items-center justify-center text-xs hover:opacity-80 transition cursor-pointer">IG</div>
                </div>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-sm">Contact :</h4>
                <ul class="text-xs text-gray-400 space-y-3">
                    <li class="flex items-center gap-2">
                        <span class="text-green-500">📞</span> 08563700011
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-blue-400">📧</span> Ticketfy@gmail.com
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Logika Geser Carousel
            const carousel = document.getElementById('carouselContainer');
            const scrollAmount = 304 * 2; 

            document.getElementById('btnNext').addEventListener('click', () => carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' }));
            document.getElementById('btnPrev').addEventListener('click', () => carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));
        });
    </script>
</body>
</html>