<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeSiswa()
    {
        return view('siswa.home', [
            'title' => 'Home',
            'active' => 'home'
        ]);
    }

    public function homeGuru()
    {
        return view('guru.home', [
            'title' => 'Home',
            'active' => 'home'
        ]);
    }

    public function homeAdmin()
    {
        return view('admin.home', [
            'title' => 'Home',
            'active' => 'home'
        ]);
    }
}
