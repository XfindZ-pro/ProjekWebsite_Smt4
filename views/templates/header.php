<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valora - Transformasi Limbah Menjadi Nilai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?= BASEURL; ?>" class="text-2xl font-extrabold text-emerald-600 tracking-wider">
                        VALORA
                    </a>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="<?= BASEURL; ?>" class="<?= ($data['aktif'] == 'beranda') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">Beranda</a>
                    <a href="<?= BASEURL; ?>/katalog" class="<?= ($data['aktif'] == 'katalog') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">Katalog</a>
                    <a href="<?= BASEURL; ?>/tentang" class="<?= ($data['aktif'] == 'tentang') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">Tentang Kami</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="text-emerald-600 font-medium hover:text-emerald-700 transition">Masuk</a>
                    <a href="#" class="bg-emerald-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-emerald-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Daftar</a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-slate-600 hover:text-emerald-600 focus:outline-none">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 shadow-lg absolute w-full z-50">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="<?= BASEURL; ?>" class="block px-3 py-2 rounded-md text-base font-medium <?= ($data['aktif'] == 'beranda') ? 'text-emerald-600 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' ?>">Beranda</a>
                <a href="<?= BASEURL; ?>/katalog" class="block px-3 py-2 rounded-md text-base font-medium <?= ($data['aktif'] == 'katalog') ? 'text-emerald-600 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' ?>">Katalog</a>
                <a href="<?= BASEURL; ?>/tentang" class="block px-3 py-2 rounded-md text-base font-medium <?= ($data['aktif'] == 'tentang') ? 'text-emerald-600 bg-emerald-50' : 'text-slate-600 hover:text-emerald-600 hover:bg-slate-50' ?>">Tentang Kami</a>
                
                <div class="border-t border-slate-100 pt-4 flex flex-col space-y-3">
                    <a href="#" class="block text-center text-emerald-600 font-medium py-2 hover:bg-emerald-50 rounded-lg border border-emerald-600">Masuk</a>
                    <a href="#" class="block text-center bg-emerald-600 text-white py-2 rounded-lg font-medium hover:bg-emerald-700">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>