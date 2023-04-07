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

    public function homeGuru()
    {
        return view('guru.home', [
            'title' => 'Home'
        ]);
    }

    public function homeAdmin()
    {
        return view('admin.home', [
            'title' => 'Home'
        ]);
    }
}
