<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Verifikasiakun extends Controller
{
    public function index(Request $request)
    {
        if (!isset($_SESSION['user_akun_id']) || empty($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);

        if ($user && $user['status_verifikasi'] === 'disetujui') {
            return redirect('/jualan');
        }

        $data['aktif'] = 'verifikasiakun';
        $data['user'] = $user;
        $data['pending'] = isset($user['status_verifikasi']) && $user['status_verifikasi'] === 'menunggu';
        $data['message'] = $request->get('message');
        $data['message_type'] = $request->get('type');

        return view('templates.header', $data) .
               view('verifikasiakun.index', $data) .
               view('templates.footer');
    }

    public function submit(Request $request)
    {
        if (!isset($_SESSION['user_akun_id']) || empty($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $akunModel = $this->model('AkunModel');
        $verifikasiModel = $this->model('VerifikasiModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);

        if ($user && $user['status_verifikasi'] === 'disetujui') {
            return redirect('/jualan');
        }

        if ($user && $user['status_verifikasi'] === 'menunggu') {
            return redirect('/verifikasiakun')->with([
                'message' => 'Pengajuan Anda sedang diproses.',
                'type' => 'info'
            ]);
        }

        $jenis_entitas = $request->input('jenis_entitas', '');
        $nama_usaha = trim($request->input('nama_usaha', ''));
        $alamat_usaha = trim($request->input('alamat_usaha', ''));
        $nomor_telepon = trim($request->input('nomor_telepon', ''));

        if (empty($jenis_entitas) || empty($nama_usaha) || empty($alamat_usaha) || empty($nomor_telepon)) {
            return back()->with([
                'message' => 'Semua kolom wajib diisi.',
                'type' => 'error'
            ]);
        }

        if (!$request->hasFile('file_ktp') || !$request->hasFile('file_izin_usaha')) {
            return back()->with([
                'message' => 'File KTP dan/atau izin usaha wajib diunggah.',
                'type' => 'error'
            ]);
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

        $ktpMime = mime_content_type($request->file('file_ktp')->getRealPath());
        $izinMime = mime_content_type($request->file('file_izin_usaha')->getRealPath());

        if (!in_array($ktpMime, $allowedTypes, true) || !in_array($izinMime, $allowedTypes, true)) {
            return back()->with([
                'message' => 'Format file tidak didukung. Gunakan JPG, PNG, atau PDF.',
                'type' => 'error'
            ]);
        }

        $ktp_blob = file_get_contents($request->file('file_ktp')->getRealPath());
        $izin_blob = file_get_contents($request->file('file_izin_usaha')->getRealPath());

        $dataPengajuan = [
            'akun_id' => $_SESSION['user_akun_id'],
            'jenis_entitas' => $jenis_entitas,
            'nama_usaha' => $nama_usaha,
            'alamat_usaha' => $alamat_usaha,
            'nomor_telepon' => $nomor_telepon,
            'file_ktp' => $ktp_blob,
            'file_izin_usaha' => $izin_blob,
            'status_verifikasi' => 'menunggu'
        ];

        if ($verifikasiModel->ajukanVerifikasi($dataPengajuan)) {
            $akunModel->updateStatusVerifikasi($_SESSION['user_akun_id'], 'menunggu');
            
            return redirect('/verifikasiakun')->with([
                'message' => 'Pengajuan verifikasi berhasil dikirim. Silakan tunggu persetujuan admin.',
                'type' => 'success'
            ]);
        }

        return back()->with([
            'message' => 'Terjadi kesalahan saat menyimpan pengajuan.',
            'type' => 'error'
        ]);
    }
}
