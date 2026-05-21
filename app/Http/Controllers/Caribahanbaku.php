<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Caribahanbaku extends Controller
{
    public function index(Request $request)
    {
        $model = $this->model('ProdukModel');

        $filter = [
            'keyword' => $request->get('search', ''),
            'kategori' => $request->get('kategori', 'semua'),
            'lokasi' => $request->get('lokasi', ''),
            'sort' => $request->get('sort', 'terbaru')
        ];

        $data['judul'] = 'Cari Bahan Baku';
        $data['aktif'] = 'caribahanbaku';
        $data['katalog'] = $model->getKatalogFilter($filter);
        $data['current_filter'] = $filter;

        return view('templates.header', $data) .
               view('caribahanbaku.index', $data) .
               view('templates.footer');
    }
}
