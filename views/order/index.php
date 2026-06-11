<main class="flex-1 bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8" data-aos="fade-right">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl">Order Masuk</h1>
            <p class="mt-2 text-sm text-slate-600 sm:text-base">Kelola pesanan masuk dan respon transaksi untuk produk limbah Anda.</p>
        </div>
        <!-- Tabs -->
        <div class="flex border-b border-slate-200 mb-8" data-aos="fade-right">
            <a href="?tab=ongoing" class="flex-1 py-4 text-center font-bold text-sm border-b-2 transition-all <?= ($data['active_tab'] === 'ongoing') ? 'border-emerald-600 text-emerald-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' ?>">
                Daftar Order <span class="ml-1.5 px-2 py-0.5 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700"><?= $data['ongoing_count']; ?></span>
            </a>
            <a href="?tab=selesai" class="flex-1 py-4 text-center font-bold text-sm border-b-2 transition-all <?= ($data['active_tab'] === 'selesai') ? 'border-emerald-600 text-emerald-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' ?>">
                Order Selesai <span class="ml-1.5 px-2 py-0.5 text-xs font-bold rounded-full bg-slate-100 text-slate-600"><?= $data['selesai_count']; ?></span>
            </a>
        </div>

        <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
            <?php if (empty($data['orders'])): ?>
                <div class="bg-white rounded-3xl p-12 text-center shadow-xl border border-slate-100">
                    <div class="w-24 h-24 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <?php if ($data['active_tab'] === 'ongoing'): ?>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pesanan Aktif</h3>
                        <p class="text-slate-500 max-w-md mx-auto">Saat ini belum ada pesanan aktif/dalam proses dari pembeli. Terus kelola dan perbarui katalog produk Anda.</p>
                    <?php else: ?>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pesanan Selesai</h3>
                        <p class="text-slate-500 max-w-md mx-auto">Saat ini belum ada riwayat pesanan yang selesai atau dibatalkan.</p>
                    <?php endif; ?>
                    <a href="<?= BASEURL; ?>/produksaya" class="mt-6 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-full text-white bg-emerald-600 hover:bg-emerald-700 transition transform hover:-translate-y-0.5 shadow-md">
                        Kelola Produk Saya
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
                                $orderStatusLabel = 'Dibatalkan';
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

                        <!-- Buyer Information -->
                        <div class="mb-4 bg-emerald-50/50 rounded-2xl p-4 border border-emerald-100/50 flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 font-extrabold shadow-inner flex-shrink-0">
                                <?= strtoupper(substr($order['nama_pembeli'], 0, 1)); ?>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-500 font-medium">Pembeli</p>
                                <p class="font-bold text-slate-800 truncate"><?= htmlspecialchars($order['nama_pembeli']); ?> <span class="font-normal text-slate-500 text-xs">(<?= htmlspecialchars($order['email_pembeli']); ?>)</span></p>
                            </div>
                        </div>

                        <!-- Order Detail Info -->
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200">
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
                                <p class="text-sm text-slate-500 mt-0.5">Jumlah Pesanan: <span class="font-semibold text-slate-700"><?= number_format($order['jumlah'], 1, ',', '.'); ?> kg</span></p>
                                <p class="text-sm text-slate-500">Harga Satuan: <span class="font-semibold text-slate-700">Rp <?= number_format($order['harga_satuan'], 0, ',', '.'); ?> / kg</span></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-500 font-medium">Total Harga</p>
                                <p class="font-black text-emerald-600 text-lg">Rp <?= number_format($order['total_harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>

                        <!-- Shipping Address / Method Info -->
                        <div class="mt-4 grid gap-4 sm:grid-cols-2">
                            <div class="pt-4 border-t border-slate-100 bg-slate-50 rounded-2xl p-4 flex gap-3 items-start">
                                <div class="text-emerald-600 flex-shrink-0 mt-0.5">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                </div>
                                <div class="text-sm min-w-0">
                                    <p class="font-bold text-slate-800">Alamat & Opsi Pengiriman:</p>
                                    <p class="text-slate-600 mt-1 truncate-3-lines"><?= htmlspecialchars($order['alamat_pengiriman']); ?></p>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-slate-100 bg-slate-50 rounded-2xl p-4 flex gap-3 items-start">
                                <div class="text-amber-500 flex-shrink-0 mt-0.5">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="text-sm min-w-0">
                                    <p class="font-bold text-slate-800">Metode & Catatan:</p>
                                    <p class="text-slate-600 mt-1"><span class="font-medium text-slate-700">Metode:</span> <?= strtoupper(htmlspecialchars($order['metode_pembayaran'])); ?></p>
                                    <?php if (!empty($order['catatan'])): ?>
                                        <p class="text-slate-500 italic mt-1 text-xs truncate">"<?= htmlspecialchars($order['catatan']); ?>"</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons based on order status -->
                        <?php if (in_array($order['status_order'], ['pending', 'diproses', 'dikirim'])): ?>
                            <div class="mt-5 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-end gap-3">
                                <?php if ($order['status_order'] === 'pending'): ?>
                                    <button onclick="updateOrderStatus('<?= $order['order_id']; ?>', 'dibatalkan', this)" 
                                            class="px-5 py-2 text-sm font-bold text-red-600 hover:text-red-700 border border-red-200 hover:bg-red-50 rounded-full transition duration-300">
                                        Tolak Pesanan
                                    </button>
                                    <button onclick="updateOrderStatus('<?= $order['order_id']; ?>', 'diproses', this)" 
                                            class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-full shadow-md transition transform hover:-translate-y-0.5 duration-300">
                                        Terima & Proses
                                    </button>
                                <?php elseif ($order['status_order'] === 'diproses'): ?>
                                    <button onclick="updateOrderStatus('<?= $order['order_id']; ?>', 'dibatalkan', this)" 
                                            class="px-5 py-2 text-sm font-bold text-red-600 hover:text-red-700 border border-red-200 hover:bg-red-50 rounded-full transition duration-300">
                                        Batalkan Pesanan
                                    </button>
                                    <button onclick="updateOrderStatus('<?= $order['order_id']; ?>', 'dikirim', this)" 
                                            class="px-6 py-2.5 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow-md transition transform hover:-translate-y-0.5 duration-300">
                                        Kirim Barang
                                    </button>
                                <?php elseif ($order['status_order'] === 'dikirim'): ?>
                                    <button onclick="updateOrderStatus('<?= $order['order_id']; ?>', 'dibatalkan', this)" 
                                            class="px-5 py-2 text-sm font-bold text-red-600 hover:text-red-700 border border-red-200 hover:bg-red-50 rounded-full transition duration-300">
                                        Batalkan Pesanan
                                    </button>
                                    <button onclick="updateOrderStatus('<?= $order['order_id']; ?>', 'selesai', this)" 
                                            class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-full shadow-md transition transform hover:-translate-y-0.5 duration-300">
                                        Selesaikan Pesanan
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- PHP Pagination Controls -->
            <?php if (isset($data['pages']) && $data['pages'] > 1): ?>
                <div class="p-6 border border-slate-100 bg-white rounded-3xl shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6">
                    <p class="text-sm text-slate-500">
                        Halaman <?= $data['current_page'] ?> dari <?= max(1, $data['pages']) ?> (Total: <?= $data['total'] ?> Order)
                    </p>
                    <div class="flex items-center gap-2">
                        <?php if ($data['current_page'] > 1): ?>
                            <a href="?page=<?= $data['current_page'] - 1 ?>&tab=<?= $data['active_tab'] ?>" class="px-4 py-2 text-xs font-bold rounded-full border text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-emerald-500 hover:text-emerald-600 transition">Sebelumnya</a>
                        <?php else: ?>
                            <button disabled class="px-4 py-2 text-xs font-bold rounded-full border text-slate-300 border-slate-100 cursor-not-allowed">Sebelumnya</button>
                        <?php endif; ?>

                        <?php for($i = 1; $i <= $data['pages']; $i++): ?>
                            <a href="?page=<?= $i ?>&tab=<?= $data['active_tab'] ?>" class="h-8 w-8 text-xs font-bold flex items-center justify-center rounded-full transition border <?= $i == $data['current_page'] ? 'bg-emerald-600 border-emerald-600 text-white' : 'border-slate-200 text-slate-600 hover:border-emerald-500' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($data['current_page'] < $data['pages']): ?>
                            <a href="?page=<?= $data['current_page'] + 1 ?>&tab=<?= $data['active_tab'] ?>" class="px-4 py-2 text-xs font-bold rounded-full border text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-emerald-500 hover:text-emerald-600 transition">Selanjutnya</a>
                        <?php else: ?>
                            <button disabled class="px-4 py-2 text-xs font-bold rounded-full border text-slate-300 border-slate-100 cursor-not-allowed">Selanjutnya</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        let baseUrl = '<?= BASEURL; ?>';
        if (window.location.protocol === 'https:' && baseUrl.startsWith('http:')) {
            baseUrl = baseUrl.replace('http:', 'https:');
        }

        function updateOrderStatus(orderId, newStatus, buttonElement) {
            let statusText = '';
            switch(newStatus) {
                case 'diproses': statusText = 'diproses'; break;
                case 'dikirim': statusText = 'dikirim'; break;
                case 'selesai': statusText = 'selesai'; break;
                case 'dibatalkan': statusText = 'dibatalkan/ditolak'; break;
            }

            if (!confirm(`Apakah Anda yakin ingin mengubah status pesanan ${orderId} menjadi "${statusText}"?`)) {
                return;
            }

            // Save original HTML and disable buttons in the same container
            const container = buttonElement.parentElement;
            const buttons = container.querySelectorAll('button');
            const originalStates = [];

            buttons.forEach(btn => {
                originalStates.push({
                    btn: btn,
                    html: btn.innerHTML,
                    disabled: btn.disabled
                });
                btn.disabled = true;
            });

            // Set loading state on the clicked button
            buttonElement.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg> Memproses...`;

            fetch(`${baseUrl}/order/respon/${orderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_token(); ?>'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(async (response) => {
                const text = await response.text();
                try {
                    return JSON.parse(text);
                } catch(e) {
                    console.error("Non-JSON response:", text);
                    throw new Error("Gagal mengurai respons dari server.");
                }
            })
            .then(data => {
                if (data.success) {
                    // Refresh current view to update states
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal memperbarui status pesanan.');
                    // Restore buttons state
                    originalStates.forEach(state => {
                        state.btn.disabled = state.disabled;
                        state.btn.innerHTML = state.html;
                    });
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                alert(error.message || 'Terjadi kesalahan koneksi atau sistem.');
                // Restore buttons state
                originalStates.forEach(state => {
                    state.btn.disabled = state.disabled;
                    state.btn.innerHTML = state.html;
                });
            });
        }
    </script>
</main>
