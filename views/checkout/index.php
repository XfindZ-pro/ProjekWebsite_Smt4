<main class="flex-1 bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <a href="<?= BASEURL; ?>/detail/<?= $data['produk']['produk_id']; ?>" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold transition">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Detail Produk
            </a>
        </div>

        <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-slate-100" data-aos="fade-up">
            <div class="p-8 border-b border-slate-100">
                <h1 class="text-2xl font-black text-slate-900">Checkout Produk</h1>
            </div>

            <div class="p-8">
                <!-- Product Info -->
                <div class="flex items-center gap-6 mb-8 pb-8 border-b border-slate-100">
                    <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                        <?php if ($data['produk']['foto_1']): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($data['produk']['foto_1']); ?>" 
                                 alt="<?= htmlspecialchars($data['produk']['nama_produk']); ?>" 
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-3xl">📦</div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 mb-1"><?= htmlspecialchars($data['produk']['nama_produk']); ?></h2>
                        <p class="text-emerald-600 font-bold" id="basePrice" data-price="<?= $data['produk']['harga_per_kg']; ?>">
                            Rp <?= number_format($data['produk']['harga_per_kg'], 0, ',', '.'); ?> <span class="text-slate-500 font-normal text-sm">/ kg</span>
                        </p>
                    </div>
                </div>

                <!-- Checkout Form -->
                <form id="checkoutForm" method="POST">
                    
                    <!-- Hide Spin Buttons CSS -->
                    <style>
                        /* Sembunyikan spinner default browser untuk input type=number */
                        input[type="number"]::-webkit-inner-spin-button,
                        input[type="number"]::-webkit-outer-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                        input[type="number"] {
                            -moz-appearance: textfield;
                        }
                    </style>

                    <!-- Quantity Selection -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-900 mb-3">Jumlah Pembelian (kg)</label>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center bg-slate-50 rounded-2xl p-1.5 border border-slate-200 w-44">
                                <button type="button" onclick="decreaseQuantity()" class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-xl bg-white hover:bg-slate-100 transition font-bold text-lg text-slate-700 border border-slate-200 shadow-sm active:scale-95">
                                    −
                                </button>
                                <input type="number" id="quantity" name="quantity" value="<?= $data['produk']['min_order']; ?>" min="<?= $data['produk']['min_order']; ?>" step="0.1" class="w-full min-w-0 bg-transparent text-center font-bold text-lg focus:outline-none" onchange="updateTotalPrice()">
                                <button type="button" onclick="increaseQuantity()" class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-xl bg-white hover:bg-slate-100 transition font-bold text-lg text-slate-700 border border-slate-200 shadow-sm active:scale-95">
                                    +
                                </button>
                            </div>
                            <p class="text-sm text-slate-500">Min. pemesanan: <?= number_format($data['produk']['min_order'], 2, ',', '.'); ?> kg</p>
                        </div>
                    </div>

                    <!-- Metode Pengiriman -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-900 mb-3">Metode Pengiriman</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="cursor-pointer">
                                <input type="radio" name="shipping_method" value="pickup" class="peer sr-only" checked onchange="updateShippingMethod()">
                                <div class="p-4 border-2 border-slate-200 rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:bg-slate-50">
                                    <div class="font-bold text-slate-900 text-base">Ambil Sendiri (Pickup)</div>
                                    <div class="text-xs text-slate-500 mt-1">Ambil langsung di lokasi penjual (Bebas Biaya Layanan)</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="shipping_method" value="dikirim" class="peer sr-only" onchange="updateShippingMethod()">
                                <div class="p-4 border-2 border-slate-200 rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:bg-slate-50">
                                    <div class="font-bold text-slate-900 text-base">Kirim ke Alamat (Dikirim)</div>
                                    <div class="text-xs text-slate-500 mt-1">Kirim via kurir (Dikenakan Biaya Layanan Rp 15.000)</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Alamat Pengiriman (Ditampilkan jika memilih opsi Dikirim) -->
                    <div id="alamat_pengiriman_container" class="mb-8 hidden">
                        <label for="alamat_pengiriman" class="block text-sm font-bold text-slate-900 mb-3">Alamat Pengiriman</label>
                        <textarea id="alamat_pengiriman" name="alamat_pengiriman" rows="3" placeholder="Masukkan alamat pengiriman lengkap Anda (Nama Jalan, No. Rumah, RT/RW, Kecamatan, Kota/Kabupaten, Provinsi)" 
                                  class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all placeholder-slate-400 font-medium"></textarea>
                    </div>

                    <!-- Info Lokasi Pickup (Ditampilkan jika memilih opsi Pickup) -->
                    <div id="lokasi_pickup_container" class="mb-8 bg-amber-50 border border-amber-200 rounded-2xl p-4 flex gap-3">
                        <div class="text-amber-600 flex-shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">Lokasi Pengambilan Barang (Pickup):</p>
                            <p class="text-sm text-slate-700 mt-1 font-semibold"><?= htmlspecialchars($data['produk']['lokasi_pickup']); ?></p>
                        </div>
                    </div>

                    <!-- Payment Method Template -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-900 mb-3">Metode Pembayaran</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="transfer_bank" class="peer sr-only" checked>
                                <div class="p-4 border-2 border-slate-200 rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:bg-slate-50">
                                    <div class="font-bold text-slate-900">Transfer Bank</div>
                                    <div class="text-xs text-slate-500 mt-1">BCA, Mandiri, BNI</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="ewallet" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-200 rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:bg-slate-50">
                                    <div class="font-bold text-slate-900">E-Wallet</div>
                                    <div class="text-xs text-slate-500 mt-1">GoPay, OVO, Dana</div>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" class="peer sr-only">
                                <div class="p-4 border-2 border-slate-200 rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:bg-slate-50">
                                    <div class="font-bold text-slate-900">Bayar di Tempat</div>
                                    <div class="text-xs text-slate-500 mt-1">Cash On Delivery</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="bg-slate-50 rounded-2xl p-6 mb-8 border border-slate-200">
                        <h3 class="font-bold text-slate-900 mb-4">Ringkasan Pembayaran</h3>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-slate-600">Total Harga Produk</p>
                            <p class="font-semibold text-slate-900" id="totalPriceDisplay">Rp 0</p>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-slate-600">Biaya Layanan</p>
                            <p class="font-semibold text-slate-900" id="serviceFeeDisplay">Rp 0</p>
                        </div>
                        <div class="border-t border-slate-200 pt-4 flex justify-between items-center">
                            <p class="font-bold text-lg text-slate-900">Total Tagihan</p>
                            <p class="font-black text-2xl text-emerald-600" id="grandTotalDisplay">Rp 0</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitPaymentBtn" class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-emerald-700 active:scale-95 transition-all shadow-lg hover:shadow-xl">
                        Proses Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Simulation Success Modal -->
    <div id="simulationSuccessModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/75 px-4 py-8 backdrop-blur-sm transition-opacity">
        <div class="relative w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl text-center space-y-6 animate-[bounce_0.5s_ease-out_1]">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <div>
                <h3 class="text-2xl font-black text-slate-900">Pembayaran Berhasil!</h3>
                <p class="mt-3 text-sm text-slate-500 font-medium leading-relaxed">
                    Karena ini merupakan <span class="font-bold text-emerald-600">simulasi e-commerce</span>, pesanan Anda telah berhasil dibuat di database tanpa melakukan pembayaran nyata.
                </p>
            </div>
            
            <div class="pt-4 border-t border-slate-100">
                <a href="<?= BASEURL; ?>/pesanansaya" class="w-full inline-flex items-center justify-center rounded-full bg-emerald-600 px-8 py-3.5 text-base font-bold text-white hover:bg-emerald-700 transition shadow-md hover:shadow-lg active:scale-95">
                    Lihat Pesanan Saya
                </a>
            </div>
        </div>
    </div>
