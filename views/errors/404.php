<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 h-screen flex flex-col items-center justify-center font-sans">
    
    <div class="text-center">
        <h1 class="text-9xl font-extrabold text-slate-800 tracking-widest animate-bounce">
            404
        </h1>
        <div class="bg-blue-500 px-2 text-sm rounded rotate-12 absolute text-white shadow-lg">
            Page Not Found
        </div>
            
        <h2 class="mt-8 text-3xl font-semibold text-slate-700">Waduh, Kamu Tersesat!</h2>
        <p class="mt-4 text-slate-500 max-w-md mx-auto">
            Halaman atau URL yang kamu cari sepertinya tidak ada atau sudah dipindahkan.
        </p>

        <a href="<?= BASEURL; ?>" 
           class="mt-8 inline-block px-6 py-3 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
            Kembali ke Beranda
        </a>
    </div>

</body>
</html>