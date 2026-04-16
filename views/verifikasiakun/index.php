<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">Verifikasi Akun</p>
            <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Verifikasi akun Anda untuk mulai berjualan</h1>
            <p class="mt-4 text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">Untuk memastikan keamanan dan kepercayaan di platform Valora, akun Anda perlu diverifikasi terlebih dahulu sebelum dapat memasarkan limbah atau barang bekas.</p>
        </div>

        <?php if (!empty($message)) : ?>
            <div class="mb-6 rounded-3xl border px-6 py-5 shadow-sm <?= ($message_type === 'success' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : (($message_type === 'error') ? 'border-red-200 bg-red-50 text-red-700' : 'border-slate-200 bg-slate-50 text-slate-700')) ?>">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($pending)) : ?>
            <div class="rounded-[32px] border border-slate-200 bg-white shadow-sm p-8 mb-10">
                <div class="space-y-6">
                    <div class="text-center">
                        <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 mb-4">
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Pengajuan sedang diproses</h2>
                        <p class="text-slate-600">Kami telah menerima dokumen Anda. Mohon tunggu sampai tim kami selesai meninjau dan menyetujui akun Anda.</p>
                    </div>

                    <div class="border-t border-slate-100 pt-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Apa yang akan terjadi selanjutnya:</h3>
                        <ul class="space-y-3 text-slate-600">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-emerald-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Tim kami meninjau data dan dokumen Anda
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-emerald-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Jika diterima, akun akan segera aktif untuk berjualan
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-slate-400 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Anda akan diberitahu jika perlu dokumen tambahan
                            </li>
                        </ul>
                    </div>

                    <div class="border-t border-slate-100 pt-6">
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="<?= BASEURL; ?>" class="inline-flex items-center justify-center px-6 py-3 border border-slate-300 text-base font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition">Kembali ke Beranda</a>
                            <a href="mailto:support@valora.id" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 transition">Hubungi Support</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <form action="<?= BASEURL; ?>/verifikasiakun/submit" method="post" enctype="multipart/form-data" class="rounded-[32px] border border-slate-200 bg-white shadow-sm p-8 mb-10">
                <div class="grid gap-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="jenis_entitas" class="block text-sm font-medium text-slate-700">Jenis Entitas</label>
                            <select id="jenis_entitas" name="jenis_entitas" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none">
                                <option value="">Pilih jenis entitas</option>
                                <option value="pabrik">Pabrik</option>
                                <option value="umkm">UMKM</option>
                            </select>
                        </div>
                        <div>
                            <label for="nama_usaha" class="block text-sm font-medium text-slate-700">Nama Usaha</label>
                            <input id="nama_usaha" name="nama_usaha" type="text" placeholder="Contoh: CV. Kreasi Limbah" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="nomor_telepon" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
                            <input id="nomor_telepon" name="nomor_telepon" type="text" placeholder="Contoh: 081234567890" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                        </div>
                        <div>
                            <label for="alamat_usaha" class="block text-sm font-medium text-slate-700">Alamat Usaha</label>
                            <input id="alamat_usaha" name="alamat_usaha" type="text" placeholder="Contoh: Jl. Industri No. 12, Bandung" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="file_ktp" class="block text-sm font-medium text-slate-700">Foto KTP</label>
                            <input id="file_ktp" name="file_ktp" type="file" accept="image/jpeg,image/png,application/pdf" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                        </div>
                        <div>
                            <label for="file_izin_usaha" class="block text-sm font-medium text-slate-700">File Izin Usaha</label>
                            <input id="file_izin_usaha" name="file_izin_usaha" type="file" accept="image/jpeg,image/png,application/pdf" class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-8 py-4 text-base font-semibold text-white shadow-md hover:bg-emerald-700 transition">Kirim Pengajuan</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

        <div class="text-center">
            <p class="text-slate-500 text-sm">Butuh bantuan? <a href="mailto:support@valora.id" class="text-emerald-600 hover:text-emerald-700 font-medium">Kirim email ke support@valora.id</a></p>
        </div>
    </div>
</main>
