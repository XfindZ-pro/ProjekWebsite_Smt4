<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Profil Saya</h1>
            <p class="mt-2 text-slate-600">Lihat detail akun Anda dan pastikan informasi profil sudah benar.</p>
        </div>

        <?php
            $statusLabel = 'Tidak diketahui';
            $statusClass = 'bg-slate-100 text-slate-700';
            if (!empty($user['status_verifikasi'])) {
                switch ($user['status_verifikasi']) {
                    case 'tanpa_verifikasi':
                        $statusLabel = 'Tanpa Verifikasi';
                        $statusClass = 'bg-yellow-100 text-yellow-800';
                        break;
                    case 'menunggu':
                        $statusLabel = 'Proses Verifikasi';
                        $statusClass = 'bg-blue-100 text-blue-800';
                        break;
                    case 'disetujui':
                        $statusLabel = 'Terverifikasi';
                        $statusClass = 'bg-emerald-100 text-emerald-800';
                        break;
                    case 'ditolak':
                        $statusLabel = 'Gagal Verifikasi';
                        $statusClass = 'bg-red-100 text-red-800';
                        break;
                    default:
                        $statusLabel = htmlspecialchars($user['status_verifikasi']);
                        $statusClass = 'bg-slate-100 text-slate-700';
                        break;
                }
            }

            $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($user['nama']) . "&background=10b981&color=fff&size=512";
        ?>

        <section class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="flex flex-col items-center text-center">
                <button id="profilePhotoButton" type="button" class="group relative rounded-full border-4 border-emerald-100 shadow-sm transition hover:border-emerald-300 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                    <img id="profilePhoto" src="<?= $avatarUrl; ?>" alt="Foto Profil" class="h-36 w-36 rounded-full object-cover" />
                    <span class="sr-only">Buka foto profil</span>
                    <div class="pointer-events-none absolute inset-0 rounded-full bg-black/0 transition group-hover:bg-black/10"></div>
                </button>
                <h2 class="mt-6 text-3xl font-semibold text-slate-900"><?= htmlspecialchars($user['nama'] ?? '-'); ?></h2>
                <p class="mt-2 text-sm font-medium text-slate-500"><?= htmlspecialchars($user['email'] ?? '-'); ?></p>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Nama</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900"><?= htmlspecialchars($user['nama'] ?? '-'); ?></p>
                </div>
                <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Email</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900"><?= htmlspecialchars($user['email'] ?? '-'); ?></p>
                </div>
                <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Peran</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900"><?= htmlspecialchars($user['peran'] ?? '-'); ?></p>
                </div>
                <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Status Verifikasi</p>
                    <span class="mt-2 inline-flex rounded-full px-3 py-2 text-sm font-semibold <?= $statusClass; ?>"><?= $statusLabel; ?></span>
                </div>
            </div>
        </section>
    </div>

    <div id="profilePhotoModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4 py-8">
        <div class="relative w-full max-w-[540px] rounded-3xl bg-white p-4 shadow-2xl">
            <button id="closeModalButton" type="button" class="absolute right-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 focus:outline-none">
                ×
            </button>
            <div class="flex justify-center">
                <img id="modalPhoto" src="<?= $avatarUrl; ?>" alt="Foto Profil Besar" class="h-[512px] w-[512px] max-w-full rounded-3xl object-cover" />
            </div>
        </div>
    </div>

    <script>
        const profilePhotoButton = document.getElementById('profilePhotoButton');
        const profilePhotoModal = document.getElementById('profilePhotoModal');
        const closeModalButton = document.getElementById('closeModalButton');

        profilePhotoButton.addEventListener('click', () => {
            profilePhotoModal.classList.remove('hidden');
            profilePhotoModal.classList.add('flex');
        });

        closeModalButton.addEventListener('click', () => {
            profilePhotoModal.classList.add('hidden');
            profilePhotoModal.classList.remove('flex');
        });

        profilePhotoModal.addEventListener('click', (event) => {
            if (event.target === profilePhotoModal) {
                profilePhotoModal.classList.add('hidden');
                profilePhotoModal.classList.remove('flex');
            }
        });
    </script>
</main>
