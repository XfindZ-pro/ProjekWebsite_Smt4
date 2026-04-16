<main class="flex-1 bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <form action="<?= BASEURL; ?>/caribahanbaku" method="GET" class="flex flex-col md:flex-row gap-4 mb-6">
            <input type="hidden" name="kategori" value="<?= htmlspecialchars($data['current_filter']['kategori'] ?? 'semua'); ?>">
            
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="<?= htmlspecialchars($data['current_filter']['keyword'] ?? ''); ?>" placeholder="Cari produk limbah..." class="block w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 sm:text-sm shadow-sm transition">
            </div>
            <div class="flex gap-3">
                <select name="sort" class="block w-40 pl-3 pr-10 py-2.5 text-base border border-slate-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-lg bg-white shadow-sm transition">
                    <option value="terbaru" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'terbaru') ? 'selected' : ''; ?>>Terbaru</option>
                    <option value="harga_min" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'harga_min') ? 'selected' : ''; ?>>Harga Terendah</option>
                    <option value="harga_max" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'harga_max') ? 'selected' : ''; ?>>Harga Tertinggi</option>
                </select>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none transition">
                    Filter
                </button>
            </div>
        </form>

        <div class="flex flex-col lg:flex-row gap-6">
            
            <div class="w-full lg:w-64 flex-shrink-0 space-y-6">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-4">Kategori</h3>
                    <ul class="space-y-1.5">
                        <?php 
                        $categories = [
                            'semua' => 'Semua kategori',
                            'Logam & besi' => 'Logam & besi',
                            'Plastik & polimer' => 'Plastik & polimer',
                            'Kertas & kardus' => 'Kertas & kardus',
                            'Elektronik (e-waste)' => 'Elektronik (e-waste)',
                            'Kaca & keramik' => 'Kaca & keramik',
                            'Tekstil & kain' => 'Tekstil & kain',
                            'Kayu & furnitur' => 'Kayu & furnitur',
                            'Bahan kimia' => 'Bahan kimia',
                            'Lainnya' => 'Lainnya'
                        ];
                        $current_cat = $data['current_filter']['kategori'] ?? 'semua';
                        $current_search = $data['current_filter']['keyword'] ?? '';
                        $current_sort = $data['current_filter']['sort'] ?? 'terbaru';
                        
                        foreach($categories as $cat_value => $cat_label) : 
                            $isActive = ($current_cat === $cat_value);
                            $link = BASEURL . "/caribahanbaku?kategori=" . urlencode($cat_value) . "&search=" . urlencode($current_search) . "&sort=" . urlencode($current_sort);
                        ?>
                            <li>
                                <a href="<?= $link; ?>" class="flex items-center px-3 py-2 text-sm <?= $isActive ? 'font-semibold rounded-lg bg-emerald-50 text-emerald-700' : 'font-medium rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900'; ?> transition">
                                    <span class="w-1.5 h-1.5 rounded-full <?= $isActive ? 'bg-emerald-500' : 'bg-slate-400'; ?> mr-3"></span>
                                    <?= $cat_label; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-4">Rentang Harga</h3>
                    <div class="space-y-3">
                        <div>
                            <input type="number" placeholder="Min (Rp/kg)" class="block w-full pl-4 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 sm:text-sm transition">
                        </div>
                        <div>
                            <input type="number" placeholder="Max (Rp/kg)" class="block w-full pl-4 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 sm:text-sm transition">
                        </div>
                    </div>

                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider mt-6 mb-4">Lokasi</h3>
                    <div>
                        <select class="block w-full pl-4 pr-10 py-2 text-base border border-slate-200 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-lg bg-white transition">
                            <option>Semua Lokasi</option>
                            <option>Sidoarjo</option>
                            <option>Surabaya</option>
                            <option>Gresik</option>
                            <option>Malang</option>
                        </select>
                    </div>

                    <button type="button" class="mt-6 w-full inline-flex justify-center items-center px-4 py-2.5 border border-transparent text-sm font-bold rounded-lg shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none transition">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <div class="flex-1">
                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-base font-bold text-slate-900"><?= count($data['katalog'] ?? []); ?> produk ditemukan</h2>
                    <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">Semua terverifikasi admin</span>
                </div>

                <?php if (empty($data['katalog'])) : ?>
                    <div class="bg-white rounded-3xl border border-dashed border-slate-300 p-20 text-center">
                        <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-slate-50 text-slate-300 text-4xl">🔍</div>
                        <h2 class="text-xl font-bold text-slate-900">Produk tidak ditemukan</h2>
                        <p class="mt-2 text-slate-500">Coba gunakan kata kunci lain atau ubah filter kategori Anda.</p>
                        <a href="<?= BASEURL; ?>/caribahanbaku" class="mt-6 inline-block rounded-full border border-slate-300 px-6 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Hapus Semua Filter</a>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-5">
                        <?php foreach ($data['katalog'] as $item) : ?>
                            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md hover:border-emerald-300 transition duration-300 group">
                                <div class="h-36 bg-emerald-50 flex items-center justify-center relative overflow-hidden">
                                    <?php if($item['foto_1']) : ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($item['foto_1']); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                    <?php else: ?>
                                        <span class="text-5xl transform group-hover:scale-110 transition duration-300">📦</span>
                                    <?php endif; ?>
                                    
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-slate-700 shadow-sm uppercase"><?= htmlspecialchars($item['kategori_limbah']); ?></span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-sm font-bold text-slate-900 mb-1.5 truncate"><?= htmlspecialchars($item['nama_produk']); ?></h3>
                                    <p class="text-lg font-extrabold text-emerald-600 mb-2">Rp <?= number_format($item['harga_per_kg'], 0, ',', '.'); ?>/kg</p>
                                    <p class="text-xs text-slate-500 mb-5"><?= htmlspecialchars($item['berat_tersedia']); ?> kg tersedia • <?= htmlspecialchars($item['lokasi_pickup']); ?></p>
                                    <div class="flex justify-between items-center">
                                        <span class="px-2.5 py-1 text-[10px] font-bold text-emerald-700 bg-emerald-100 rounded-md">Terverifikasi</span>
                                        <button class="px-5 py-2 text-xs font-bold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 shadow-sm transition">Hubungi</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($data['katalog'])) : ?>
                <div class="mt-8 flex justify-center">
                    <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-slate-300 bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 cursor-not-allowed">
                            Sebelumnya
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-emerald-50 border-emerald-500 text-emerald-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="#" class="bg-white border-slate-300 text-slate-500 hover:bg-slate-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium cursor-not-allowed">
                            Selanjutnya
                        </a>
                    </nav>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>