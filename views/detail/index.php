<main class="flex-1 bg-slate-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <div class="mb-8">
            <a href="<?= BASEURL; ?>/caribahanbaku" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold transition">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- Product Detail Container -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column - Image (2 cols on desktop) -->
            <div class="lg:col-span-2" data-aos="fade-right">
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-slate-100">
                    <!-- Main Image -->
                    <div class="aspect-square bg-slate-100 flex items-center justify-center overflow-hidden">
                        <?php if ($data['produk']['foto_1']): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($data['produk']['foto_1']); ?>" 
                                 alt="<?= htmlspecialchars($data['produk']['nama_produk']); ?>" 
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <span class="text-9xl">📦</span>
                        <?php endif; ?>
                    </div>

                    <!-- Additional Images -->
                    <?php if ($data['produk']['foto_2'] || $data['produk']['foto_3']): ?>
                        <div class="flex gap-4 p-6 bg-white border-t border-slate-100">
                            <?php if ($data['produk']['foto_2']): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($data['produk']['foto_2']); ?>" 
                                     alt="Foto 2" 
                                     class="w-24 h-24 rounded-xl object-cover cursor-pointer hover:shadow-md transition border border-slate-200">
                            <?php endif; ?>
                            <?php if ($data['produk']['foto_3']): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($data['produk']['foto_3']); ?>" 
                                     alt="Foto 3" 
                                     class="w-24 h-24 rounded-xl object-cover cursor-pointer hover:shadow-md transition border border-slate-200">
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column - Details & Purchase (1 col) -->
            <div data-aos="fade-left">
                
                <!-- Product Info Card -->
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-100 sticky top-20">
                    
                    <!-- Category Badge -->
                    <span class="inline-block text-xs font-black tracking-widest text-emerald-700 bg-emerald-100 px-4 py-2 rounded-full uppercase mb-4">
                        <?= htmlspecialchars($data['produk']['kategori_limbah']); ?>
                    </span>

                    <!-- Product Name -->
                    <h1 class="text-xl font-black text-slate-900 mb-4 leading-tight">
                        <?= htmlspecialchars($data['produk']['nama_produk']); ?>
                    </h1>

                    <!-- Rating and Reviews Summary -->
                    <?php if ($data['rating_summary']['count'] > 0): ?>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex items-center text-amber-400">
                                <?php 
                                $avgRating = $data['rating_summary']['rating'];
                                for ($i = 1; $i <= 5; $i++): 
                                    if ($i <= round($avgRating)): ?>
                                        <span class="text-base">★</span>
                                    <?php else: ?>
                                        <span class="text-base text-slate-200">★</span>
                                    <?php endif; 
                                endfor; ?>
                            </div>
                            <span class="text-sm font-bold text-slate-700"><?= $avgRating; ?></span>
                            <span class="text-xs text-slate-400 font-medium">(<?= $data['rating_summary']['count']; ?> ulasan)</span>
                        </div>
                    <?php endif; ?>

                    <!-- Price Prominent -->
                    <div class="mb-6 pb-6 border-b-2 border-slate-200">
                        <p class="text-3xl font-black text-emerald-600">
                            Rp <?= number_format($data['produk']['harga_per_kg'], 0, ',', '.'); ?>
                        </p>
                        <p class="text-sm text-slate-500 mt-1">per kilogram</p>
                    </div>

                    <!-- Product Details Compact -->
                    <div class="space-y-3 mb-6 pb-6 border-b-2 border-slate-200">
                        
                        <!-- Berat Tersedia -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l.4-2H5.4M7 13L5.4 5M7 13l1.286 6.429A2 2 0 009.215 21h5.57a2 2 0 001.927-1.571L17 13M17 13l.4 2m0 0h2M9 6h6m0 0V3m0 3v3" />
                                </svg>
                                <p class="text-sm text-slate-600">Berat Tersedia</p>
                            </div>
                            <p class="font-bold text-slate-900"><?= number_format($data['produk']['berat_tersedia'], 2, ',', '.'); ?> kg</p>
                        </div>

                        <!-- Min Order -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-slate-600">Minimal Pesanan</p>
                            </div>
                            <p class="font-bold text-slate-900"><?= number_format($data['produk']['min_order'], 2, ',', '.'); ?> kg</p>
                        </div>

                        <!-- Lokasi Pickup -->
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <p class="text-sm text-slate-600">Lokasi Pickup</p>
                            </div>
                            <p class="font-bold text-slate-900 text-right text-sm"><?= htmlspecialchars($data['produk']['lokasi_pickup']); ?></p>
                        </div>

                        <!-- Kondisi Fisik -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <p class="text-sm text-slate-600">Kondisi Fisik</p>
                            </div>
                            <p class="font-bold text-slate-900"><?= htmlspecialchars($data['produk']['kondisi_fisik']); ?></p>
                        </div>
                    </div>

                    <!-- Seller Info -->
                    <?php if ($data['penjual']): ?>
                        <div class="mb-6">
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-bold mb-3">Penjual</p>
                            <div class="flex items-center gap-3">
                                <?php
                                    $fotoUrl = "https://ui-avatars.com/api/?name=" . urlencode($data['penjual']['nama']) . "&background=10b981&color=fff&size=128";
                                    if (!empty($data['penjual']['foto_profil'])) {
                                        $fotoUrl = 'data:image/jpeg;base64,' . base64_encode($data['penjual']['foto_profil']);
                                    }
                                ?>
                                <img src="<?= $fotoUrl; ?>" 
                                     alt="<?= htmlspecialchars($data['penjual']['nama']); ?>" 
                                     class="w-14 h-14 rounded-full object-cover border-2 border-emerald-500 flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-slate-900"><?= htmlspecialchars($data['penjual']['nama']); ?></p>
                                    <p class="text-xs text-emerald-600 font-semibold">Terverifikasi ✓</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Buy Button -->
                    <?php 
                    $isSeller = isset($_SESSION['user_akun_id']) && $_SESSION['user_akun_id'] == $data['produk']['penjual_id'];
                    if ($isSeller): 
                    ?>
                        <button disabled class="w-full bg-slate-400 text-white py-3.5 rounded-2xl font-bold text-lg cursor-not-allowed shadow-md">
                            Anda Penjual Produk Ini
                        </button>
                    <?php else: ?>
                        <a href="<?= BASEURL; ?>/checkout/<?= $data['produk']['produk_id']; ?>" class="block w-full text-center bg-emerald-600 text-white py-3.5 rounded-2xl font-bold text-lg hover:bg-emerald-700 active:scale-95 transition-all shadow-lg hover:shadow-xl">
                            Beli Sekarang
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="mt-12 bg-white rounded-3xl p-8 shadow-xl border border-slate-100" data-aos="fade-up">
            <h2 class="text-2xl font-black text-slate-900 mb-4">Deskripsi Produk</h2>
            <div class="text-slate-600 leading-relaxed whitespace-pre-wrap">
                <?= htmlspecialchars($data['produk']['deskripsi'] ?? 'Tidak ada deskripsi'); ?>
            </div>
        </div>

        <!-- Product Reviews Section -->
        <div class="mt-12 bg-white rounded-3xl p-8 shadow-xl border border-slate-100" data-aos="fade-up" id="ulasan-section">
            <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-3">
                <span>Ulasan Pelanggan</span>
                <?php if ($data['rating_summary']['count'] > 0): ?>
                    <span class="inline-flex items-center justify-center bg-emerald-50 text-emerald-700 text-sm font-bold px-3 py-1 rounded-full">
                        <?= $data['rating_summary']['count']; ?>
                    </span>
                <?php endif; ?>
            </h2>

            <?php if (empty($data['reviews'])): ?>
                <!-- No Reviews State -->
                <div class="text-center py-10 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    <span class="text-5xl block mb-3">💬</span>
                    <h3 class="font-bold text-slate-800 text-lg mb-1">Belum Ada Ulasan</h3>
                    <p class="text-slate-500 text-sm">Produk ini belum pernah diulas oleh pembeli.</p>
                </div>
            <?php else: ?>
                <!-- Reviews Container -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Rating Breakdown Box (1/4 columns) -->
                    <div class="md:col-span-1 bg-slate-50 rounded-2xl p-6 flex flex-col items-center justify-center border border-slate-100 h-fit">
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-2 text-center">Rata-rata Rating</p>
                        <p class="text-6xl font-black text-slate-900 mb-2 leading-none"><?= $data['rating_summary']['rating']; ?></p>
                        <div class="flex text-amber-400 text-xl mb-2">
                            <?php 
                            $avgRating = $data['rating_summary']['rating'];
                            for ($i = 1; $i <= 5; $i++): 
                                if ($i <= round($avgRating)): ?>
                                    <span>★</span>
                                <?php else: ?>
                                    <span class="text-slate-200">★</span>
                                <?php endif; 
                            endfor; ?>
                        </div>
                        <p class="text-xs text-slate-400 font-bold"><?= $data['rating_summary']['count']; ?> Ulasan Pembeli</p>
                    </div>

                    <!-- Reviews List (3/4 columns) -->
                    <div class="md:col-span-3 space-y-6">
                        <?php foreach ($data['reviews'] as $review): ?>
                            <div class="border-b border-slate-100 pb-6 last:border-b-0 last:pb-0">
                                <div class="flex items-start justify-between gap-4 mb-3">
                                    <div class="flex items-center gap-3">
                                        <?php
                                            $reviewerFoto = "https://ui-avatars.com/api/?name=" . urlencode($review['nama_pembeli']) . "&background=10b981&color=fff&size=100";
                                            if (!empty($review['foto_pembeli'])) {
                                                $reviewerFoto = 'data:image/jpeg;base64,' . base64_encode($review['foto_pembeli']);
                                            }
                                        ?>
                                        <img src="<?= $reviewerFoto; ?>" 
                                             alt="<?= htmlspecialchars($review['nama_pembeli']); ?>" 
                                             class="w-10 h-10 rounded-full object-cover bg-slate-200">
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm"><?= htmlspecialchars($review['nama_pembeli']); ?></p>
                                            <p class="text-xs text-slate-400"><?= date('d M Y, H:i', strtotime($review['created_at'])); ?></p>
                                        </div>
                                    </div>

                                    <!-- Rating Star Display -->
                                    <div class="flex text-amber-400 text-sm">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $review['rating']): ?>
                                                <span>★</span>
                                            <?php else: ?>
                                                <span class="text-slate-200">★</span>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                                <!-- Comment -->
                                <div class="text-sm text-slate-600 leading-relaxed italic" style="padding-left: 3.25rem;">
                                    <?php if (!empty($review['komentar'])): ?>
                                        "<?= htmlspecialchars($review['komentar']); ?>"
                                    <?php else: ?>
                                        <span class="text-slate-400 text-xs font-medium italic">Tidak ada komentar.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Pagination Controls -->
                        <?php if ($data['pages'] > 1): ?>
                            <div class="flex items-center justify-center gap-2 pt-6 border-t border-slate-100">
                                <!-- Previous Page -->
                                <?php if ($data['current_page'] > 1): ?>
                                    <a href="?page=<?= $data['current_page'] - 1; ?>#ulasan-section" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition shadow-sm">
                                        ‹
                                    </a>
                                <?php else: ?>
                                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 text-slate-300 cursor-not-allowed">
                                        ‹
                                    </span>
                                <?php endif; ?>

                                <!-- Page Numbers -->
                                <?php for ($p = 1; $p <= $data['pages']; $p++): ?>
                                    <?php if ($p == $data['current_page']): ?>
                                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-600 text-white font-bold text-sm shadow-md">
                                            <?= $p; ?>
                                        </span>
                                    <?php else: ?>
                                        <a href="?page=<?= $p; ?>#ulasan-section" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 text-slate-600 text-sm hover:bg-slate-50 transition shadow-sm">
                                            <?= $p; ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <!-- Next Page -->
                                <?php if ($data['current_page'] < $data['pages']): ?>
                                    <a href="?page=<?= $data['current_page'] + 1; ?>#ulasan-section" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition shadow-sm">
                                        ›
                                    </a>
                                <?php else: ?>
                                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 text-slate-300 cursor-not-allowed">
                                        ›
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</main>


