<?php

class Jualan extends Controller {
    public function index() {
        $data['aktif'] = 'jualan';

        $this->view('templates/header', $data);
        $this->view('jualan/index', $data);
        $this->view('templates/footer');
    }
}
