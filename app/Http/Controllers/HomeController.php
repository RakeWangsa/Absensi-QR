<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $email=session('email');
        $skrg = Carbon::now()->addHours(7);
        $hari_ini = $skrg->format('N'); // 1 untuk Senin, 2 untuk Selasa, dan seterusnya
        if($hari_ini=='1'){
            $hari_ini2='senin';
        }else if($hari_ini=='2'){
            $hari_ini2='selasa';
        }else if($hari_ini=='3'){
            $hari_ini2='rabu';
        }else if($hari_ini=='4'){
            $hari_ini2='kamis';
        }else if($hari_ini=='5'){
            $hari_ini2='jumat';
        }else if($hari_ini=='6'){
            $hari_ini2='sabtu';
        }else if($hari_ini=='7'){
            $hari_ini2='minggu';
        }

        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        $kelas = DB::table('kelas')
        ->where('guru',$name)
        ->where('hari',$hari_ini2)
        ->select('*')
        ->get();

        return view('guru.home', [
            'title' => 'Home',
            'active' => 'home',
            'kelas' => $kelas
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
