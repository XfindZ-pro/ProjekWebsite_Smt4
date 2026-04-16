<?php

class Caribahanbaku extends Controller {
    public function index() {
        $model = $this->model('AkunModel');

        // Menangkap parameter dari URL (GET)
        $filter = [
            'keyword' => $_GET['search'] ?? '',
            'kategori' => $_GET['kategori'] ?? 'semua',
            'lokasi' => $_GET['lokasi'] ?? '',
            'sort' => $_GET['sort'] ?? 'terbaru'
        ];

        $data['judul'] = 'Cari Bahan Baku';
        $data['aktif'] = 'caribahanbaku';
        $data['katalog'] = $model->getKatalogFilter($filter);
        $data['current_filter'] = $filter;

        $this->view('templates/header', $data);
        $this->view('caribahanbaku/index', $data);
        $this->view('templates/footer');
    }
}