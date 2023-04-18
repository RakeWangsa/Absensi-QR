<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class QrcodeController extends Controller
{
    public function index($id_kelas)
    {
        $hariIni = Carbon::now()->addHours(7)->startOfDay();
        $email=session('email');
        $id_kelas = base64_decode($id_kelas);
        $id_siswa = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $cekAbsen = DB::table('absensi')
        ->where('id_siswa',$id_siswa)
        ->where('id_kelas',$id_kelas)
        ->where('waktu', '>', $hariIni)
        ->pluck('status')
        ->first();

        if($cekAbsen=='Hadir' || $cekAbsen=='Izin'){
            return redirect('/home')->with('success', 'Anda sudah absen!');
        }

        return view('qrcode.index',[
            'title' => 'Absensi',
            'active' => 'absensi',
            'id_kelas' => $id_kelas
        ]);
    }

    public function post(Request $request)
    {
        $data = $request->input('data');

        //proses


        //akhir proses
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
