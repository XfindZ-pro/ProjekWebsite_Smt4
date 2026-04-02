<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valora - Transformasi Limbah Menjadi Nilai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?= BASEURL; ?>" class="text-2xl font-extrabold text-emerald-600 tracking-wider">
                        VALORA
                    </a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="<?= BASEURL; ?>" 
                       class="<?= ($data['aktif'] == 'beranda') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">
                       Beranda
                    </a>
                    
                    <a href="<?= BASEURL; ?>/katalog" 
                       class="<?= ($data['aktif'] == 'katalog') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">
                       Katalog
                    </a>
                    
                    <a href="<?= BASEURL; ?>/tentang" 
                       class="<?= ($data['aktif'] == 'tentang') ? 'text-emerald-600 font-bold border-b-2 border-emerald-600 pb-1' : 'text-slate-600 hover:text-emerald-600 font-medium transition pb-1' ?>">
                       Tentang Kami
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-emerald-600 font-medium hover:text-emerald-700 transition">Masuk</a>
                    <a href="#" class="bg-emerald-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-emerald-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Daftar</a>
                </div>
            </div>
        </div>
    </nav>