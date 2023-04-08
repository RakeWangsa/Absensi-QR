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

    public function tambah(Request $request)
    {
        return view('register.registerGuru', [
            'title' => 'Register Guru',
            'active' => 'register guru',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
        $validatedData['role'] = 'guru';
        //$validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //$request->session()->flash('success', 'Registration successfully! Please login!');

        return redirect('/managementUser')->with('success', 'Registrasi Berhasil!');
    }

    public function hapusUser($id)
    {
        $id = base64_decode($id);
        User::where('id', $id)->delete();

        return redirect('/managementUser')->with('success');
    }
}
