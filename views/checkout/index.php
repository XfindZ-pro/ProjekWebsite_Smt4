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
                <form action="#" method="POST">
                    
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

                    <!-- Alamat Pengiriman -->
                    <div class="mb-8">
                        <label for="alamat_pengiriman" class="block text-sm font-bold text-slate-900 mb-3">Alamat Pengiriman</label>
                        <textarea id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required placeholder="Masukkan alamat pengiriman lengkap Anda (Nama Jalan, No. Rumah, RT/RW, Kecamatan, Kota/Kabupaten, Provinsi)" 
                                  class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all placeholder-slate-400 font-medium"></textarea>
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
                            <p class="font-semibold text-slate-900">Rp 0</p>
                        </div>
                        <div class="border-t border-slate-200 pt-4 flex justify-between items-center">
                            <p class="font-bold text-lg text-slate-900">Total Tagihan</p>
                            <p class="font-black text-2xl text-emerald-600" id="grandTotalDisplay">Rp 0</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="button" onclick="alert('Ini adalah halaman template checkout. Fungsionalitas pemrosesan pesanan belum diimplementasikan.')" class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-emerald-700 active:scale-95 transition-all shadow-lg hover:shadow-xl">
                        Proses Pembayaran
                    </button>
                </form>
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
    
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
    
    const formattedPrice = formatter.format(totalPrice);
    document.getElementById('totalPriceDisplay').innerText = formattedPrice;
    document.getElementById('grandTotalDisplay').innerText = formattedPrice;
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

// Initialize total price on load
document.addEventListener('DOMContentLoaded', updateTotalPrice);
</script>
