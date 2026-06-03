<main class="flex-1 bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8" data-aos="fade-right">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl">Pesanan Saya</h1>
            <p class="mt-2 text-sm text-slate-600 sm:text-base">Daftar produk limbah yang telah Anda beli beserta status pembayarannya.</p>
        </div>

        <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
            <?php if (empty($data['orders'])): ?>
                <div class="bg-white rounded-3xl p-12 text-center shadow-xl border border-slate-100">
                    <div class="w-24 h-24 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pesanan</h3>
                    <p class="text-slate-500 max-w-md mx-auto">Anda belum pernah melakukan pemesanan produk limbah di platform kami.</p>
                    <a href="<?= BASEURL; ?>/caribahanbaku" class="mt-6 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-full text-white bg-emerald-600 hover:bg-emerald-700 transition transform hover:-translate-y-0.5 shadow-md">
                        Mulai Cari Bahan Baku
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($data['orders'] as $order): ?>
                    <?php
                        // Order Status Labels
                        $orderStatusLabel = 'Tertunda';
                        $orderStatusClass = 'bg-yellow-100 text-yellow-800';
                        switch ($order['status_order']) {
                            case 'diproses':
                                $orderStatusLabel = 'Diproses';
                                $orderStatusClass = 'bg-blue-100 text-blue-800';
                                break;
                            case 'dikirim':
                                $orderStatusLabel = 'Dikirim';
                                $orderStatusClass = 'bg-indigo-100 text-indigo-800';
                                break;
                            case 'selesai':
                                $orderStatusLabel = 'Selesai';
                                $orderStatusClass = 'bg-emerald-100 text-emerald-800';
                                break;
                            case 'dibatalkan':
                                $orderStatusLabel = 'Batal';
                                $orderStatusClass = 'bg-red-100 text-red-800';
                                break;
                        }

                        // Payment Status Labels
                        $payStatusLabel = 'Belum Bayar';
                        $payStatusClass = 'bg-amber-100 text-amber-800';
                        if ($order['status_pembayaran'] === 'lunas') {
                            $payStatusLabel = 'Lunas';
                            $payStatusClass = 'bg-emerald-100 text-emerald-800';
                        } elseif ($order['status_pembayaran'] === 'gagal') {
                            $payStatusLabel = 'Gagal';
                            $payStatusClass = 'bg-red-100 text-red-800';
                        }
                    ?>
                    <div class="bg-white rounded-3xl p-6 shadow-md border border-slate-100 hover:shadow-lg transition">
                        <!-- Order Header -->
                        <div class="flex flex-wrap items-center justify-between border-b border-slate-100 pb-4 mb-4 gap-2">
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-slate-500 font-bold"><?= date('d M Y, H:i', strtotime($order['created_at'])); ?></span>
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold bg-slate-100 text-slate-700"><?= htmlspecialchars($order['order_id']); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold <?= $orderStatusClass; ?>">Status: <?= $orderStatusLabel; ?></span>
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold <?= $payStatusClass; ?>">Pembayaran: <?= $payStatusLabel; ?></span>
                            </div>
                        </div>

                        <!-- Order Detail Info -->
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-100 flex-shrink-0">
                                <?php if ($order['foto_1']): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($order['foto_1']); ?>" 
                                         alt="<?= htmlspecialchars($order['nama_produk']); ?>" 
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-2xl">📦</div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-900 truncate"><?= htmlspecialchars($order['nama_produk']); ?></h3>
                                <p class="text-sm text-slate-500 mt-0.5">Jumlah: <span class="font-semibold text-slate-700"><?= number_format($order['jumlah'], 1, ',', '.'); ?> kg</span></p>
                                <p class="text-sm text-slate-500">Harga: <span class="font-semibold text-slate-700">Rp <?= number_format($order['harga_satuan'], 0, ',', '.'); ?> / kg</span></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-500 font-medium">Total Harga</p>
                                <p class="font-black text-emerald-600 text-lg">Rp <?= number_format($order['total_harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>

                        <!-- Shipping Address / Method Info -->
                        <div class="mt-4 pt-4 border-t border-slate-100 bg-slate-50 rounded-2xl p-4 flex gap-3 items-start">
                            <div class="text-emerald-600 flex-shrink-0 mt-0.5">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <div class="text-sm">
                                <p class="font-bold text-slate-800">Alamat / Metode Pengiriman:</p>
                                <p class="text-slate-600 mt-1"><?= htmlspecialchars($order['alamat_pengiriman']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>
