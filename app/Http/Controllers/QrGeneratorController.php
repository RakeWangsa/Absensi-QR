<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrGeneratorController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->input('data');
        $qrCode = QrCode::size(300)->generate($data);

        return view('qrcode', compact('qrCode'));
    }
}