</main>

<script>
function updateTotalPrice() {
    const quantityInput = document.getElementById('quantity');
    const basePrice = parseFloat(document.getElementById('basePrice').dataset.price);
    let quantity = parseFloat(quantityInput.value);
    const minOrder = <?= $data['produk']['min_order']; ?>;
    
    if (isNaN(quantity) || quantity < minOrder) {
        quantity = minOrder;
        quantityInput.value = minOrder;
    }
    
    const totalPrice = basePrice * quantity;
    
    // Hitung biaya layanan berdasarkan metode pengiriman
    const shippingMethodEl = document.querySelector('input[name="shipping_method"]:checked');
    const shippingMethod = shippingMethodEl ? shippingMethodEl.value : 'pickup';
    let serviceFee = 0;
    
    if (shippingMethod === 'dikirim') {
        serviceFee = 15000; // Contoh biaya layanan Rp 15.000 jika barang dikirim
    }
    
    const grandTotal = totalPrice + serviceFee;
    
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
    
    document.getElementById('totalPriceDisplay').innerText = formatter.format(totalPrice);
    document.getElementById('serviceFeeDisplay').innerText = formatter.format(serviceFee);
    document.getElementById('grandTotalDisplay').innerText = formatter.format(grandTotal);
}

function updateShippingMethod() {
    const shippingMethodEl = document.querySelector('input[name="shipping_method"]:checked');
    const shippingMethod = shippingMethodEl ? shippingMethodEl.value : 'pickup';
    
    const alamatContainer = document.getElementById('alamat_pengiriman_container');
    const alamatInput = document.getElementById('alamat_pengiriman');
    const lokasiContainer = document.getElementById('lokasi_pickup_container');
    
    if (shippingMethod === 'dikirim') {
        alamatContainer.classList.remove('hidden');
        alamatInput.required = true;
        lokasiContainer.classList.add('hidden');
    } else {
        alamatContainer.classList.add('hidden');
        alamatInput.required = false;
        alamatInput.value = '';
        lokasiContainer.classList.remove('hidden');
    }
    
    updateTotalPrice();
}

