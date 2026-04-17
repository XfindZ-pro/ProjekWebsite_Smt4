<div class="py-10 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-full">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="<?= BASEURL; ?>/produksaya" class="group flex h-10 w-10 items-center justify-center rounded-full bg-white border border-slate-200 text-slate-400 hover:border-emerald-500 hover:text-emerald-600 transition-all shadow-sm">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Edit Katalog Produk</h1>
                <p class="text-sm text-slate-500">ID Produk: <span class="font-mono font-bold"><?= $data['produk']['produk_id']; ?></span></p>
            </div>
        </div>

        <form action="<?= BASEURL; ?>/produksaya/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="produk_id" value="<?= $data['produk']['produk_id']; ?>">
            
            <div class="space-y-6">
                <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 text-xs">1</span>
                        Informasi Material
                    </h2>
                    
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Nama Produk / Material</label>
                            <input type="text" name="nama_produk" required value="<?= htmlspecialchars($data['produk']['nama_produk']); ?>" 
                                   class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kategori Limbah</label>
                            <select name="kategori_limbah" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                                <?php $cats = ['Tekstil', 'Plastik', 'Kertas', 'Logam', 'Kaca', 'Kayu', 'Lainnya']; 
                                foreach($cats as $c) : ?>
                                    <option value="<?= $c ?>" <?= ($data['produk']['kategori_limbah'] == $c) ? 'selected' : '' ?>><?= $c ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Lokasi Pickup</label>
                            <input type="text" name="lokasi_pickup" required value="<?= htmlspecialchars($data['produk']['lokasi_pickup']); ?>" 
                                   class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Berat Tersedia (Kg)</label>
                            <input type="number" name="berat_tersedia" required value="<?= $data['produk']['berat_tersedia']; ?>" 
                                   class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Harga Jual (Rp/Kg)</label>
                            <input type="number" name="harga_per_kg" required value="<?= $data['produk']['harga_per_kg']; ?>" 
                                   class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Minimal Order (Kg)</label>
                            <input type="number" name="min_order" required value="<?= htmlspecialchars($data['produk']['min_order']); ?>" 
                                   class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kondisi Harga</label>
                            <select name="kondisi_harga" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                                <option value="Bisa Negosiasi" <?= ($data['produk']['kondisi_harga'] == 'Bisa Negosiasi') ? 'selected' : '' ?>>Bisa Negosiasi</option>
                                <option value="Harga Pas" <?= ($data['produk']['kondisi_harga'] == 'Harga Pas') ? 'selected' : '' ?>>Harga Pas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 text-xs">2</span>
                        Spesifikasi Lengkap
                    </h2>
                    
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Deskripsi Produk</label>
                            <textarea name="deskripsi" rows="5" required 
                                      class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all"><?= htmlspecialchars($data['produk']['deskripsi']); ?></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kondisi Fisik</label>
                            <select name="kondisi_fisik" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                                <option value="Sisa Potongan (Bersih)" <?= ($data['produk']['kondisi_fisik'] == 'Sisa Potongan (Bersih)') ? 'selected' : '' ?>>Sisa Potongan (Bersih)</option>
                                <option value="Campur / Kotor" <?= ($data['produk']['kondisi_fisik'] == 'Campur / Kotor') ? 'selected' : '' ?>>Campur / Kotor</option>
                                <option value="Cacahan" <?= ($data['produk']['kondisi_fisik'] == 'Cacahan') ? 'selected' : '' ?>>Cacahan</option>
                                <option value="Bekas Pakai" <?= ($data['produk']['kondisi_fisik'] == 'Bekas Pakai') ? 'selected' : '' ?>>Bekas Pakai</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Metode Pengemasan</label>
                            <select name="metode_pengemasan" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                                <option value="Karung" <?= ($data['produk']['metode_pengemasan'] == 'Karung') ? 'selected' : '' ?>>Karung</option>
                                <option value="Kardus" <?= ($data['produk']['metode_pengemasan'] == 'Kardus') ? 'selected' : '' ?>>Kardus</option>
                                <option value="Diikat / Bending" <?= ($data['produk']['metode_pengemasan'] == 'Diikat / Bending') ? 'selected' : '' ?>>Diikat / Bending</option>
                                <option value="Tanpa Kemasan" <?= ($data['produk']['metode_pengemasan'] == 'Tanpa Kemasan') ? 'selected' : '' ?>>Tanpa Kemasan (Curah)</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Status Penayangan</label>
                            <select name="status_produk" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                                <option value="aktif" <?= ($data['produk']['status_produk'] == 'aktif') ? 'selected' : '' ?>>Aktif (Tampil di Katalog)</option>
                                <option value="draft" <?= ($data['produk']['status_produk'] == 'draft') ? 'selected' : '' ?>>Draft (Sembunyikan dari Katalog)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-2 flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 text-xs">3</span>
                        Pembaruan Foto (Opsional)
                    </h2>
                    <p class="text-xs text-slate-500 mb-6 pl-9">Abaikan bagian ini jika Anda tidak ingin mengubah foto. Foto lama akan otomatis dipertahankan.</p>
                    
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 border-dashed hover:border-emerald-500 transition-colors">
                            <label class="block text-xs font-bold text-slate-700 mb-2">Foto Utama Baru</label>
                            <input type="file" name="foto_1" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 cursor-pointer">
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 border-dashed hover:border-emerald-500 transition-colors">
                            <label class="block text-xs font-bold text-slate-700 mb-2">Foto 2 Baru</label>
                            <input type="file" name="foto_2" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 cursor-pointer">
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 border-dashed hover:border-emerald-500 transition-colors">
                            <label class="block text-xs font-bold text-slate-700 mb-2">Foto 3 Baru</label>
                            <input type="file" name="foto_3" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pb-12">
                    <a href="<?= BASEURL; ?>/produksaya" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
                    <button type="submit" class="rounded-full bg-emerald-600 px-10 py-4 font-bold text-white shadow-lg shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>