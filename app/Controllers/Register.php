<?php

class Register extends Controller {
    public function index() {
        $data['aktif'] = 'register';
        
        $this->view('templates/header', $data);
        $this->view('auth/register');
        $this->view('templates/footer');
    }
}