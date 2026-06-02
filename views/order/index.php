<div class="bg-emerald-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8" data-aos="fade-right">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl">Order Masuk</h1>
            <p class="mt-2 text-sm text-slate-600 sm:text-base">Kelola pesanan dan transaksi untuk produk limbah atau sisa produksi Anda.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <?php if (empty($data['orders'])): ?>
                <div class="p-12 text-center">
                    <div class="w-24 h-24 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pesanan Masuk</h3>
                    <p class="text-slate-500 max-w-md mx-auto">Saat ini belum ada pesanan untuk produk Anda. Terus promosikan produk Anda agar pembeli tertarik.</p>
                    <a href="<?= BASEURL; ?>/produksaya" class="mt-6 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-full text-white bg-emerald-600 hover:bg-emerald-700 transition transform hover:-translate-y-0.5 shadow-md">
                        Kelola Produk
                    </a>
                </div>
            <?php else: ?>
                <!-- Order list would go here -->
                <div class="p-6 text-center text-slate-600 font-medium">
                    Menampilkan daftar pesanan Anda...
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
