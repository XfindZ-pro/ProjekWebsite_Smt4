<?php

class NotFound extends Controller {
    public function index() {
        // Memanggil view 404 di dalam folder errors
        $this->view('errors/404');
    }
}