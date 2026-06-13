<?php
    $user = $data['user'];
    $stats = $data['stats'];

    // Fallback URL Gambar untuk banner
    if (!empty($user['foto_banner'])) {
        if (preg_match('/^data:image\//', $user['foto_banner'])) {
            $bannerUrl = $user['foto_banner'];
        } elseif (preg_match('/^(https?:\/\/|\/)/', $user['foto_banner'])) {
            $bannerUrl = htmlspecialchars($user['foto_banner']);
        } elseif ($bannerInfo = @getimagesizefromstring($user['foto_banner'])) {
            $bannerUrl = 'data:' . $bannerInfo['mime'] . ';base64,' . base64_encode($user['foto_banner']);
        } else {
            $bannerUrl = BASEURL . '/' . htmlspecialchars($user['foto_banner']);
        }
    } else {
        $bannerUrl = 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80';
    }

    // Fallback URL Gambar untuk avatar
    if (!empty($user['foto_profil'])) {
        if (preg_match('/^data:image\//', $user['foto_profil'])) {
            $avatarUrl = $user['foto_profil'];
        } elseif (preg_match('/^(https?:\/\/|\/)/', $user['foto_profil'])) {
            $avatarUrl = htmlspecialchars($user['foto_profil']);
        } elseif ($avatarInfo = @getimagesizefromstring($user['foto_profil'])) {
            $avatarUrl = 'data:' . $avatarInfo['mime'] . ';base64,' . base64_encode($user['foto_profil']);
        } else {
            $avatarUrl = BASEURL . '/' . htmlspecialchars($user['foto_profil']);
        }
    } else {
        $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($user['nama']) . "&background=10b981&color=fff&size=256";
    }
?>

