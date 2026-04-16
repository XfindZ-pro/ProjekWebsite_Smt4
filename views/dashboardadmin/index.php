<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">Panel Admin</p>
                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">Dashboard Administrator</h1>
                <p class="mt-2 text-slate-600 max-w-2xl">Pantau aktivitas platform Valora dan kelola pengajuan dengan
                    cepat. Hanya pengguna dengan peran admin yang dapat mengakses halaman ini.</p>
            </div>
        </div>

        <div class="mb-8 flex space-x-3 overflow-x-auto pb-2 scrollbar-hide">
            <button
                class="tab-btn bg-emerald-600 text-white border-emerald-600 rounded-full px-6 py-2.5 text-sm font-semibold transition shadow-md whitespace-nowrap border"
                data-target="tab-dashboard">
                Overview Dashboard
            </button>
            <button
                class="tab-btn bg-white text-slate-700 hover:bg-slate-50 border-slate-200 rounded-full px-6 py-2.5 text-sm font-semibold transition shadow-sm whitespace-nowrap border"
                data-target="tab-verifikasi">
                Verifikasi Bisnis
            </button>
            <button
                class="tab-btn bg-white text-slate-700 hover:bg-slate-50 border-slate-200 rounded-full px-6 py-2.5 text-sm font-semibold transition shadow-sm whitespace-nowrap border"
                data-target="tab-pengguna">
                Manajemen Pengguna
            </button>
            <button
                class="tab-btn bg-white text-slate-700 hover:bg-slate-50 border-slate-200 rounded-full px-6 py-2.5 text-sm font-semibold transition shadow-sm whitespace-nowrap border"
                data-target="tab-produk">
                Manajemen Produk
            </button>
        </div>

        <div id="tab-dashboard" class="tab-content block animate-fade-in">
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4 mb-10">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Total User</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900"><?= number_format($data['total_users'] ?? 0); ?>
                    </p>
                    <p class="mt-2 text-sm text-slate-500">Pengguna terdaftar dalam platform.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Pengajuan Masuk</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900">
                        <?= number_format($data['pending_verifications'] ?? 0); ?></p>
                    <p class="mt-2 text-sm text-slate-500">Akun yang sedang menunggu review.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Produk Aktif</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900">
                        <?= number_format($data['product_active'] ?? 0); ?></p>
                    <p class="mt-2 text-sm text-slate-500">Item aktif di marketplace.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Disetujui Hari Ini</p>
                    <p class="mt-4 text-4xl font-bold text-emerald-600">
                        <?= number_format($data['approved_today'] ?? 0); ?></p>
                    <p class="mt-2 text-sm text-slate-500">Verifikasi berhasil hari ini.</p>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-3">
                <section class="xl:col-span-2 rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Pengajuan Terbaru — Perlu Tindakan</h2>
                            <p class="mt-2 text-sm text-slate-500">Lihat pengajuan terakhir dan tindak cepat sebelum
                                sempat menumpuk.</p>
                        </div>
                    </div>

                    <?php if (!empty($data['recent_submissions'])): ?>
                        <div class="space-y-4">
                            <?php foreach ($data['recent_submissions'] as $submission): ?>
                                <div class="rounded-3xl border border-slate-200 p-5 hover:border-emerald-300 transition">
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-slate-900">
                                                <?= htmlspecialchars($submission['nama_usaha']); ?></h3>
                                            <p class="mt-1 text-sm text-slate-500">Penjual:
                                                <?= htmlspecialchars($submission['penjual']); ?></p>
                                        </div>
                                        <span
                                            class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700"><?= htmlspecialchars($submission['jenis_entitas']); ?></span>
                                    </div>
                                    <div class="mt-4 flex flex-wrap gap-3 text-sm text-slate-500">
                                        <span class="rounded-full bg-emerald-50 text-emerald-700 px-3 py-1">Review
                                            diperlukan</span>
                                        <span class="rounded-full bg-slate-50 text-slate-600 px-3 py-1">Manual check</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="rounded-3xl border border-slate-200 p-8 text-center text-slate-500">Belum ada pengajuan
                            terbaru yang dapat ditampilkan.</div>
                    <?php endif; ?>
                </section>

                <section class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900">Ringkasan Cepat</h2>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Akun Admin</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">
                                <?= htmlspecialchars($_SESSION['user_nama'] ?? 'Admin'); ?></p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Status Akses</p>
                            <p
                                class="mt-2 inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">
                                Admin Aktif</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Total Verifikasi</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">
                                <?= number_format($data['pending_verifications'] ?? 0); ?> menunggu</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div id="tab-verifikasi" class="tab-content hidden animate-fade-in">
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-slate-900">Antrean Verifikasi
                        (<?= count($data['verifikasi_list']); ?>)</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 uppercase">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Usaha / Penjual</th>
                                <th class="px-6 py-4 font-semibold">Tipe</th>
                                <th class="px-6 py-4 font-semibold">Dokumen</th>
                                <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($data['verifikasi_list'] as $v): ?>
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900"><?= htmlspecialchars($v['nama_usaha']); ?>
                                        </div>
                                        <div class="text-xs text-slate-500"><?= htmlspecialchars($v['nama_user']); ?>
                                            (<?= $v['akun_id']; ?>)</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="rounded-full bg-blue-50 text-blue-700 px-3 py-1 text-xs font-semibold uppercase"><?= $v['jenis_entitas']; ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <button class="text-emerald-600 font-bold hover:underline">Lihat KTP</button>
                                            <?php if ($v['file_izin_usaha']): ?>
                                                <span class="text-slate-300">|</span>
                                                <button class="text-blue-600 font-bold hover:underline">Lihat Izin</button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="<?= BASEURL; ?>/dashboardadmin/setujui/<?= $v['verifikasi_id']; ?>/<?= $v['akun_id']; ?>"
                                                onclick="return confirm('Setujui bisnis ini? Data pengajuan akan dihapus dan akun diaktifkan.')"
                                                class="rounded-lg bg-emerald-600 text-white px-4 py-2 text-xs font-bold hover:bg-emerald-700 transition">Setujui</a>

                                            <a href="<?= BASEURL; ?>/dashboardadmin/tolak/<?= $v['verifikasi_id']; ?>/<?= $v['akun_id']; ?>"
                                                onclick="return confirm('Tolak pengajuan ini?')"
                                                class="rounded-lg bg-red-100 text-red-600 px-4 py-2 text-xs font-bold hover:bg-red-200 transition">Tolak</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($data['verifikasi_list'])): ?>
                                <tr>
                                    <td colspan="4" class="p-10 text-center text-slate-400 font-medium">Tidak ada antrean
                                        verifikasi saat ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<div id="tab-pengguna" class="tab-content hidden animate-fade-in">
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Data Pengguna Valora</h2>
                        <p class="text-xs text-slate-500 mt-1">Total: <span id="totalUserCount"><?= count($data['users_list'] ?? []); ?></span> pengguna terdaftar.</p>
                    </div>
                    <div class="relative w-full md:w-80">
                        <input type="text" id="userSearchInput" placeholder="Cari nama atau email..." 
                               class="w-full rounded-full border border-slate-200 bg-slate-50 pl-10 pr-4 py-2.5 text-sm focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 shadow-sm" />
                        <div class="absolute left-3.5 top-3 text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 uppercase">
                            <tr>
                                <th class="px-6 py-4 font-semibold">User ID / Nama</th>
                                <th class="px-6 py-4 font-semibold">Email</th>
                                <th class="px-6 py-4 font-semibold">Peran</th>
                                <th class="px-6 py-4 font-semibold">Status Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody" class="divide-y divide-slate-100">
                            </tbody>
                    </table>
                </div>

                <div class="p-6 border-t border-slate-100 bg-slate-50/50 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500" id="paginationInfo">Menampilkan 0 sampai 0 dari 0 data</p>
                    <div class="flex items-center gap-2" id="paginationButtons"></div>
                </div>
            </div>

            <div id="userDetailModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-900/60 px-4 py-8 backdrop-blur-sm transition-opacity">
                <div class="relative w-full max-w-2xl rounded-[32px] bg-white shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="userDetailContent">
                    <button onclick="closeUserModal()" class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-black/30 text-white hover:bg-black/50 backdrop-blur-md transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <div class="h-40 w-full bg-slate-200 relative">
                        <img id="modalUserBanner" src="" class="w-full h-full object-cover" alt="Banner Profil">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>

                    <div class="px-8 pb-8 relative">
                        <div class="absolute -top-16 left-8">
                            <img id="modalUserPhoto" src="" class="h-28 w-28 rounded-full border-4 border-white object-cover shadow-lg bg-white" alt="Foto Profil">
                        </div>
                        
                        <div class="pt-16">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 id="modalUserName" class="text-2xl font-bold text-slate-900">Nama User</h2>
                                    <p id="modalUserEmail" class="text-slate-500 font-medium">email@user.com</p>
                                </div>
                                <span id="modalUserRole" class="px-4 py-1.5 rounded-full text-xs font-black tracking-widest uppercase border border-slate-200 bg-slate-50 text-slate-700 shadow-sm">ROLE</span>
                            </div>

                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">ID Akun</p>
                                    <p id="modalUserId" class="font-mono text-sm font-bold text-slate-700">akun000000</p>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Status Verifikasi</p>
                                    <div id="modalUserStatusContainer"></div>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 col-span-2">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tanggal Terdaftar</p>
                                    <p id="modalUserJoined" class="text-sm font-bold text-slate-700">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const allUsers = <?= json_encode($data['users_list'] ?? []); ?>;
                let filteredUsers = [...allUsers];
                let currentPage = 1;
                const rowsPerPage = 10;

                const searchInput = document.getElementById('userSearchInput');
                const tableBody = document.getElementById('userTableBody');
                const paginationInfo = document.getElementById('paginationInfo');
                const paginationButtons = document.getElementById('paginationButtons');
                
                // Variabel Modal
                const userModal = document.getElementById('userDetailModal');
                const userModalContent = document.getElementById('userDetailContent');

                function renderTable() {
                    const start = (currentPage - 1) * rowsPerPage;
                    const end = start + rowsPerPage;
                    const paginatedItems = filteredUsers.slice(start, end);

                    tableBody.innerHTML = '';

                    if (paginatedItems.length === 0) {
                        tableBody.innerHTML = `<tr><td colspan="4" class="p-12 text-center text-slate-400 font-medium">Data tidak ditemukan.</td></tr>`;
                        updatePagination();
                        return;
                    }

                    paginatedItems.forEach(u => {
                        let statusClass = 'bg-slate-100 text-slate-700';
                        let statusLabel = 'Tanpa Verifikasi';
                        if(u.status_verifikasi === 'disetujui') {
                            statusClass = 'bg-emerald-50 text-emerald-700';
                            statusLabel = 'Disetujui';
                        } else if(u.status_verifikasi === 'menunggu') {
                            statusClass = 'bg-blue-50 text-blue-700';
                            statusLabel = 'Menunggu';
                        } else if(u.status_verifikasi === 'ditolak') {
                            statusClass = 'bg-red-50 text-red-700';
                            statusLabel = 'Ditolak';
                        }

                        // Menambahkan cursor-pointer dan onclick pada row
                        const row = `
                            <tr class="hover:bg-slate-50 transition group cursor-pointer" onclick="openUserModal('${u.akun_id}')">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="${u.foto_profil}" class="w-8 h-8 rounded-full object-cover border border-slate-200">
                                        <div>
                                            <div class="font-bold text-slate-900 group-hover:text-emerald-600 transition">${u.nama}</div>
                                            <div class="text-xs text-slate-400 font-mono">${u.akun_id}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium">${u.email}</td>
                                <td class="px-6 py-4 uppercase text-[10px] font-black tracking-widest text-slate-400">
                                    <span class="border border-slate-200 px-2 py-0.5 rounded">${u.peran}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-bold ${statusClass}">${statusLabel}</span>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });

                    updatePagination();
                }

                // Fungsi Membuka Modal
                function openUserModal(akunId) {
                    const user = allUsers.find(u => u.akun_id === akunId);
                    if (!user) return;

                    // Mengisi Data
                    document.getElementById('modalUserName').innerText = user.nama;
                    document.getElementById('modalUserEmail').innerText = user.email;
                    document.getElementById('modalUserId').innerText = user.akun_id;
                    document.getElementById('modalUserRole').innerText = user.peran;
                    document.getElementById('modalUserJoined').innerText = user.created_at ? user.created_at : '-';
                    document.getElementById('modalUserPhoto').src = user.foto_profil;
                    document.getElementById('modalUserBanner').src = user.foto_banner;

                    // Menyiapkan Badge Status
                    let statusClass = 'bg-slate-100 text-slate-700';
                    let statusLabel = 'Tanpa Verifikasi';
                    if(user.status_verifikasi === 'disetujui') {
                        statusClass = 'bg-emerald-100 text-emerald-800 border border-emerald-200';
                        statusLabel = 'Disetujui';
                    } else if(user.status_verifikasi === 'menunggu') {
                        statusClass = 'bg-blue-100 text-blue-800 border border-blue-200';
                        statusLabel = 'Menunggu';
                    } else if(user.status_verifikasi === 'ditolak') {
                        statusClass = 'bg-red-100 text-red-800 border border-red-200';
                        statusLabel = 'Ditolak';
                    }
                    document.getElementById('modalUserStatusContainer').innerHTML = `<span class="px-4 py-1.5 rounded-full text-xs font-bold ${statusClass}">${statusLabel}</span>`;

                    // Menampilkan Modal dengan Efek Animasi
                    userModal.classList.remove('hidden');
                    userModal.classList.add('flex');
                    setTimeout(() => {
                        userModalContent.classList.remove('scale-95', 'opacity-0');
                        userModalContent.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }

                // Fungsi Menutup Modal
                function closeUserModal() {
                    userModalContent.classList.remove('scale-100', 'opacity-100');
                    userModalContent.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        userModal.classList.add('hidden');
                        userModal.classList.remove('flex');
                    }, 300); // Sesuai durasi CSS transition
                }

                // Tutup modal jika area gelap di luar kotak diklik
                userModal.addEventListener('click', (e) => {
                    if (e.target === userModal) closeUserModal();
                });

                function updatePagination() {
                    const totalPages = Math.ceil(filteredUsers.length / rowsPerPage);
                    const startIdx = filteredUsers.length === 0 ? 0 : (currentPage - 1) * rowsPerPage + 1;
                    const endIdx = Math.min(currentPage * rowsPerPage, filteredUsers.length);

                    paginationInfo.innerText = `Menampilkan ${startIdx} sampai ${endIdx} dari ${filteredUsers.length} data`;
                    paginationButtons.innerHTML = '';

                    const prevBtn = document.createElement('button');
                    prevBtn.innerText = 'Sebelumnya';
                    prevBtn.className = `px-4 py-2 text-xs font-bold rounded-full border transition ${currentPage === 1 ? 'text-slate-300 border-slate-100 cursor-not-allowed' : 'text-slate-600 border-slate-200 hover:bg-white hover:border-emerald-500 hover:text-emerald-600'}`;
                    prevBtn.disabled = currentPage === 1;
                    prevBtn.onclick = () => { currentPage--; renderTable(); };
                    paginationButtons.appendChild(prevBtn);

                    if (totalPages > 1) {
                        for (let i = 1; i <= totalPages; i++) {
                            const pageBtn = document.createElement('button');
                            pageBtn.innerText = i;
                            pageBtn.className = `h-8 w-8 text-xs font-bold rounded-full transition border ${i === currentPage ? 'bg-emerald-600 border-emerald-600 text-white' : 'border-slate-200 text-slate-600 hover:border-emerald-500'}`;
                            pageBtn.onclick = () => { currentPage = i; renderTable(); };
                            paginationButtons.appendChild(pageBtn);
                        }
                    }

                    const nextBtn = document.createElement('button');
                    nextBtn.innerText = 'Selanjutnya';
                    nextBtn.className = `px-4 py-2 text-xs font-bold rounded-full border transition ${currentPage === totalPages || totalPages === 0 ? 'text-slate-300 border-slate-100 cursor-not-allowed' : 'text-slate-600 border-slate-200 hover:bg-white hover:border-emerald-500 hover:text-emerald-600'}`;
                    nextBtn.disabled = currentPage === totalPages || totalPages === 0;
                    nextBtn.onclick = () => { currentPage++; renderTable(); };
                    paginationButtons.appendChild(nextBtn);
                }

                searchInput.addEventListener('input', (e) => {
                    const term = e.target.value.toLowerCase();
                    filteredUsers = allUsers.filter(u => 
                        u.nama.toLowerCase().includes(term) || 
                        u.email.toLowerCase().includes(term) || 
                        u.akun_id.toLowerCase().includes(term)
                    );
                    currentPage = 1; 
                    renderTable();
                });

                document.addEventListener('DOMContentLoaded', renderTable);
            </script>
        </div>

            <script>
                // Data asli dari PHP
                const allUsers = <?= json_encode($data['users_list'] ?? []); ?>;
                let filteredUsers = [...allUsers];
                let currentPage = 1;
                const rowsPerPage = 10;

                const searchInput = document.getElementById('userSearchInput');
                const tableBody = document.getElementById('userTableBody');
                const paginationInfo = document.getElementById('paginationInfo');
                const paginationButtons = document.getElementById('paginationButtons');

                function renderTable() {
                    const start = (currentPage - 1) * rowsPerPage;
                    const end = start + rowsPerPage;
                    const paginatedItems = filteredUsers.slice(start, end);

                    tableBody.innerHTML = '';

                    if (paginatedItems.length === 0) {
                        tableBody.innerHTML = `<tr><td colspan="4" class="p-12 text-center text-slate-400 font-medium">Data tidak ditemukan.</td></tr>`;
                        updatePagination();
                        return;
                    }

                    paginatedItems.forEach(u => {
                        // Logika Badge Status
                        let statusClass = 'bg-slate-100 text-slate-700';
                        let statusLabel = 'Tanpa Verifikasi';
                        
                        if(u.status_verifikasi === 'disetujui') {
                            statusClass = 'bg-emerald-50 text-emerald-700';
                            statusLabel = 'Disetujui';
                        } else if(u.status_verifikasi === 'menunggu') {
                            statusClass = 'bg-blue-50 text-blue-700';
                            statusLabel = 'Menunggu';
                        } else if(u.status_verifikasi === 'ditolak') {
                            statusClass = 'bg-red-50 text-red-700';
                            statusLabel = 'Ditolak';
                        }

                        const row = `
                            <tr class="hover:bg-white transition group">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 group-hover:text-emerald-600 transition">${u.nama}</div>
                                    <div class="text-xs text-slate-400 font-mono">${u.akun_id}</div>
                                </td>
                                <td class="px-6 py-4 font-medium">${u.email}</td>
                                <td class="px-6 py-4 uppercase text-[10px] font-black tracking-widest text-slate-400">
                                    <span class="border border-slate-200 px-2 py-0.5 rounded">${u.peran}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-bold ${statusClass}">${statusLabel}</span>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });

                    updatePagination();
                }

                function updatePagination() {
                    const totalPages = Math.ceil(filteredUsers.length / rowsPerPage);
                    const startIdx = filteredUsers.length === 0 ? 0 : (currentPage - 1) * rowsPerPage + 1;
                    const endIdx = Math.min(currentPage * rowsPerPage, filteredUsers.length);

                    paginationInfo.innerText = `Menampilkan ${startIdx} sampai ${endIdx} dari ${filteredUsers.length} data`;

                    paginationButtons.innerHTML = '';

                    // Tombol Previous
                    const prevBtn = document.createElement('button');
                    prevBtn.innerText = 'Sebelumnya';
                    prevBtn.className = `px-4 py-2 text-xs font-bold rounded-full border transition ${currentPage === 1 ? 'text-slate-300 border-slate-100 cursor-not-allowed' : 'text-slate-600 border-slate-200 hover:bg-white hover:border-emerald-500 hover:text-emerald-600'}`;
                    prevBtn.disabled = currentPage === 1;
                    prevBtn.onclick = () => { currentPage--; renderTable(); };
                    paginationButtons.appendChild(prevBtn);

                    // Tombol Halaman (Hanya tampilkan jika lebih dari 1 halaman)
                    if (totalPages > 1) {
                        for (let i = 1; i <= totalPages; i++) {
                            const pageBtn = document.createElement('button');
                            pageBtn.innerText = i;
                            pageBtn.className = `h-8 w-8 text-xs font-bold rounded-full transition border ${i === currentPage ? 'bg-emerald-600 border-emerald-600 text-white' : 'border-slate-200 text-slate-600 hover:border-emerald-500'}`;
                            pageBtn.onclick = () => { currentPage = i; renderTable(); };
                            paginationButtons.appendChild(pageBtn);
                        }
                    }

                    // Tombol Next
                    const nextBtn = document.createElement('button');
                    nextBtn.innerText = 'Selanjutnya';
                    nextBtn.className = `px-4 py-2 text-xs font-bold rounded-full border transition ${currentPage === totalPages || totalPages === 0 ? 'text-slate-300 border-slate-100 cursor-not-allowed' : 'text-slate-600 border-slate-200 hover:bg-white hover:border-emerald-500 hover:text-emerald-600'}`;
                    nextBtn.disabled = currentPage === totalPages || totalPages === 0;
                    nextBtn.onclick = () => { currentPage++; renderTable(); };
                    paginationButtons.appendChild(nextBtn);
                }

                // Event Listener Search
                searchInput.addEventListener('input', (e) => {
                    const term = e.target.value.toLowerCase();
                    filteredUsers = allUsers.filter(u => 
                        u.nama.toLowerCase().includes(term) || 
                        u.email.toLowerCase().includes(term) || 
                        u.akun_id.toLowerCase().includes(term)
                    );
                    currentPage = 1; // Reset ke halaman pertama setiap cari
                    renderTable();
                });

                // Inisialisasi awal
                document.addEventListener('DOMContentLoaded', renderTable);
            </script>
        </div>

        <div id="tab-produk" class="tab-content hidden animate-fade-in">
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-slate-900">Katalog Material Sisa</h2>
                    <select
                        class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-emerald-500 focus:outline-none">
                        <option>Semua Kategori</option>
                        <option>Tekstil</option>
                        <option>Kayu</option>
                        <option>Plastik</option>
                    </select>
                </div>
                <div class="p-16 text-center">
                    <div
                        class="mx-auto mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Tabel Produk Sedang Disiapkan</h3>
                    <p class="mt-2 text-sm text-slate-500">Nantinya, semua barang yang diunggah penjual akan dikelola
                        dan dimonitor dari halaman ini.</p>
                </div>
            </div>
        </div>

    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // 1. Reset semua tombol ke tampilan tidak aktif
                    tabBtns.forEach(b => {
                        b.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600');
                        b.classList.add('bg-white', 'text-slate-700', 'hover:bg-slate-50', 'border-slate-200');
                    });

                    // 2. Berikan warna hijau pada tombol yang sedang diklik
                    btn.classList.remove('bg-white', 'text-slate-700', 'hover:bg-slate-50', 'border-slate-200');
                    btn.classList.add('bg-emerald-600', 'text-white', 'border-emerald-600');

                    // 3. Sembunyikan semua konten layer
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                        content.classList.remove('block');
                    });

                    // 4. Munculkan hanya konten yang ID-nya cocok dengan data-target tombol
                    const targetId = btn.getAttribute('data-target');
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) {
                        targetContent.classList.remove('hidden');
                        targetContent.classList.add('block');
                    }
                });
            });
        });
        function searchUsersTable() {
                    let input = document.getElementById("searchUserInput").value.toUpperCase();
                    let rows = document.querySelectorAll("#usersTable .user-row");

                    rows.forEach(row => {
                        let name = row.querySelector(".search-name").textContent.toUpperCase();
                        let email = row.querySelector(".search-email").textContent.toUpperCase();
                        
                        // Jika nama atau email cocok dengan ketikan, tampilkan barisnya
                        if (name.indexOf(input) > -1 || email.indexOf(input) > -1) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                }
    </script>
</main>