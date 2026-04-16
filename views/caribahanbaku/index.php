<main class="flex-1 bg-slate-50 py-10 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <form action="<?= BASEURL; ?>/caribahanbaku" method="GET" 
              class="flex flex-col md:flex-row gap-4 mb-8" 
              data-aos="fade-down" data-aos-duration="600">
            
            <input type="hidden" name="kategori" value="<?= htmlspecialchars($data['current_filter']['kategori'] ?? 'semua'); ?>">
            
            <div class="flex-1 relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="<?= htmlspecialchars($data['current_filter']['keyword'] ?? ''); ?>" placeholder="Cari material sisa..." 
                       class="block w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl bg-white focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 shadow-sm transition-all duration-300">
            </div>
            <div class="flex gap-3">
                <select name="sort" class="block w-40 pl-4 pr-10 py-3.5 text-sm border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 rounded-2xl bg-white shadow-sm transition-all duration-300 cursor-pointer">
                    <option value="terbaru" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'terbaru') ? 'selected' : ''; ?>>Terbaru</option>
                    <option value="harga_min" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'harga_min') ? 'selected' : ''; ?>>Harga Terendah</option>
                    <option value="harga_max" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'harga_max') ? 'selected' : ''; ?>>Harga Tertinggi</option>
                </select>
                <button type="submit" class="px-8 py-3.5 rounded-2xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                    Cari
                </button>
            </div>
        </form>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="w-full lg:w-64 flex-shrink-0 space-y-6" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100">
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-5">Kategori Material</h3>
                    <ul class="space-y-2">
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
                                <a href="<?= $link; ?>" class="group flex items-center px-4 py-2.5 text-sm <?= $isActive ? 'font-bold rounded-xl bg-emerald-50 text-emerald-700 shadow-inner' : 'font-medium rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:translate-x-1'; ?> transition-all duration-300">
                                    <span class="w-2 h-2 rounded-full <?= $isActive ? 'bg-emerald-500 scale-125 shadow-sm shadow-emerald-300' : 'bg-slate-300 group-hover:bg-slate-400'; ?> mr-3 transition-all duration-300"></span>
                                    <?= $cat_label; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>

            <div class="flex-1">
                <div class="flex justify-between items-center mb-6" data-aos="fade-in" data-aos-delay="200">
                    <h2 class="text-lg font-extrabold text-slate-900"><?= count($data['katalog'] ?? []); ?> Produk Ditemukan</h2>
                    <span class="text-[10px] font-black tracking-wider text-emerald-700 bg-emerald-100 px-4 py-2 rounded-full uppercase flex items-center gap-1.5 shadow-sm">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Terverifikasi
                    </span>
                </div>

                <?php if (empty($data['katalog'])) : ?>
                    <div class="bg-white rounded-3xl border border-dashed border-slate-300 p-20 text-center" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="300">
                        <div class="mx-auto mb-5 flex h-24 w-24 items-center justify-center rounded-full bg-slate-50 text-slate-300 text-5xl shadow-inner">🔍</div>
                        <h2 class="text-2xl font-bold text-slate-900">Produk tidak ditemukan</h2>
                        <p class="mt-2 text-slate-500">Coba gunakan kata kunci lain atau ubah filter kategori Anda.</p>
                        <a href="<?= BASEURL; ?>/caribahanbaku" class="mt-8 inline-block rounded-full border-2 border-slate-200 px-8 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:border-slate-300 active:scale-95 transition-all duration-300">Hapus Semua Filter</a>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                        <?php 
                        $delay = 200; // Mulai delay dari 200ms
                        foreach ($data['katalog'] as $item) : 
                        ?>
                            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-emerald-100 hover:-translate-y-2 hover:border-emerald-300 transition-all duration-500 group cursor-pointer" 
                                 data-aos="fade-up" data-aos-duration="600" data-aos-delay="<?= $delay; ?>">
                                
                                <div class="h-44 bg-slate-100 relative overflow-hidden flex items-center justify-center">
                                    <?php if($item['foto_1']) : ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($item['foto_1']); ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
                                    <?php else: ?>
                                        <span class="text-6xl transform group-hover:scale-125 transition-transform duration-500 ease-out drop-shadow-md">📦</span>
                                    <?php endif; ?>
                                    
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-white/95 backdrop-blur-sm px-4 py-1.5 rounded-full text-[10px] font-black text-emerald-800 shadow-sm uppercase tracking-widest border border-white/50">
                                            <?= htmlspecialchars($item['kategori_limbah']); ?>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <h3 class="text-base font-bold text-slate-900 mb-1.5 truncate group-hover:text-emerald-700 transition-colors duration-300"><?= htmlspecialchars($item['nama_produk']); ?></h3>
                                    <p class="text-2xl font-black text-emerald-600 mb-3 tracking-tight">Rp <?= number_format($item['harga_per_kg'], 0, ',', '.'); ?><span class="text-sm font-medium text-slate-400">/kg</span></p>
                                    
                                    <div class="space-y-2 mb-6">
                                        <div class="flex items-center text-xs text-slate-500 font-medium">
                                            <span class="w-5 h-5 flex items-center justify-center bg-slate-100 rounded-full mr-2">📍</span>
                                            <?= htmlspecialchars($item['lokasi_pickup']); ?>
                                        </div>
                                        <div class="flex items-center text-xs text-slate-500 font-medium">
                                            <span class="w-5 h-5 flex items-center justify-center bg-slate-100 rounded-full mr-2">📦</span>
                                            Stok: <span class="font-bold text-slate-700 ml-1"><?= htmlspecialchars($item['berat_tersedia']); ?> kg</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex gap-3">
                                        <button class="flex-1 bg-emerald-600 text-white py-3 rounded-2xl font-bold hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 active:scale-95 transition-all duration-300">
                                            Hubungi Penjual
                                        </button>
                                        <button class="px-4 bg-slate-50 text-slate-400 border border-slate-200 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 active:scale-95 transition-all duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        $delay += 100; // Menambahkan delay 100ms untuk setiap kartu (Staggered effect)
                        endforeach; 
                        ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($data['katalog'])) : ?>
                <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
                    <nav class="inline-flex rounded-2xl shadow-sm bg-white border border-slate-200 p-1" aria-label="Pagination">
                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors cursor-not-allowed">
                            ← Sebelumnya
                        </a>
                        <a href="#" aria-current="page" class="bg-emerald-600 text-white inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold shadow-sm">
                            1
                        </a>
                        <a href="#" class="text-slate-500 hover:bg-slate-50 hover:text-emerald-600 inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold transition-all">
                            2
                        </a>
                        <a href="#" class="text-slate-500 hover:bg-slate-50 hover:text-emerald-600 inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold transition-all">
                            3
                        </a>
                        <a href="#" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 hover:text-emerald-600 transition-colors">
                            Selanjutnya →
                        </a>
                    </nav>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                once: true, // Animasi hanya berjalan satu kali saat di-scroll
                offset: 50, // Mulai animasi ketika elemen berjarak 50px dari bawah layar
            });
        });
    </script>
</main>