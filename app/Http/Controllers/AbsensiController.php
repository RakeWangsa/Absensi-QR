<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;

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
}
