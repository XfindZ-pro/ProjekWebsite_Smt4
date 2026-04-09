<?php

class Caribahanbaku extends Controller {
    public function index() {
        $data['aktif'] = 'caribahanbaku';

        $this->view('templates/header', $data);
        $this->view('caribahanbaku/index', $data);
        $this->view('templates/footer');
    }
}
