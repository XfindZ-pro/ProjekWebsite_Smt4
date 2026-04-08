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
                    <?php
                        // Logika warna status database
                        if (isset($data['db_status']) && $data['db_status'] === true) {
                            $bg_status = "bg-emerald-100 text-emerald-700 border-emerald-300 shadow-sm shadow-emerald-200";
                            $title_status = "Database Terhubung!";
                        } else {
                            $bg_status = "bg-red-100 text-red-600 border-red-300 shadow-sm shadow-red-200 animate-pulse";
                            $title_status = "Database Terputus / Tidak Ditemukan!";
                        }
                    ?>
                    <a href="<?= BASEURL; ?>" 
                       title="<?= $title_status ?>"
                       class="text-2xl font-extrabold tracking-wider px-3 py-1 rounded-lg border <?= $bg_status ?> transition-all duration-300">
                        VALORA
                    </a>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="<?= BASEURL; ?>" class="<?= ($data['aktif'] == 'beranda') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">Beranda</a>
                    <a href="<?= BASEURL; ?>/katalog" class="<?= ($data['aktif'] == 'katalog') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">Katalog</a>
                    <a href="<?= BASEURL; ?>/tentang" class="<?= ($data['aktif'] == 'tentang') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">Tentang Kami</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-4">
                    <?php if(isset($_SESSION['user_nama'])) : ?>
                        <a href="<?= BASEURL; ?>/profile" class="flex items-center space-x-3 bg-slate-50 px-4 py-2 rounded-full border border-slate-200 hover:bg-slate-100 transition shadow-sm">
                            <span class="text-slate-700 font-bold text-sm tracking-wide"><?= $_SESSION['user_nama']; ?></span>
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user_nama']); ?>&background=10b981&color=fff&size=512" 
                                 alt="Profil" 
                                 class="w-10 h-10 rounded-full object-cover border-2 border-emerald-500 shadow-sm">
                        </a>
                        <a href="<?= BASEURL; ?>/logout" class="text-red-500 font-medium hover:text-red-700 transition text-sm ml-2">Keluar</a>
                    <?php else : ?>
                        <a href="<?= BASEURL; ?>/login" class="text-emerald-600 font-medium hover:text-emerald-700 transition">Masuk</a>
                        <a href="<?= BASEURL; ?>/register" class="bg-emerald-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-emerald-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Daftar</a>
                    <?php endif; ?>
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
                    <?php if(isset($_SESSION['user_nama'])) : ?>
                        <a href="<?= BASEURL; ?>/profile" class="block text-center text-slate-700 font-medium py-2 hover:bg-slate-50 rounded-lg border border-slate-300">Profil Saya</a>
                        <a href="<?= BASEURL; ?>/logout" class="block text-center text-red-600 font-medium py-2 hover:bg-red-50 rounded-lg border border-red-200">Keluar</a>
                    <?php else : ?>
                        <a href="<?= BASEURL; ?>/login" class="block text-center text-emerald-600 font-medium py-2 hover:bg-emerald-50 rounded-lg border border-emerald-600">Masuk</a>
                        <a href="<?= BASEURL; ?>/register" class="block text-center bg-emerald-600 text-white py-2 rounded-lg font-medium hover:bg-emerald-700">Daftar</a>
                    <?php endif; ?>
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