<main class="flex-grow bg-slate-50/50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Shop Header Profile Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-sm mb-10" data-aos="fade-down">
            <div class="h-60 w-full overflow-hidden bg-slate-200 relative">
                <img src="<?= $bannerUrl; ?>" alt="Banner Toko" class="h-full w-full object-cover filter brightness-[0.85]" />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent to-transparent"></div>
            </div>
            
            <div class="relative px-6 pb-8 pt-20 flex flex-col md:flex-row items-center md:items-end justify-between gap-6">
                <!-- Shop Profile Pic (Floating) -->
                <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 md:left-10 md:translate-x-0">
                    <div class="h-32 w-32 rounded-full border-4 border-white bg-white shadow-xl overflow-hidden">
                        <img src="<?= $avatarUrl; ?>" alt="Logo Toko" class="h-full w-full object-cover" />
                    </div>
                </div>
                
                <div class="text-center md:text-left md:pl-40 flex-1">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight"><?= htmlspecialchars($user['nama']); ?></h1>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-emerald-50 text-emerald-700 border border-emerald-200">
                            MITRA VERIFIKASI
                        </span>
                    </div>
                    <p class="text-slate-500 mt-1.5 flex items-center justify-center md:justify-start gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <?= htmlspecialchars($user['email']); ?>
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="<?= BASEURL; ?>/jualan" class="px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md transition-all active:scale-95">
                        + Pasarkan Sisa Produksi
                    </a>
                    <a href="<?= BASEURL; ?>/produksaya" class="px-5 py-2.5 rounded-full border border-slate-200 hover:bg-slate-50 text-slate-600 font-bold text-sm transition-all">
                        Kelola Produk
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Counter Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10" data-aos="fade-up" data-aos-delay="100">
            <!-- Card 1 -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        📦
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total Produk Jualan</p>
                        <p class="text-2xl font-black text-slate-900 mt-0.5"><?= number_format($stats['total_produk']); ?> <span class="text-xs font-semibold text-slate-400">Jenis</span></p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                        ⚖️
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total Stok Aktif</p>
                        <p class="text-2xl font-black text-slate-900 mt-0.5"><?= number_format($stats['total_stok'], 1, ',', '.'); ?> <span class="text-xs font-semibold text-slate-400">Kg</span></p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl font-bold">
                        🤝
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Limbah Terjual</p>
                        <p class="text-2xl font-black text-slate-900 mt-0.5"><?= number_format($stats['total_terjual'], 1, ',', '.'); ?> <span class="text-xs font-semibold text-slate-400">Kg</span></p>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                        💰
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                        <p class="text-2xl font-black text-emerald-600 mt-0.5">Rp <?= number_format($stats['total_pendapatan'], 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-10" data-aos="fade-up" data-aos-delay="200">
            <!-- Left Chart Card: Doughnut Stock by Category (5 Cols) -->
            <div class="lg:col-span-5 bg-white border border-slate-200 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[380px]">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Proporsi Stok Limbah</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Stok tersedia dikelompokkan berdasarkan kategori limbah.</p>
                </div>
                <div class="my-6 relative flex items-center justify-center" style="max-height: 250px;">
                    <?php if ($stats['total_stok'] > 0): ?>
                        <canvas id="categoryChart"></canvas>
                    <?php else: ?>
                        <div class="py-16 text-center text-slate-400 font-medium text-sm">
                            Belum ada stok produk aktif untuk diplot.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Chart Card: Bar Sales per Product (7 Cols) -->
            <div class="lg:col-span-7 bg-white border border-slate-200 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[380px]">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Volume Penjualan Produk</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Kuantitas produk yang berhasil dipasarkan dan terjual (dalam kg).</p>
                </div>
                <div class="my-6 relative" style="max-height: 250px;">
                    <?php if ($stats['total_terjual'] > 0): ?>
                        <canvas id="salesChart" class="w-full h-full"></canvas>
                    <?php else: ?>
                        <div class="py-24 text-center text-slate-400 font-medium text-sm">
                            Belum ada riwayat produk terjual.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Latest Listed Products Table -->
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm" data-aos="fade-up" data-aos-delay="300">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Produk Terbaru di Katalog</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Daftar produk terbaru yang Anda tayangkan saat ini.</p>
                </div>
                <a href="<?= BASEURL; ?>/produksaya" class="text-sm font-bold text-emerald-600 hover:text-emerald-700 transition">
                    Lihat Semua →
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 text-slate-500 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="px-6 py-4">Nama Produk</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Harga Jual</th>
                            <th class="px-6 py-4">Sisa Stok</th>
                            <th class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if (empty($data['produk_list'])): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-400 font-medium">Belum ada produk jualan. Mulai posting produk baru sekarang!</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['produk_list'] as $p): ?>
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200 flex items-center justify-center">
                                                <?php if ($p['foto_1']): ?>
                                                    <img src="data:image/jpeg;base64,<?= base64_encode($p['foto_1']); ?>" alt="" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <span class="text-lg">📦</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="font-bold text-slate-800"><?= htmlspecialchars($p['nama_produk']); ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 font-medium"><?= htmlspecialchars($p['kategori_limbah'] ?? 'Lainnya'); ?></td>
                                    <td class="px-6 py-4 font-bold text-slate-800">Rp <?= number_format($p['harga_per_kg'], 0, ',', '.'); ?> <span class="text-xs font-medium text-slate-400">/ kg</span></td>
                                    <td class="px-6 py-4 font-semibold text-slate-700"><?= number_format($p['berat_tersedia'] ?? 0, 0, ',', '.'); ?> kg</td>
                                    <td class="px-6 py-4 text-center">
                                        <?php if (($p['status_produk'] ?? '') === 'aktif'): ?>
                                            <span class="rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 text-xs font-bold border border-emerald-100 shadow-sm uppercase">Aktif</span>
                                        <?php else: ?>
                                            <span class="rounded-full bg-amber-50 text-amber-700 px-3 py-1 text-xs font-bold border border-amber-100 shadow-sm uppercase">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // --- 1. Category Stock Doughnut Chart ---
        <?php if ($stats['total_stok'] > 0): ?>
        const catCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($data['category_labels']); ?>,
                datasets: [{
                    data: <?= json_encode($data['category_data']); ?>,
                    backgroundColor: [
                        '#10b981', // emerald
                        '#3b82f6', // blue
                        '#6366f1', // indigo
                        '#f59e0b', // amber
                        '#ec4899', // pink
                        '#8b5cf6', // purple
                        '#94a3b8'  // slate
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 11,
                                family: 'sans-serif',
                                weight: '500'
                            },
                            color: '#475569'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ` ${context.label}: ${context.raw.toLocaleString('id-ID')} kg`;
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
        <?php endif; ?>

        // --- 2. Product Sales Bar Chart ---
        <?php if ($stats['total_terjual'] > 0): ?>
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($data['product_labels']); ?>,
                datasets: [{
                    label: 'Volume Terjual (kg)',
                    data:  <?= json_encode($data['product_data']); ?>,
                    backgroundColor: 'rgba(16, 185, 129, 0.85)', // emerald with opacity
                    hoverBackgroundColor: '#10b981',
                    borderRadius: 8,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ` Terjual: ${context.raw.toLocaleString('id-ID')} kg`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 10,
                                weight: '500'
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
        <?php endif; ?>
    });
</script>
