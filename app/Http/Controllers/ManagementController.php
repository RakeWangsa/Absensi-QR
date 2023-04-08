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

    public function editUser($id)
    {
        $id = base64_decode($id);
        $user = DB::table('Users')
        ->where('id',$id)
        ->select('id', 'name', 'email')
        ->get();
        return view('managementUser.editUser', [
            "title" => "Edit User",
            'active' => 'edit user',
            'user' => $user,
            'id' => $id
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $id = base64_decode($id);
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email,'.$id,
            'password' => 'nullable|min:5|max:255'
        ]);

        $user = User::findOrFail($id);

        $user->name = $validatedData['nama'];
        $user->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect('/managementUser')->with('success', 'Data user berhasil diupdate!');
    }

    public function hapusUser($id)
    {
        $id = base64_decode($id);
        User::where('id', $id)->delete();

        return redirect('/managementUser')->with('success');
    }
}
