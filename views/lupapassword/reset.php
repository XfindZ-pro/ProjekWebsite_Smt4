<main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">Reset Password</p>
            <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900">Masukkan Password Baru</h1>
            <p class="mt-4 text-slate-600 text-base">Password baru Anda harus kuat dan mudah diingat.</p>
        </div>

        <?php if (!empty($message)) : ?>
            <div class="mb-6 rounded-3xl border px-6 py-5 shadow-sm <?= ($message_type === 'success' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-red-200 bg-red-50 text-red-700') ?>">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASEURL; ?>/lupapassword/updatePassword" method="post" class="rounded-[32px] border border-slate-200 bg-white shadow-sm p-8">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>" />
            <div class="space-y-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                    <input id="password" name="password" type="password" required class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" placeholder="••••••••" />
                </div>
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input id="confirm_password" name="confirm_password" type="password" required class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-slate-900 focus:border-emerald-500 focus:ring-emerald-500/20 outline-none" placeholder="••••••••" />
                </div>

                <div class="text-center">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-8 py-4 text-base font-semibold text-white shadow-md hover:bg-emerald-700 transition">Ubah Password</button>
                </div>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="<?= BASEURL; ?>/login" class="text-emerald-600 hover:text-emerald-700 font-medium">Kembali ke Login</a>
        </div>
    </div>
</main>