function increaseQuantity() {
    const input = document.getElementById('quantity');
    const minOrder = <?= $data['produk']['min_order']; ?>;
    let value = parseFloat(input.value) || minOrder;
    value += minOrder;
    input.value = value.toFixed(1);
    updateTotalPrice();
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    const minOrder = <?= $data['produk']['min_order']; ?>;
    let value = parseFloat(input.value) || minOrder;
    value -= minOrder;
    if (value < minOrder) value = minOrder;
    input.value = value.toFixed(1);
    updateTotalPrice();
}

// Inisialisasi awal saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    updateShippingMethod();

    const checkoutForm = document.getElementById('checkoutForm');
    const simulationModal = document.getElementById('simulationSuccessModal');
    const submitBtn = document.getElementById('submitPaymentBtn');

    if (checkoutForm && submitBtn && simulationModal) {
        checkoutForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Kunci tombol kirim
            submitBtn.disabled = true;
            submitBtn.textContent = 'Memproses...';

            const formData = new FormData(checkoutForm);
            let baseUrl = '<?= BASEURL; ?>';
            if (window.location.protocol === 'https:') {
                baseUrl = baseUrl.replace('http:', 'https:');
            }
            const url = `${baseUrl}/checkout/<?= $data['produk']['produk_id']; ?>`;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token(); ?>'
                },
                body: formData
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.indexOf('application/json') !== -1) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        console.error('Bukan JSON:', text);
                        throw new Error('Format respons server tidak valid.');
                    });
                }
            })
            .then(res => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Proses Pembayaran';

                if (res.success) {
                    // Tampilkan modal simulasi sukses
                    simulationModal.classList.remove('hidden');
                    simulationModal.classList.add('flex');
                } else {
                    alert(res.message || 'Gagal memproses pesanan.');
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Proses Pembayaran';
                console.error(err);
                alert(err.message || 'Terjadi kesalahan koneksi saat memproses pesanan.');
            });
        });
    }
});
</script>
