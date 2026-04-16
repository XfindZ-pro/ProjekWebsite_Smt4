<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-slate-900">Pasarkan Sisa Produksi</h1>
            <p class="mt-2 text-slate-600">Lengkapi detail material agar calon pembeli dapat memahami nilai limbah Anda.</p>
        </div>

        <div class="mb-12 flex items-center justify-center space-x-4">
            <div id="step1-indicator" class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-white font-bold transition-all duration-300">1</div>
            <div class="h-1 w-16 bg-slate-200 rounded"></div>
            <div id="step2-indicator" class="flex h-10 w-10 items-center justify-center rounded-full bg-white border-2 border-slate-200 text-slate-400 font-bold transition-all duration-300">2</div>
        </div>

        <form action="<?= BASEURL; ?>/jualan/proses" method="POST" enctype="multipart/form-data" class="space-y-8">
            
            <div id="section-step1" class="space-y-6 animate-fade-in-up">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Langkah 1: Detail Material</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Nama Produk / Material <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_produk" required placeholder="Contoh: Sisa Kain Perca Katun" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kategori Limbah</label>
                            <select name="kategori_limbah" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                                <option value="Tekstil">Tekstil</option>
                                <option value="Plastik">Plastik</option>
                                <option value="Kertas">Kertas</option>
                                <option value="Logam">Logam</option>
                                <option value="Kaca">Kaca</option>
                                <option value="Kayu">Kayu</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Lokasi Penjemputan <span class="text-red-500">*</span></label>
                            <input type="text" name="lokasi_pickup" required placeholder="Contoh: Sidoarjo" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Berat Tersedia (Kg) <span class="text-red-500">*</span></label>
                            <input type="number" name="berat_tersedia" required placeholder="Contoh: 500" min="1" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Harga Per Kg (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="harga_per_kg" required placeholder="Contoh: 2500" min="0" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Minimal Order (Kg) <span class="text-red-500">*</span></label>
                            <input type="number" name="min_order" required value="1" min="1" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kondisi Harga</label>
                            <select name="kondisi_harga" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                                <option value="Bisa Negosiasi">Bisa Negosiasi</option>
                                <option value="Harga Pas">Harga Pas</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kondisi Fisik Material</label>
                            <select name="kondisi_fisik" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                                <option value="Sisa Potongan (Bersih)">Sisa Potongan (Bersih)</option>
                                <option value="Campur / Kotor">Campur / Kotor</option>
                                <option value="Cacahan">Cacahan</option>
                                <option value="Bekas Pakai">Bekas Pakai</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Metode Pengemasan</label>
                            <select name="metode_pengemasan" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                                <option value="Karung">Karung</option>
                                <option value="Kardus">Kardus</option>
                                <option value="Diikat / Bending">Diikat / Bending</option>
                                <option value="Tanpa Kemasan">Tanpa Kemasan (Curah)</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="deskripsi" required rows="4" placeholder="Jelaskan kualitas, warna dominan, atau detail lain mengenai limbah produksi ini..." class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all"></textarea>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <button type="button" onclick="nextStep()" class="rounded-full bg-emerald-600 px-8 py-3 font-bold text-white hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">Lanjut ke Foto</button>
                    </div>
                </div>
            </div>

            <div id="section-step2" class="hidden space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Langkah 2: Visual & Bukti Fisik</h2>
                    <div class="grid gap-6">
                        <p class="text-sm text-slate-500">Unggah foto material asli untuk meningkatkan kepercayaan pembeli. Foto yang jelas akan meningkatkan peluang terjual.</p>
                        
                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 border-dashed hover:border-emerald-500 transition-colors">
                                <label class="block text-xs font-bold text-slate-700 mb-2">Foto Utama (Wajib) <span class="text-red-500">*</span></label>
                                <input type="file" name="foto_1" accept="image/*" required class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 cursor-pointer">
                            </div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 border-dashed hover:border-emerald-500 transition-colors">
                                <label class="block text-xs font-bold text-slate-700 mb-2">Foto 2 (Opsional)</label>
                                <input type="file" name="foto_2" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 cursor-pointer">
                            </div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 border-dashed hover:border-emerald-500 transition-colors">
                                <label class="block text-xs font-bold text-slate-700 mb-2">Foto 3 (Opsional)</label>
                                <input type="file" name="foto_3" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 cursor-pointer">
                            </div>
                        </div>

                        <div class="mt-4 pt-6 border-t border-slate-100">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Dokumen Pendukung (Opsional)</label>
                            <p class="text-xs text-slate-500 mb-4">Lampirkan sertifikat lab, hasil uji material, atau Material Safety Data Sheet (MSDS) jika limbah termasuk kategori bahan kimia/khusus.</p>
                            <input type="file" name="dokumen_pendukung" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        </div>
                    </div>
                    
                    <div class="mt-10 flex justify-between items-center">
                        <button type="button" onclick="prevStep()" class="text-slate-500 font-bold hover:text-slate-900 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </button>
                        <div class="space-x-3 flex">
                            <button type="submit" name="draft" value="1" class="rounded-full border-2 border-slate-200 px-6 py-3 font-bold text-slate-600 hover:bg-slate-50 hover:border-slate-300 active:scale-95 transition-all duration-300">Simpan Draft</button>
                            <button type="submit" class="rounded-full bg-emerald-600 px-10 py-3 font-bold text-white hover:bg-emerald-700 shadow-lg hover:shadow-emerald-200 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">Tayangkan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>

    <script>
        function nextStep() {
            // Validasi Sederhana: Pastikan input wajib di Langkah 1 sudah diisi
            const reqInputs = document.querySelectorAll('#section-step1 input[required], #section-step1 textarea[required]');
            let allValid = true;
            reqInputs.forEach(input => {
                if(!input.value) {
                    input.classList.add('border-red-500', 'ring-1', 'ring-red-500');
                    allValid = false;
                } else {
                    input.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
                }
            });

            if(!allValid) {
                alert('Harap lengkapi semua bidang yang wajib (bertanda *) sebelum melanjutkan.');
                return;
            }

            document.getElementById('section-step1').classList.add('hidden');
            document.getElementById('section-step2').classList.remove('hidden');
            document.getElementById('section-step2').classList.add('animate-fade-in-up');
            
            document.getElementById('step2-indicator').classList.replace('bg-white', 'bg-emerald-600');
            document.getElementById('step2-indicator').classList.replace('text-slate-400', 'text-white');
            document.getElementById('step2-indicator').classList.replace('border-slate-200', 'border-emerald-600');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        function prevStep() {
            document.getElementById('section-step2').classList.add('hidden');
            document.getElementById('section-step1').classList.remove('hidden');
            document.getElementById('section-step1').classList.add('animate-fade-in-up');
            
            document.getElementById('step2-indicator').classList.replace('bg-emerald-600', 'bg-white');
            document.getElementById('step2-indicator').classList.replace('text-white', 'text-slate-400');
            document.getElementById('step2-indicator').classList.replace('border-emerald-600', 'border-slate-200');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</main>