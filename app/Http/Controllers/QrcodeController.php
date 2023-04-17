<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function index($id_kelas)
    {
        $id_kelas = base64_decode($id_kelas);
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
