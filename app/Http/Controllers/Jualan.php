<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Jualan extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
        
        if ($user['status_verifikasi'] !== 'disetujui') {
            return redirect('/verifikasiakun');
        }

        $data['judul'] = 'Jual Sisa Produksi';
        $data['aktif'] = 'jualan';

        return view('templates.header', $data) .
               view('jualan.index', $data) .
               view('templates.footer');
    }

    public function proses(Request $request)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $getBlob = function ($fileKey) use ($request) {
            if ($request->hasFile($fileKey)) {
                return file_get_contents($request->file($fileKey)->getRealPath());
            }
            return null;
        };

        $dataProduk = [
            'penjual_id' => $_SESSION['user_akun_id'],
            'nama_produk' => $request->input('nama_produk', ''),
            'kategori_limbah' => $request->input('kategori_limbah', ''),
            'berat_tersedia' => $request->input('berat_tersedia', 0),
            'harga_per_kg' => $request->input('harga_per_kg', 0),
            'min_order' => $request->input('min_order', 1),
            'lokasi_pickup' => $request->input('lokasi_pickup', ''),
            'kondisi_harga' => $request->input('kondisi_harga', 'Harga Pas'),
            'deskripsi' => $request->input('deskripsi', ''),
            'kondisi_fisik' => $request->input('kondisi_fisik', 'Sisa Produksi'),
            'metode_pengemasan' => $request->input('metode_pengemasan', 'Tanpa Kemasan'),
            'foto_1' => $getBlob('foto_1'),
            'foto_2' => $getBlob('foto_2'),
            'foto_3' => $getBlob('foto_3'),
            'dokumen_pendukung' => $getBlob('dokumen_pendukung'),
            'status_produk' => $request->has('draft') ? 'draft' : 'aktif'
        ];

        if ($this->model('ProdukModel')->tambahProduk($dataProduk)) {
            return redirect('/caribahanbaku');
        } else {
            return back()->with('error', 'Gagal mengunggah produk. Pastikan format gambar sesuai.');
        }
    }
}
