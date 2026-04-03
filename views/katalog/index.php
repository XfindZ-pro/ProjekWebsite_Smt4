<?php
// Di sinilah nanti kita akan melakukan perulangan (looping) data dari database MySQL
// Contoh: foreach($data['barang'] as $barang) :
?>

<div class="bg-emerald-600 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-down">
        <h1 class="text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl tracking-tight">
            Katalog Sisa Produksi
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100">
            Temukan berbagai material sisa industri yang bisa kamu manfaatkan untuk inovasi bisnismu.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10" data-aos="fade-up" data-aos-delay="100">
    <div class="bg-white rounded-xl shadow-lg p-6 border border-slate-100">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow">
                <input type="text" placeholder="Cari material... (contoh: kain perca, serbuk kayu)" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-slate-700">
            </div>
            <div class="md:w-64">
                <select class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-slate-700 bg-white">
                    <option value="">Semua Kategori</option>
                    <option value="tekstil">Tekstil & Garmen</option>
                    <option value="kayu">Kayu & Furniture</option>
                    <option value="plastik">Plastik & Karet</option>
                    <option value="kertas">Kertas & Karton</option>
                </select>
            </div>
            <button type="submit" class="bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition shadow-md flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari
            </button>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col" data-aos="zoom-in" data-aos-delay="100">
            <div class="h-48 bg-slate-200 w-full relative flex items-center justify-center text-slate-400">
                <span class="absolute top-3 right-3 bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Tekstil</span>
                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-lg font-bold text-slate-800 mb-1 line-clamp-2">Kain Perca Katun Motif Campur (Sisa Pabrik)</h3>
                <p class="text-sm text-slate-500 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Sidoarjo, Jawa Timur
                </p>
                <div class="mt-auto">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <p class="text-xs text-slate-400">Harga Est.</p>
                            <p class="text-emerald-600 font-bold text-lg">Rp 15.000 <span class="text-sm font-normal text-slate-500">/ kg</span></p>
                        </div>
                        <p class="text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded">Stok: 50 kg</p>
                    </div>
                    <a href="#" class="block w-full text-center bg-slate-800 text-white py-2 rounded-lg font-medium hover:bg-slate-900 transition">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col" data-aos="zoom-in" data-aos-delay="200">
            <div class="h-48 bg-slate-200 w-full relative flex items-center justify-center text-slate-400">
                <span class="absolute top-3 right-3 bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Kayu</span>
                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-lg font-bold text-slate-800 mb-1 line-clamp-2">Potongan Kayu Jati Belanda Bekas Palet</h3>
                <p class="text-sm text-slate-500 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Surabaya, Jawa Timur
                </p>
                <div class="mt-auto">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <p class="text-xs text-slate-400">Harga Est.</p>
                            <p class="text-emerald-600 font-bold text-lg">Rp 5.000 <span class="text-sm font-normal text-slate-500">/ pcs</span></p>
                        </div>
                        <p class="text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded">Stok: 200 pcs</p>
                    </div>
                    <a href="#" class="block w-full text-center bg-slate-800 text-white py-2 rounded-lg font-medium hover:bg-slate-900 transition">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col" data-aos="zoom-in" data-aos-delay="300">
            <div class="h-48 bg-slate-200 w-full relative flex items-center justify-center text-slate-400">
                <span class="absolute top-3 right-3 bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Plastik</span>
                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-lg font-bold text-slate-800 mb-1 line-clamp-2">Biji Plastik PET Daur Ulang Bersih</h3>
                <p class="text-sm text-slate-500 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Gresik, Jawa Timur
                </p>
                <div class="mt-auto">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <p class="text-xs text-slate-400">Harga Est.</p>
                            <p class="text-emerald-600 font-bold text-lg">Rp 12.500 <span class="text-sm font-normal text-slate-500">/ kg</span></p>
                        </div>
                        <p class="text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded">Stok: 500 kg</p>
                    </div>
                    <a href="#" class="block w-full text-center bg-slate-800 text-white py-2 rounded-lg font-medium hover:bg-slate-900 transition">Lihat Detail</a>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col" data-aos="zoom-in" data-aos-delay="400">
            <div class="h-48 bg-slate-200 w-full relative flex items-center justify-center text-slate-400">
                <span class="absolute top-3 right-3 bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Kulit</span>
                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-lg font-bold text-slate-800 mb-1 line-clamp-2">Potongan Sisa Kulit Sintetis Pabrik Sepatu</h3>
                <p class="text-sm text-slate-500 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Mojokerto, Jawa Timur
                </p>
                <div class="mt-auto">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <p class="text-xs text-slate-400">Harga Est.</p>
                            <p class="text-emerald-600 font-bold text-lg">Rp 20.000 <span class="text-sm font-normal text-slate-500">/ karung</span></p>
                        </div>
                        <p class="text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded">Stok: 15 karung</p>
                    </div>
                    <a href="#" class="block w-full text-center bg-slate-800 text-white py-2 rounded-lg font-medium hover:bg-slate-900 transition">Lihat Detail</a>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-16 flex justify-center" data-aos="fade-up">
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-slate-300 bg-white text-sm font-medium text-slate-500 hover:bg-slate-50">
                <span class="sr-only">Previous</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </a>
            <a href="#" aria-current="page" class="z-10 bg-emerald-50 border-emerald-500 text-emerald-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                1
            </a>
            <a href="#" class="bg-white border-slate-300 text-slate-500 hover:bg-slate-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                2
            </a>
            <a href="#" class="bg-white border-slate-300 text-slate-500 hover:bg-slate-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                3
            </a>
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-slate-300 bg-white text-sm font-medium text-slate-500 hover:bg-slate-50">
                <span class="sr-only">Next</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
            </a>
        </nav>
    </div>
    
</div>