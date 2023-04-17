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
        $id_kelas = base64_decode($id_kelas);
        // $messages = [
        //     'required' => ':attribute wajib diisi ',
        //     'idkelas.required' => 'ID Kelas harus diisi!',
        //     'idkelas.in' => 'ID Kelas tidak ditemukan',
        // ];

        // $this->validate($request, [
        //     "idkelas" => ['required',Rule::in($id_kelas)            ],
        // ], $messages);

        $email=session('email');
        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        $id_siswa = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();

        if($request->scan=='999'){
            Absensi::insert([
                'id_siswa' => $id_siswa,
                'nama' => $name,
                'id_kelas' => $id_kelas,
                'status' => 'hadir'
            ]);
            return redirect('/home')->with('success', 'Berhasil melakukan absensi');
        }

        
        

        
    }
}
