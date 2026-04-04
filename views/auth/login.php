<div class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    
    <div class="absolute inset-0 bg-emerald-50 opacity-50 z-0"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob z-0"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 z-0"></div>

    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl relative z-10 border border-slate-100" data-aos="zoom-in" data-aos-duration="600">
        <div>
            <h2 class="mt-2 text-center text-3xl font-extrabold text-slate-900 tracking-tight">
                Selamat Datang Kembali
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                Masuk ke akun Valora kamu
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="#" method="POST">
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input id="email" name="email" type="email" required class="appearance-none relative block w-full px-4 py-3 mt-1 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition shadow-sm" placeholder="nama@email.com">
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-500 transition">Lupa password?</a>
                    </div>
                    <input id="password" name="password" type="password" required class="appearance-none relative block w-full px-4 py-3 mt-1 border border-slate-300 placeholder-slate-400 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition shadow-sm" placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition transform hover:-translate-y-0.5 shadow-md">
                    Masuk
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-slate-600">
                Belum punya akun? 
                <a href="<?= BASEURL; ?>/register" class="font-bold text-emerald-600 hover:text-emerald-500 transition">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>