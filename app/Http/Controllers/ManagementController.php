<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagementController extends Controller
{
    public function index()
    {
        $guru = DB::table('Users')
        ->where('role','guru')
        ->select('id', 'name', 'email')
        ->get();
        $siswa = DB::table('Users')
        ->where('role','siswa')
        ->select('id', 'name', 'email')
        ->get();

        return view('managementUser.manage', [
            'title' => 'Management User',
            'active' => 'management user',
            'guru' => $guru,
            'siswa' => $siswa,
        ]);
    }

    
}
