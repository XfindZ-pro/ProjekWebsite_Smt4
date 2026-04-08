<main class="flex-1 bg-slate-50 py-10">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" integrity="sha512-4K3pqhydIUhBkTR0DFgMvbiEpcq7wRND1dGnlE7sP4cgWBa3MQr7cgjXuBvN3Ld8C7kFgZCKR3Kb1dlMpgpgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Profil Saya</h1>
            <p class="mt-2 text-slate-600">Lihat detail akun Anda dan pastikan informasi profil sudah benar.</p>
        </div>

        <?php
            // Logika Label Status Verifikasi
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

            // Fallback URL Gambar
            $bannerUrl = !empty($user['foto_banner']) ? (preg_match('/^(https?:\/\/|\/)/', $user['foto_banner']) ? htmlspecialchars($user['foto_banner']) : BASEURL . '/' . htmlspecialchars($user['foto_banner'])) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1400&q=80';
            $avatarUrl = !empty($user['foto_profil']) ? (preg_match('/^(https?:\/\/|\/)/', $user['foto_profil']) ? htmlspecialchars($user['foto_profil']) : BASEURL . '/' . htmlspecialchars($user['foto_profil'])) : "https://ui-avatars.com/api/?name=" . urlencode($user['nama']) . "&background=10b981&color=fff&size=512";
        ?>

        <section class="relative overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-sm">
            <div class="h-56 w-full overflow-hidden bg-slate-200">
                <img src="<?= $bannerUrl; ?>" alt="Banner Profil" class="h-full w-full object-cover" />
            </div>
            
            <div class="absolute inset-x-0 top-40 mx-auto flex w-full max-w-4xl justify-center px-4">
                <button id="profilePhotoButton" type="button" class="group relative inline-flex h-44 w-52 overflow-hidden rounded-full border-4 border-white bg-white shadow-2xl transition hover:border-emerald-300 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                    <img id="profilePhoto" src="<?= $avatarUrl; ?>" alt="Foto Profil" class="h-full w-full rounded-full object-cover" />
                    <span class="sr-only">Buka foto profil</span>
                    <div class="pointer-events-none absolute inset-0 rounded-full bg-black/0 transition group-hover:bg-black/10"></div>
                </button>
            </div>

            <div class="pt-56 px-6 pb-10">
                <div class="flex flex-wrap justify-center gap-3 mb-6">
                    <button id="changeProfilePhotoButton" type="button" class="rounded-full border border-emerald-600 bg-emerald-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700 transition">Ubah Foto Profil</button>
                    <button id="changeBannerPhotoButton" type="button" class="rounded-full border border-slate-300 bg-white px-5 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition">Ubah Foto Banner</button>
                </div>

                <div class="text-center">
                    <h2 class="text-3xl font-semibold text-slate-900"><?= htmlspecialchars($user['nama'] ?? '-'); ?></h2>
                    <p class="mt-2 text-sm font-medium text-slate-500"><?= htmlspecialchars($user['email'] ?? '-'); ?></p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
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
                        <p class="mt-2 text-lg font-semibold text-slate-900 uppercase"><?= htmlspecialchars($user['peran'] ?? '-'); ?></p>
                    </div>
                    <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Status Verifikasi</p>
                        <span class="mt-2 inline-flex rounded-full px-3 py-2 text-sm font-semibold <?= $statusClass; ?>"><?= $statusLabel; ?></span>
                    </div>
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

    <div id="photoEditModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4 py-8">
        <div class="relative w-full max-w-3xl rounded-3xl bg-white p-6 shadow-2xl">
            <button id="closeEditModalButton" type="button" class="absolute right-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 focus:outline-none">
                ×
            </button>
            <div class="space-y-6">
                <div class="flex flex-col gap-3 text-center">
                    <span id="photoEditHeader" class="text-xl font-bold text-slate-900">Ubah Foto Profil</span>
                    <p class="text-sm text-slate-500">Pilih file gambar lalu sesuaikan potongan. Gambar akan otomatis disesuaikan ukurannya oleh sistem.</p>
                </div>

                <div class="flex flex-wrap justify-center gap-3">
                    <label for="photoFileInput" class="cursor-pointer inline-block rounded-full border border-emerald-600 bg-emerald-600 px-6 py-2 text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-md">Pilih Foto</label>
                    <span id="photoTypeLabel" class="inline-flex items-center rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">Tipe: Foto Profil</span>
                </div>

                <input id="photoFileInput" type="file" accept="image/png, image/jpeg, image/jpg, image/gif" class="sr-only" />

                <div class="rounded-3xl border border-slate-200 bg-slate-100 p-2">
                    <div id="imageContainer" class="w-full bg-white rounded-2xl overflow-hidden flex items-center justify-center" style="min-height: 360px;">
                        <span class="text-slate-400 text-sm">Belum ada foto yang dipilih</span>
                    </div>
                </div>

                <div class="flex flex-wrap justify-end gap-3 pt-2">
                    <button id="cancelEditButton" type="button" class="rounded-full border border-slate-300 bg-white px-6 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">Batal</button>
                    <button id="saveEditButton" type="button" class="rounded-full bg-emerald-600 px-8 py-2 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-md disabled:opacity-50 disabled:cursor-not-allowed" disabled>Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" integrity="sha512-6A6o2vT/UVy0WQ10kY3btBKMqCkz6M1ZW4D8WwL6cj6xgNQwsgG3qA8w3jI3G15ewkb0X9uj/1MruQCBtS5ZLw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        let baseUrl = '<?= BASEURL; ?>';
        if (window.location.protocol === 'https:' && baseUrl.startsWith('http:')) {
            baseUrl = baseUrl.replace('http:', 'https:');
        }

        const profilePhotoModal = document.getElementById('profilePhotoModal');
        const photoEditModal = document.getElementById('photoEditModal');
        const saveEditButton = document.getElementById('saveEditButton');
        const photoFileInput = document.getElementById('photoFileInput');
        const imageContainer = document.getElementById('imageContainer');
        const photoTypeLabel = document.getElementById('photoTypeLabel');

        let cropper = null;
        let currentPhotoType = 'profil';
        let selectedFile = null;
        let isGifUpload = false;
        
        const photoAspect = {
            profil: 1, 
            banner: 14 / 5, 
        };
        const photoSize = {
            profil: { width: 512, height: 512 },
            banner: { width: 1400, height: 500 },
        };

        function openPhotoEdit(type) {
            currentPhotoType = type;
            photoTypeLabel.textContent = type === 'profil' ? 'Tipe: Foto Profil (1:1)' : 'Tipe: Foto Banner (Memanjang)';
            document.getElementById('photoEditHeader').textContent = type === 'profil' ? 'Ubah Foto Profil' : 'Ubah Foto Banner';
            
            saveEditButton.disabled = true;
            saveEditButton.textContent = 'Simpan';
            selectedFile = null;
            isGifUpload = false;
            photoFileInput.value = '';
            
            // Reset container gambar
            imageContainer.innerHTML = '<span class="text-slate-400 text-sm">Belum ada foto yang dipilih</span>';
            
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            photoEditModal.classList.remove('hidden');
            photoEditModal.classList.add('flex');
        }

        function closePhotoEdit() {
            photoEditModal.classList.add('hidden');
            photoEditModal.classList.remove('flex');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            selectedFile = null;
            isGifUpload = false;
            photoFileInput.value = '';
            imageContainer.innerHTML = '<span class="text-slate-400 text-sm">Belum ada foto yang dipilih</span>';
            saveEditButton.disabled = true;
        }

        document.getElementById('profilePhotoButton').addEventListener('click', () => {
            profilePhotoModal.classList.remove('hidden');
            profilePhotoModal.classList.add('flex');
        });
        document.getElementById('closeModalButton').addEventListener('click', () => {
            profilePhotoModal.classList.add('hidden');
            profilePhotoModal.classList.remove('flex');
        });

        document.getElementById('changeProfilePhotoButton').addEventListener('click', () => openPhotoEdit('profil'));
        document.getElementById('changeBannerPhotoButton').addEventListener('click', () => openPhotoEdit('banner'));
        document.getElementById('closeEditModalButton').addEventListener('click', closePhotoEdit);
        document.getElementById('cancelEditButton').addEventListener('click', closePhotoEdit);

        // ==========================================
        // LOGIKA PEMROSESAN FOTO (SANGAT ROBUST)
        // ==========================================
        photoFileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) return;

            const supportedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
            if (!supportedTypes.includes(file.type)) {
                alert('Hanya file .png, .jpg, .jpeg, dan .gif yang didukung.');
                photoFileInput.value = '';
                return;
            }

            // CEK KONEKSI LIBRARY: Jika berjalan di localhost tanpa internet, Cropper tidak akan terdefinisi
            if (typeof Cropper === 'undefined') {
                alert('Library pemotong gambar belum siap. Pastikan komputer Anda terhubung ke internet untuk memuat fitur ini.');
                photoFileInput.value = '';
                return;
            }

            selectedFile = file;
            isGifUpload = file.type === 'image/gif';
            saveEditButton.disabled = true;
            saveEditButton.textContent = 'Menyiapkan...';

            const reader = new FileReader();
            
            reader.onload = (e) => {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                
                // FIX UTAMA: Hancurkan dan buat ulang elemen <img> sepenuhnya untuk mereset semua error
                imageContainer.innerHTML = `<img id="cropperImage" src="${e.target.result}" alt="Preview" style="display: block; max-width: 100%; max-height: 360px; margin: 0 auto;">`;
                
                // Tangkap elemen yang baru saja dibuat
                const newCropperImage = document.getElementById('cropperImage');

                newCropperImage.onload = () => {
                    if (isGifUpload) {
                        saveEditButton.disabled = false;
                        saveEditButton.textContent = 'Simpan';
                        return;
                    }

                    try {
                        cropper = new Cropper(newCropperImage, {
                            aspectRatio: photoAspect[currentPhotoType],
                            viewMode: 1,
                            background: true,
                            autoCropArea: 1,
                            responsive: true,
                            movable: true,
                            zoomable: true,
                            ready: function () {
                                saveEditButton.disabled = false;
                                saveEditButton.textContent = 'Simpan';
                            }
                        });
                    } catch (error) {
                        console.error("Cropper Instantiation Error:", error);
                        alert("Gagal memuat alat pemotong: " + error.message);
                        saveEditButton.disabled = true;
                        saveEditButton.textContent = 'Simpan';
                    }
                };

                newCropperImage.onerror = () => {
                    alert("File gambar korup atau tidak dapat dibaca.");
                    saveEditButton.disabled = true;
                    saveEditButton.textContent = 'Simpan';
                };
            };
            
            reader.readAsDataURL(file);
        });

        saveEditButton.addEventListener('click', () => {
            if (!selectedFile) return;

            saveEditButton.disabled = true;
            saveEditButton.textContent = 'Menyimpan...';

            const formData = new FormData();
            formData.append('photo_type', currentPhotoType);

            if (isGifUpload) {
                formData.append('photo', selectedFile, selectedFile.name);
                sendPhotoForm(formData);
                return;
            }

            if (!cropper) {
                alert('Alat crop belum siap. Silakan pilih ulang foto.');
                saveEditButton.disabled = false;
                saveEditButton.textContent = 'Simpan';
                return;
            }

            const outputType = selectedFile.type === 'image/png' ? 'image/png' : 'image/jpeg';
            const outputName = currentPhotoType + (outputType === 'image/png' ? '.png' : '.jpg');
            
            try {
                const canvas = cropper.getCroppedCanvas({
                    width: photoSize[currentPhotoType].width,
                    height: photoSize[currentPhotoType].height
                });
                
                if (!canvas) {
                    alert('Gagal membuat potongan gambar.');
                    saveEditButton.disabled = false;
                    saveEditButton.textContent = 'Simpan';
                    return;
                }

                canvas.toBlob((blob) => {
                    if (!blob) {
                        alert('Gagal memproses gambar untuk disimpan.');
                        saveEditButton.disabled = false;
                        saveEditButton.textContent = 'Simpan';
                        return;
                    }

                    formData.append('photo', blob, outputName);
                    sendPhotoForm(formData);
                }, outputType, 0.9);
            } catch (err) {
                console.error("Canvas Error:", err);
                alert('Terjadi kesalahan saat memproses kanvas gambar.');
                saveEditButton.disabled = false;
                saveEditButton.textContent = 'Simpan';
            }
        });

        function sendPhotoForm(formData) {
            fetch(`${baseUrl}/profile/updatePhoto`, {
                method: 'POST',
                body: formData,
            })
            .then(async (response) => {
                const textResult = await response.text();
                try {
                    return JSON.parse(textResult);
                } catch (e) {
                    console.error('Bukan format JSON:', textResult);
                    throw new Error('Respons server gagal diproses.');
                }
            })
            .then((result) => {
                if (result.success) {
                    window.location.reload();
                } else {
                    alert(result.message || 'Terjadi kesalahan saat menyimpan foto.');
                    saveEditButton.disabled = false;
                    saveEditButton.textContent = 'Simpan';
                }
            })
            .catch((error) => {
                console.error('Fetch Error:', error);
                alert('Gagal terhubung ke database. Pastikan koneksi internet stabil.');
                saveEditButton.disabled = false;
                saveEditButton.textContent = 'Simpan';
            });
        }
    </script>
</main>