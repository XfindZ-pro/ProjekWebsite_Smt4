<div class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    
    <div class="absolute inset-0 bg-slate-50 opacity-50 z-0"></div>

    <div class="max-w-lg w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl relative z-10 border border-slate-100" data-aos="fade-up" data-aos-duration="600">
        <div>
            <h2 class="mt-2 text-center text-3xl font-extrabold text-slate-900 tracking-tight">
                Bergabung dengan Valora
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                Buat akun untuk mulai membeli atau menjual sisa produksi
            </p>
        </div>
        
        <form class="mt-8 space-y-5" action="#" method="POST">
            
            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700">Nama Lengkap / Nama Bisnis</label>
                <input id="nama" name="nama" type="text" required class="appearance-none relative block w-full px-4 py-3 mt-1 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition shadow-sm" placeholder="Budi Santoso">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                <input id="email" name="email" type="email" required class="appearance-none relative block w-full px-4 py-3 mt-1 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition shadow-sm" placeholder="nama@email.com">
            </div>

            <div>
                <label for="peran" class="block text-sm font-medium text-slate-700">Daftar Sebagai</label>
                <select id="peran" name="peran" required class="block w-full px-4 py-3 mt-1 border border-slate-300 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition shadow-sm bg-white">
                    <option value="" disabled selected>Pilih peran kamu...</option>
                    <option value="pabrik">Pabrik / Produsen (Penjual Sisa Bahan)</option>
                    <option value="umkm">UMKM / Industri Kreatif (Pembeli Sisa Bahan)</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none relative block w-full px-4 py-3 mt-1 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition shadow-sm" placeholder="••••••••">
                </div>
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input id="confirm_password" name="confirm_password" type="password" required class="appearance-none relative block w-full px-4 py-3 mt-1 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition shadow-sm" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center mt-4">
                <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-slate-300 rounded cursor-pointer">
                <label for="terms" class="ml-2 block text-sm text-slate-600 cursor-pointer">
                    Saya setuju dengan <a href="#" class="text-emerald-600 hover:underline">Syarat & Ketentuan</a> Valora
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition transform hover:-translate-y-0.5 shadow-md">
                    Buat Akun
                </button>
            </div>
        </form>

        <div class="text-center mt-4 border-t border-slate-100 pt-6">
            <p class="text-sm text-slate-600">
                Sudah punya akun? 
                <a href="<?= BASEURL; ?>/login" class="font-bold text-emerald-600 hover:text-emerald-500 transition">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>