<?php

class Login extends Controller {
    public function index() {
        $data['aktif'] = 'login';
        
        $this->view('templates/header', $data);
        $this->view('auth/login');
        $this->view('templates/footer');
    }
}