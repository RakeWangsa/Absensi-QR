<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DaftarKelasController extends Controller
{
    public function index()
    {
        return view('guru.daftarKelas', [
            'title' => 'Daftar Kelas',
            'active' => 'daftar kelas'
        ]);
    }
    public function tambahKelas()
    {
        $email=session('email');
        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        return view('guru.tambahKelas', [
            'title' => 'Tambah Kelas',
            'active' => 'tambah kelas',
            'name' => $name
        ]);
    }
}
