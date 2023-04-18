<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class DaftarKelasController extends Controller
{
    public function index()
    {
        $email=session('email');
        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        $kelas = DB::table('kelas')
        ->where('guru',$name)
        ->select('*')
        ->get();
        $semuaKelas = DB::table('kelas')
        ->select('*')
        ->get();
        return view('guru.daftarKelas', [
            'title' => 'Daftar Kelas',
            'active' => 'daftar kelas',
            'kelas' => $kelas,
            'semuaKelas' => $semuaKelas
        ]);
    }

    public function daftarSiswa($id)
    {
        $id = base64_decode($id);
        $siswa = DB::table('kelasSiswa')
            ->where('kelas', 'like', '%' . $id . '%')
            ->select('*')
            ->get();

        return view('guru.daftarSiswa', [
            'title' => 'Daftar Siswa',
            'active' => 'daftar siswa',
            'siswa' => $siswa,
            'id' => $id,
        ]);
    }

    public function tambahKelas()
    {
        $email=session('email');
        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        return view('guru.tambahKelas', [
            'title' => 'Tambah Kelas',
            'active' => 'tambah kelas',
            'name' => $name
        ]);
    }

    public function tambahKelasSubmit(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'hari.required' => 'Pilih Hari!',
            'hari.not_in' => 'Pilih Hari!',
            'ruang.required' => 'Ruang harus diisi!',
            'pelajaran.required' => 'Pelajaran harus diisi!',
            'waktu.required' => 'Pilih Waktu!',
        ];

        $this->validate($request, [
            "ruang" => ['required'],
            "pelajaran" => ['required'],
            'hari' => ['required', Rule::notIn(['Pilih Hari!'])],
            "waktu" => ['required'],
        ], $messages);

        Kelas::insert([
                'guru' => $request->guru,
                'pelajaran' => $request->pelajaran,
                'ruang' => $request->ruang,
                'hari' => $request->hari,
                'waktu' => $request->waktu,
            ]);

        return redirect('/daftarKelas')->with('success');
    }

    public function editKelas($id)
    {
        $id = base64_decode($id);
        $kelas = DB::table('kelas')
        ->where('id',$id)
        ->select('id', 'ruang', 'pelajaran', 'guru', 'hari', 'waktu')
        ->get();
        return view('guru.editKelas', [
            "title" => "Edit User",
            'active' => 'edit user',
            'kelas' => $kelas,
            'id' => $id
        ]);
    }

    public function updateKelas(Request $request, $id)
    {
        $id = base64_decode($id);
        $messages = [
            'required' => ':attribute wajib diisi ',
            'hari.required' => 'Pilih Hari!',
            'hari.not_in' => 'Pilih Hari!',
            'ruang.required' => 'Ruang harus diisi!',
            'pelajaran.required' => 'Pelajaran harus diisi!',
            'waktu.required' => 'Pilih Waktu!',
        ];

        $this->validate($request, [
            "ruang" => ['required'],
            "pelajaran" => ['required'],
            'hari' => ['required', Rule::notIn(['Pilih Hari!'])],
            "waktu" => ['required'],
        ], $messages);

        Kelas::where('id', $id)->update([
            'guru' => $request->guru,
            'pelajaran' => $request->pelajaran,
            'ruang' => $request->ruang,
            'hari' => $request->hari,
            'waktu' => $request->waktu,
        ]);        

        return redirect('/daftarKelas')->with('success');
    }

    public function hapusKelas($id)
    {
        $id = base64_decode($id);
        Kelas::where('id', $id)->delete();

        return redirect('/daftarKelas')->with('success');
    }
}
