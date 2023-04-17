<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function generateQR($id)
    {
        $idkelas = base64_decode($id);
        $rand = mt_rand(100000, 999999);
        $skrg = Carbon::now()->addHours(7);
        //dd($idkelas);
        Kelas::where('id', $idkelas)
            ->update([
                'code_absen' => $rand,
                'waktu_absen' => $skrg
        ]);

        return redirect('/home/absensi/'.$id)->with('rand', $rand);
        
    }

    public function submitAbsen(Request $request, $id_kelas)
    {
        $idkelas = base64_decode($id_kelas);
        $skrg = Carbon::now()->addHours(7);
        $skrgmin15 = Carbon::now()->addHours(7)->subMinutes(15);
        $email=session('email');
        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        $id_siswa = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();

        $code_absen=DB::table('kelas')
        ->where('id',$idkelas)
        ->where('waktu_absen', '>', $skrgmin15)
        ->pluck('code_absen')
        ->first();

        if($request->scan==$code_absen){
            Absensi::insert([
                'id_siswa' => $id_siswa,
                'nama' => $name,
                'id_kelas' => $idkelas,
                'waktu' => $skrg,
                'status' => 'hadir'
            ]);
            return redirect('/home')->with('success', 'Berhasil melakukan absensi');
        }else{
            return redirect('/scan/'.$id_kelas)->with('success', 'Absensi gagal, silahkan coba lagi!');
        }

        
        

        
    }
}
