<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">Cari Bahan Baku</p>
            <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Temukan bahan baku sisa produksi yang Anda butuhkan</h1>
            <p class="mt-4 text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">Jelajahi ratusan listing bahan baku untuk kebutuhan industri, UMKM, dan proyek kreatif. Mulai dengan kata kunci, lokasi, atau volume untuk hasil pencarian yang relevan.</p>
        </div>

        <div class="rounded-[32px] border border-slate-200 bg-white shadow-sm p-8 mb-10">
            <form class="grid gap-6 lg:grid-cols-[1.5fr_1fr]">
                <div class="space-y-4">
                    <label for="bahanInput" class="block text-sm font-medium text-slate-700">Jenis bahan baku</label>
                    <input id="bahanInput" type="text" placeholder="Contoh: plastik, kardus, kain, logam" class="block w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                </div>

                <div class="space-y-4">
                    <label for="lokasiInput" class="block text-sm font-medium text-slate-700">Lokasi</label>
                    <input id="lokasiInput" type="text" placeholder="Contoh: Jakarta, Surabaya, Bandung" class="block w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                </div>

                <div class="lg:col-span-2 grid gap-4 lg:grid-cols-[1fr_auto] items-end">
                    <div class="space-y-4">
                        <label for="volumeInput" class="block text-sm font-medium text-slate-700">Volume minimum</label>
                        <input id="volumeInput" type="text" placeholder="Contoh: 100 kg" class="block w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" />
                    </div>
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-3xl bg-emerald-600 px-8 py-4 text-base font-semibold text-white shadow-md hover:bg-emerald-700 transition">Mulai Cari</button>
                </div>
            </form>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11a4 4 0 100-8 4 4 0 000 8zm-4 9a8 8 0 1116 0H4z"/></svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-900">Pencarian Cepat</h2>
                <p class="mt-3 text-slate-600 text-sm">Cari bahan baku berdasarkan jenis, lokasi, dan volume dalam satu tampilan yang mudah digunakan.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3m6 0a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.4 15.4A7.976 7.976 0 0112 20a7.976 7.976 0 01-8.4-4.6"/></svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-900">Ketersediaan Terpercaya</h2>
                <p class="mt-3 text-slate-600 text-sm">Katalog bahan baku yang dikurasi dari pemasok aktif untuk memastikan kecocokan material dan kualitas.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m4 4h1m-6 4h6a2 2 0 002-2V8a2 2 0 00-2-2h-6L7 7v9a2 2 0 002 2z"/></svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-900">Komunikasi Langsung</h2>
                <p class="mt-3 text-slate-600 text-sm">Hubungi pemasok bahan baku secara langsung untuk negosiasi cepat dan pemesanan yang lebih mudah.</p>
            </div>
        </div>
    </div>
</main>
