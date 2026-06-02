<?php
// Menampilkan daftar mitra yang telah terverifikasi dari database
?>

<div class="bg-emerald-600 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-down">
        <h1 class="text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl tracking-tight">
            Daftar Mitra
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100">
            Temukan mitra usaha dan sumber bahan baku industri yang siap mendukung kebutuhan produksi Anda.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <?php if (empty($data['mitra'])): ?>
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.697M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-slate-900">Tidak ada mitra tersedia</h3>
            <p class="mt-1 text-base text-slate-500">Mitra akan ditampilkan di sini setelah verifikasi disetujui.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($data['mitra'] as $mitra): ?>
                <?php
                    // Menentukan URL foto profil mitra
                    if (!empty($mitra['foto_profil'])) {
                        $fotoUrl = 'data:image/jpeg;base64,' . base64_encode($mitra['foto_profil']);
                    } else {
                        $fotoUrl = "https://ui-avatars.com/api/?name=" . urlencode($mitra['nama']) . "&background=10b981&color=fff&size=512";
                    }
                ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-slate-100" data-aos="fade-up">
                    <!-- Header dengan background -->
                    <div class="h-24 bg-gradient-to-r from-emerald-500 to-emerald-600"></div>
                    
                    <!-- Profile Section -->
                    <div class="px-6 pb-6">
                        <!-- Avatar -->
                        <div class="flex justify-center -mt-12 mb-4">
                            <img src="<?= $fotoUrl; ?>" 
                                 alt="<?= htmlspecialchars($mitra['nama']); ?>" 
                                 class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover bg-white">
                        </div>
                        
                        <!-- Name -->
                        <h3 class="text-lg font-bold text-slate-900 text-center truncate">
                            <?= htmlspecialchars($mitra['nama']); ?>
                        </h3>
                        
                        <!-- Role -->
                        <p class="text-sm text-slate-500 text-center mt-1 capitalize">
                            <?php
                                $roleDisplay = [
                                    'admin' => 'Administrator',
                                    'pengguna' => 'Pengguna',
                                    'pabrik' => 'Pabrik',
                                    'produsen' => 'Produsen',
                                    'umkm' => 'UMKM',
                                    'industri_kreatif' => 'Industri Kreatif',
                                    'pelaku_daur_ulang' => 'Pelaku Daur Ulang'
                                ];
                                echo $roleDisplay[$mitra['peran']] ?? ucfirst($mitra['peran']);
                            ?>
                        </p>
                        
                        <!-- Email -->
                        <p class="text-xs text-slate-400 text-center mt-2 truncate">
                            <?= htmlspecialchars($mitra['email']); ?>
                        </p>
                        
                        <!-- Member Since -->
                        <p class="text-xs text-slate-500 text-center mt-3">
                            Bergabung: <?= date('d M Y', strtotime($mitra['created_at'])); ?>
                        </p>
                        
                        <!-- Action Button -->
                        <div class="mt-4">
                            <button class="w-full bg-emerald-600 text-white px-4 py-2.5 rounded-lg font-semibold hover:bg-emerald-700 transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3L8 20H4v-4l9-8zm0 0L9 3l3-3 9 9-3 3" />
                                </svg>
                                Lihat Profil
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
