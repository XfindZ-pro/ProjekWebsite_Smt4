<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Produksaya extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }
        
        $data['katalog'] = $this->model('ProdukModel')->getProdukByPenjual($_SESSION['user_akun_id']);
        
        return view('templates.header', ['aktif' => 'produksaya']) .
               view('produksaya.index', $data) .
               view('templates.footer');
    }

    public function edit($id)
    {
        $produk = $this->model('ProdukModel')->getProdukById($id);

        if (!$produk || $produk['penjual_id'] !== $_SESSION['user_akun_id']) {
            return redirect('/produksaya');
        }

        $data['judul'] = 'Edit Produk - Valora';
        $data['aktif'] = 'produksaya';
        $data['produk'] = $produk;

        return view('templates.header', $data) .
               view('produksaya.edit', $data) .
               view('templates.footer');
    }

    public function update(Request $request)
    {
        $getBlob = function ($fileKey) use ($request) {
            if ($request->hasFile($fileKey)) {
                return file_get_contents($request->file($fileKey)->getRealPath());
            }
            return null;
        };

        $data = [
            'produk_id' => $request->input('produk_id'),
            'penjual_id' => $_SESSION['user_akun_id'],
            'nama_produk' => $request->input('nama_produk'),
            'kategori_limbah' => $request->input('kategori_limbah'),
            'berat_tersedia' => $request->input('berat_tersedia'),
            'harga_per_kg' => $request->input('harga_per_kg'),
            'min_order' => $request->input('min_order'),
            'lokasi_pickup' => $request->input('lokasi_pickup'),
            'kondisi_harga' => $request->input('kondisi_harga'),
            'deskripsi' => $request->input('deskripsi'),
            'kondisi_fisik' => $request->input('kondisi_fisik'),
            'metode_pengemasan' => $request->input('metode_pengemasan'),
            'foto_1' => $getBlob('foto_1'),
            'foto_2' => $getBlob('foto_2'),
            'foto_3' => $getBlob('foto_3'),
            'dokumen_pendukung' => $getBlob('dokumen_pendukung'),
            'status_produk' => $request->has('draft') ? 'draft' : 'aktif'
        ];

        if ($this->model('ProdukModel')->updateProduk($data)) {
            return redirect('/produksaya');
        }

        return back()->with('error', 'Gagal mengupdate produk.');
    }

    public function hapus($id)
    {
        if ($this->model('ProdukModel')->hapusProduk($id, $_SESSION['user_akun_id'])) {
            return redirect('/produksaya');
        }

        return back()->with('error', 'Gagal menghapus produk.');
    }
}
