<main class="flex-1 bg-slate-50 py-10 overflow-hidden">
    
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .modal-active {
            overflow: hidden;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <form action="<?= BASEURL; ?>/caribahanbaku" method="GET" class="flex flex-col md:flex-row gap-4 mb-8" data-aos="fade-down">
            <input type="hidden" name="kategori" value="<?= htmlspecialchars($data['current_filter']['kategori'] ?? 'semua'); ?>">
            
            <div class="flex-1 relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="<?= htmlspecialchars($data['current_filter']['keyword'] ?? ''); ?>" placeholder="Cari material sisa..." class="block w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl bg-white focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 shadow-sm transition-all duration-300">
            </div>
            <div class="flex gap-3">
                <select name="sort" class="block w-40 pl-4 pr-10 py-3.5 text-sm border border-slate-200 rounded-2xl bg-white shadow-sm cursor-pointer focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 transition-all">
                    <option value="terbaru" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'terbaru') ? 'selected' : ''; ?>>Terbaru</option>
                    <option value="harga_min" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'harga_min') ? 'selected' : ''; ?>>Harga Terendah</option>
                    <option value="harga_max" <?= (isset($data['current_filter']['sort']) && $data['current_filter']['sort'] == 'harga_max') ? 'selected' : ''; ?>>Harga Tertinggi</option>
                </select>
                <button type="submit" class="px-8 py-3.5 rounded-2xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                    Cari
                </button>
            </div>
        </form>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="w-full lg:w-64 flex-shrink-0 space-y-6" data-aos="fade-right">
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-5">Kategori</h3>
                    <ul class="space-y-2">
                        <?php 
                        $categories = ['semua' => 'Semua kategori', 'Tekstil' => 'Tekstil & kain', 'Plastik' => 'Plastik & polimer', 'Kertas' => 'Kertas & kardus', 'Logam' => 'Logam & besi', 'Kayu' => 'Kayu & furnitur', 'Kaca' => 'Kaca & keramik', 'Lainnya' => 'Lainnya'];
                        $current_cat = $data['current_filter']['kategori'] ?? 'semua';
                        
                        foreach($categories as $val => $label) : 
                            $isActive = ($current_cat === $val);
                        ?>
                            <li>
                                <a href="<?= BASEURL; ?>/caribahanbaku?kategori=<?= urlencode($val); ?>" class="flex items-center px-4 py-2.5 text-sm <?= $isActive ? 'font-bold rounded-xl bg-emerald-50 text-emerald-700' : 'font-medium rounded-xl text-slate-600 hover:bg-slate-50'; ?> transition-all">
                                    <span class="w-2 h-2 rounded-full <?= $isActive ? 'bg-emerald-500' : 'bg-slate-300'; ?> mr-3"></span>
                                    <?= $label; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>

            <div class="flex-1">
                <div class="flex justify-between items-center mb-6" data-aos="fade-in">
                    <h2 class="text-lg font-extrabold text-slate-900"><?= count($data['katalog'] ?? []); ?> Produk Ditemukan</h2>
                </div>

                <?php if (empty($data['katalog'])) : ?>
                    <div class="bg-white rounded-3xl border border-dashed border-slate-300 p-20 text-center" data-aos="zoom-in">
                        <div class="mx-auto mb-5 flex h-24 w-24 items-center justify-center rounded-full bg-slate-50 text-slate-300 text-5xl">🔍</div>
                        <h2 class="text-2xl font-bold text-slate-900">Produk tidak ditemukan</h2>
                        <p class="mt-2 text-slate-500">Coba gunakan kata kunci lain.</p>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php 
                        $delay = 200;
                        foreach ($data['katalog'] as $item) : 
                            // Menyiapkan data JSON untuk dikirim ke Modal
                            $fotoBase64 = $item['foto_1'] ? base64_encode($item['foto_1']) : null;
                            $productData = [
                                'nama' => htmlspecialchars($item['nama_produk']),
                                'harga' => number_format($item['harga_per_kg'], 0, ',', '.'),
                                'kategori' => $item['kategori_limbah'],
                                'berat' => $item['berat_tersedia'],
                                'lokasi' => htmlspecialchars($item['lokasi_pickup']),
                                'kondisi' => htmlspecialchars($item['kondisi_fisik'] ?? 'Sisa Produksi'),
                                'kemasan' => htmlspecialchars($item['metode_pengemasan'] ?? 'Tanpa Kemasan'),
                                'deskripsi' => nl2br(htmlspecialchars($item['deskripsi'])),
                                'foto' => $fotoBase64
                            ];
                        ?>
                            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 group" 
                                 data-aos="fade-up" data-aos-delay="<?= $delay; ?>">
                                
                                <div class="h-44 bg-slate-100 relative overflow-hidden flex items-center justify-center">
                                    <?php if($item['foto_1']) : ?>
                                        <img src="data:image/jpeg;base64,<?= $fotoBase64; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <?php else: ?>
                                        <span class="text-6xl">📦</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="p-6">
                                    <h3 class="text-base font-bold text-slate-900 mb-1.5 truncate"><?= $productData['nama']; ?></h3>
                                    <p class="text-2xl font-black text-emerald-600 mb-4">Rp <?= $productData['harga']; ?><span class="text-sm font-medium text-slate-400">/kg</span></p>
                                    
                                    <div class="flex gap-3">
                                        <button class="flex-1 bg-emerald-600 text-white py-3 rounded-2xl font-bold hover:bg-emerald-700 active:scale-95 transition-all shadow-md">
                                            Hubungi
                                        </button>
                                        <button onclick='openDetailModal(<?= json_encode($productData); ?>)' 
                                                class="px-5 bg-slate-50 text-slate-600 border border-slate-200 rounded-2xl font-bold hover:bg-white hover:text-emerald-600 hover:border-emerald-200 transition-all">
                                            Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php $delay += 100; endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="productDetailModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm transition-all duration-300">
        <div class="relative w-full max-w-2xl rounded-[32px] bg-white shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
            
            <button onclick="closeDetailModal()" class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-black/20 text-white hover:bg-black/40 backdrop-blur-md transition">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="flex flex-col md:flex-row h-full max-h-[90vh] overflow-y-auto">
                <div class="md:w-1/2 bg-slate-100 flex items-center justify-center min-h-[300px]">
                    <img id="modalImg" src="" class="w-full h-full object-cover" alt="Foto Produk">
                    <div id="modalImgPlaceholder" class="hidden text-6xl">📦</div>
                </div>

                <div class="md:w-1/2 p-8">
                    <span id="modalCategory" class="text-[10px] font-black tracking-widest text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full uppercase">KATEGORI</span>
                    <h2 id="modalTitle" class="text-2xl font-bold text-slate-900 mt-3 mb-1">Nama Produk</h2>
                    <p id="modalPrice" class="text-2xl font-black text-emerald-600 mb-6">Rp 0</p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-sm text-slate-600">
                            <span class="w-8 h-8 flex items-center justify-center bg-slate-50 rounded-lg mr-3">📍</span>
                            <span id="modalLocation">-</span>
                        </div>
                        <div class="flex items-center text-sm text-slate-600">
                            <span class="w-8 h-8 flex items-center justify-center bg-slate-50 rounded-lg mr-3">⚖️</span>
                            Stok: <span id="modalStock" class="font-bold text-slate-900 ml-1">0 kg</span>
                        </div>
                        <div class="flex items-center text-sm text-slate-600">
                            <span class="w-8 h-8 flex items-center justify-center bg-slate-50 rounded-lg mr-3">🔍</span>
                            Kondisi: <span id="modalCondition" class="font-bold text-slate-900 ml-1">-</span>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-6">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Deskripsi Produk</h4>
                        <p id="modalDesc" class="text-sm text-slate-600 leading-relaxed max-h-40 overflow-y-auto pr-2">Deskripsi...</p>
                    </div>

                    <button class="w-full mt-8 bg-emerald-600 text-white py-4 rounded-2xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-100 active:scale-95 transition-all">
                        Hubungi Penjual Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('productDetailModal');
        const modalContent = document.getElementById('modalContent');

        function openDetailModal(data) {
            // Isi data ke elemen modal
            document.getElementById('modalTitle').innerText = data.nama;
            document.getElementById('modalPrice').innerHTML = `Rp ${data.harga}<span class="text-sm font-medium text-slate-400">/kg</span>`;
            document.getElementById('modalCategory').innerText = data.kategori;
            document.getElementById('modalLocation').innerText = data.lokasi;
            document.getElementById('modalStock').innerText = `${data.berat} kg`;
            document.getElementById('modalCondition').innerText = data.kondisi;
            document.getElementById('modalDesc').innerHTML = data.deskripsi;

            const modalImg = document.getElementById('modalImg');
            const placeholder = document.getElementById('modalImgPlaceholder');

            if(data.foto) {
                modalImg.src = `data:image/jpeg;base64,${data.foto}`;
                modalImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                modalImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }

            // Tampilkan modal
            document.body.classList.add('modal-active');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDetailModal() {
            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('modal-active');
            }, 300);
        }

        // Tutup modal jika klik di luar area konten
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeDetailModal();
        });
    </script>
</main>