<div class="container mt-5 mb-5" style="min-height: 60vh;">
    <h3 class="fw-bold mb-2">Tiket Saya</h3>
    <p class="text-muted mb-5">Berikut adalah daftar tiket yang telah Anda beli. Tunjukkan QR Code pada tiket saat check-in ke venue event.</p>

    <div class="card card-dark border-secondary mb-4 shadow-sm" style="border-radius: 16px; overflow: hidden;">
        <div class="row g-0 align-items-center">
            <div class="col-md-3">
                <img src="https://images.unsplash.com/photo-1540039155733-d7696d4eb98b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 220px;" alt="Event Image">
            </div>
            
            <div class="col-md-6 p-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold text-white mb-0">Jakarta Soundwave 2026</h5>
                    <span class="badge bg-success rounded-pill px-3 py-2">Sukses (Paid)</span>
                </div>
                <p class="text-muted small mb-4"><i class="fa-solid fa-location-dot text-magenta me-1"></i> Jakarta International Expo Kemayoran</p>
                
                <div class="row text-white small mb-3">
                    <div class="col-6">
                        <span class="text-muted d-block mb-1">Tanggal</span>
                        <span class="fw-bold">Sabtu, 10 Jul 2026</span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block mb-1">Waktu</span>
                        <span class="fw-bold">19:00 WIB</span>
                    </div>
                </div>
                
                <div class="row text-white small">
                    <div class="col-6">
                        <span class="text-muted d-block mb-1">Kategori Tiket</span>
                        <span class="fw-bold">Early Entry Day 1 (1x)</span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block mb-1">Total Pembayaran</span>
                        <span class="text-magenta fw-bold">Rp 1.000.000</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 d-flex flex-column justify-content-center align-items-center p-4" style="border-left: 2px dashed #333333; min-height: 220px; background-color: #141414;">
                <p class="text-muted small mb-2 fw-bold">Order ID: TRX-00192</p>
                
                <div class="bg-white p-2 rounded mb-3 shadow-sm">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data=TRX-00192-Valid-Ticket" alt="QR Code">
                </div>
                
                <button class="btn btn-outline-magenta btn-sm rounded-pill w-100">
                    <i class="fa-solid fa-download me-1"></i> E-Ticket
                </button>
            </div>
        </div>
    </div>

    <div class="card card-dark border-secondary mb-4 shadow-sm opacity-75" style="border-radius: 16px; overflow: hidden;">
        <div class="row g-0 align-items-center">
            <div class="col-md-3">
                <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=500&q=80" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 220px;" alt="Event Image">
            </div>
            
            <div class="col-md-6 p-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold text-white mb-0">Rock Night Live</h5>
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Menunggu Pembayaran</span>
                </div>
                <p class="text-muted small mb-4"><i class="fa-solid fa-location-dot text-magenta me-1"></i> Gelora Bung Karno</p>
                
                <div class="row text-white small">
                    <div class="col-6">
                        <span class="text-muted d-block mb-1">Kategori Tiket</span>
                        <span class="fw-bold">VIP Tribune (1x)</span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block mb-1">Total Tagihan</span>
                        <span class="text-magenta fw-bold">Rp 750.000</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 d-flex flex-column justify-content-center align-items-center p-4" style="border-left: 2px dashed #333333; min-height: 220px; background-color: #141414;">
                <p class="text-muted small mb-3 text-center">Tiket belum terbit. Segera selesaikan pembayaran Anda.</p>
                <a href="<?= base_url('ticketify/payment') ?>" class="btn btn-magenta btn-sm rounded-pill w-100">
                    <i class="fa-solid fa-wallet me-1"></i> Bayar Sekarang
                </a>
            </div>
        </div>
    </div>
</div>x