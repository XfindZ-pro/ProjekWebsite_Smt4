<main class="flex-1 bg-slate-50 py-10 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900">Produk Saya</h1>
                <p class="mt-2 text-slate-600">Kelola material sisa produksi yang sedang Anda pasarkan.</p>
            </div>
            <a href="<?= BASEURL; ?>/jualan"
                class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-md hover:bg-emerald-700 hover:-translate-y-0.5 transition transform text-center">
                + Tambah Produk
            </a>
        </div>

        <?php if (empty($data['katalog'])): ?>
            <div class="bg-white rounded-3xl border border-dashed border-slate-300 p-20 text-center" data-aos="zoom-in">
                <div
                    class="mx-auto mb-5 flex h-24 w-24 items-center justify-center rounded-full bg-slate-50 text-slate-300 text-5xl shadow-inner">
                    📦</div>
                <h2 class="text-2xl font-bold text-slate-900">Belum ada produk</h2>
                <p class="mt-2 text-slate-500">Anda belum mengunggah limbah atau material sisa produksi apapun.</p>
                <a href="<?= BASEURL; ?>/jualan"
                    class="mt-8 inline-block rounded-full border-2 border-slate-200 px-8 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 transition">Mulai
                    Berjualan</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php
                $delay = 100;
                foreach ($data['katalog'] as $item):
                    ?>
                    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg hover:border-emerald-300 transition-all duration-300 group flex flex-col"
                        data-aos="fade-up" data-aos-delay="<?= $delay; ?>">

                        <div class="h-44 bg-slate-100 relative overflow-hidden flex items-center justify-center">
                            <?php if ($item['foto_1']): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($item['foto_1']); ?>"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <?php else: ?>
                                <span class="text-6xl text-slate-300">📦</span>
                            <?php endif; ?>

                            <div class="absolute top-3 left-3">
                                <?php
                                $status_bg = 'bg-slate-100 text-slate-700 border-slate-200';
                                if ($item['status_produk'] == 'aktif')
                                    $status_bg = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                                if ($item['status_produk'] == 'draft')
                                    $status_bg = 'bg-amber-100 text-amber-800 border-amber-200';
                                ?>
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-black shadow-sm uppercase border <?= $status_bg ?>">
                                    <?= htmlspecialchars($item['status_produk']); ?>
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-sm font-bold text-slate-900 mb-1 line-clamp-2">
                                <?= htmlspecialchars($item['nama_produk']); ?></h3>
                            <p class="text-xl font-black text-emerald-600 mb-3">Rp
                                <?= number_format($item['harga_per_kg'], 0, ',', '.'); ?><span
                                    class="text-xs font-medium text-slate-400">/kg</span></p>

                            <div class="text-xs text-slate-500 mb-4 flex-1">
                                <p>Stok: <span
                                        class="font-bold text-slate-700"><?= htmlspecialchars($item['berat_tersedia']); ?>
                                        kg</span></p>
                            </div>

                            <div class="flex gap-2 pt-4 border-t border-slate-100">
                                <a href="<?= BASEURL; ?>/produksaya/edit/<?= $item['produk_id']; ?>"
                                    class="flex-1 bg-white text-slate-700 py-2.5 rounded-xl text-xs font-bold border border-slate-200 hover:bg-slate-50 hover:border-emerald-500 hover:text-emerald-600 text-center transition">
                                    Edit
                                </a>
                                <a href="<?= BASEURL; ?>/produksaya/hapus/<?= $item['produk_id']; ?>"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                    class="flex-1 bg-red-50 text-red-600 py-2.5 rounded-xl text-xs font-bold border border-red-100 hover:bg-red-100 hover:text-red-700 text-center transition">
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $delay += 100;
                endforeach;
                ?>
            </div>
        <?php endif; ?>
    </div>
</main>