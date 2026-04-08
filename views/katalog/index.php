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
    
    <?php
    // Di sinilah nanti kita akan menampilkan data produk yang diambil dari database dengan perulangan
    // Contoh: foreach($data['barang'] as $barang) :
    // kemudian gunakan layout kartu produk di bawah ini
    ?>
    
</div>