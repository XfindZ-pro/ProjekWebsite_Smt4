<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Logout extends Controller
{
    public function index()
    {
        session_unset();
        session_destroy();
        return redirect('/');
    }
}
