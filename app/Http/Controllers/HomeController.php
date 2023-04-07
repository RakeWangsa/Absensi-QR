<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeSiswa()
    {
        return view('siswa.home', [
            'title' => 'Home'
        ]);
    }
}
