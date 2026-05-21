<?php

namespace App\Http\Controllers;

class NotFound extends Controller
{
    public function index()
    {
        return view('errors.404');
    }
}
