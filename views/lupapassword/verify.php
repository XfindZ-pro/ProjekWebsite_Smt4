<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">Verifikasi OTP</p>
            <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900">Masukkan kode OTP</h1>
            <p class="mt-4 text-slate-600 text-base">Kami telah mengirimkan kode OTP ke email <strong><?= htmlspecialchars($email); ?></strong>. Masukkan 6 digit kode untuk melanjutkan reset password.</p>
        </div>

        <?php if (!empty($message)) : ?>
            <div class="mb-6 rounded-3xl border px-6 py-5 shadow-sm <?= ($message_type === 'success' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-red-200 bg-red-50 text-red-700') ?>">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASEURL; ?>/lupapassword/submitOtp" method="post" class="rounded-[32px] border border-slate-200 bg-white shadow-sm p-8">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email); ?>" />
            <div class="space-y-6">
                <div>
                    <label for="kode_otp" class="block text-sm font-medium text-slate-700">Kode OTP</label>
                    <input id="kode_otp" name="kode_otp" type="text" maxlength="6" required class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" placeholder="123456" />
                </div>

                <div class="text-center">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-8 py-4 text-base font-semibold text-white shadow-md hover:bg-emerald-700 transition">Verifikasi OTP</button>
                </div>
            </div>
        </form>

        <div class="mt-6 text-center space-y-4">
            <form action="<?= BASEURL; ?>/lupapassword/resendOtp" method="post" class="inline-flex justify-center">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email); ?>" />
                <button type="submit" class="rounded-full border border-emerald-600 px-6 py-3 text-emerald-600 bg-white hover:bg-emerald-50 transition">Kirim ulang OTP</button>
            </form>
            <a href="<?= BASEURL; ?>/lupapassword" class="text-emerald-600 hover:text-emerald-700 font-medium">Gunakan email lain</a>
        </div>
    </div>
</main>
