<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-slate-900">Pasarkan Sisa Produksi</h1>
            <p class="mt-2 text-slate-600">Lengkapi detail material agar calon pembeli dapat memahami nilai limbah Anda.</p>
        </div>

        <div class="mb-12 flex items-center justify-center space-x-4">
            <div id="step1-indicator" class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-white font-bold">1</div>
            <div class="h-1 w-16 bg-slate-200 rounded"></div>
            <div id="step2-indicator" class="flex h-10 w-10 items-center justify-center rounded-full bg-white border-2 border-slate-200 text-slate-400 font-bold">2</div>
        </div>

        <form action="<?= BASEURL; ?>/jualan/proses" method="POST" enctype="multipart/form-data" class="space-y-8">
            
            <div id="section-step1" class="space-y-6 animate-fade-in">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Langkah 1: Detail Material</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Nama Produk / Material</label>
                            <input type="text" name="nama_produk" required placeholder="Contoh: Sisa Kain Perca Katun" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kategori Limbah</label>
                            <select name="kategori_limbah" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500">
                                <option value="Tekstil">Tekstil</option>
                                <option value="Plastik">Plastik</option>
                                <option value="Kertas">Kertas</option>
                                <option value="Logam">Logam</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Lokasi Penjemputan</label>
                            <input type="text" name="lokasi_pickup" required placeholder="Kota / Kecamatan" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Berat Tersedia (Kg)</label>
                            <input type="number" name="berat_tersedia" required class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Harga Per Kg (Rp)</label>
                            <input type="number" name="harga_per_kg" required class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Deskripsi Kondisi & Pengemasan</label>
                            <textarea name="deskripsi" rows="4" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500"></textarea>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <button type="button" onclick="nextStep()" class="rounded-full bg-emerald-600 px-8 py-3 font-bold text-white hover:bg-emerald-700 transition">Lanjut ke Foto</button>
                    </div>
                </div>
            </div>

            <div id="section-step2" class="hidden space-y-6 animate-fade-in">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Langkah 2: Visual & Bukti Fisik</h2>
                    <div class="grid gap-6">
                        <p class="text-sm text-slate-500">Unggah foto material asli untuk meningkatkan kepercayaan pembeli (Min. 1 Foto Utama).</p>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <input type="file" name="foto_1" required class="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                            <input type="file" name="foto_2" class="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-50 file:text-slate-700">
                            <input type="file" name="foto_3" class="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-50 file:text-slate-700">
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <label class="block text-sm font-semibold text-slate-700">Dokumen Pendukung (Opsional)</label>
                            <input type="file" name="dokumen_pendukung" class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="prevStep()" class="text-slate-600 font-bold hover:text-slate-900">Kembali</button>
                        <div class="space-x-3">
                            <button type="submit" name="draft" class="rounded-full border border-slate-300 px-6 py-3 font-bold text-slate-700 hover:bg-slate-50 transition">Simpan Draft</button>
                            <button type="submit" class="rounded-full bg-emerald-600 px-10 py-3 font-bold text-white hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition">Tayangkan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        function nextStep() {
            document.getElementById('section-step1').classList.add('hidden');
            document.getElementById('section-step2').classList.remove('hidden');
            document.getElementById('step2-indicator').classList.replace('bg-white', 'bg-emerald-600');
            document.getElementById('step2-indicator').classList.replace('text-slate-400', 'text-white');
            window.scrollTo(0, 0);
        }
        function prevStep() {
            document.getElementById('section-step2').classList.add('hidden');
            document.getElementById('section-step1').classList.remove('hidden');
            document.getElementById('step2-indicator').classList.replace('bg-emerald-600', 'bg-white');
            document.getElementById('step2-indicator').classList.replace('text-white', 'text-slate-400');
            window.scrollTo(0, 0);
        }
    </script>
</main>