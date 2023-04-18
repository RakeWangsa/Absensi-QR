<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\KelasSiswa;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function homeSiswa()
    {
        $email=session('email');
        $skrg = Carbon::now()->addHours(7);
        $hari_ini = $skrg->format('N'); // 1 untuk Senin, 2 untuk Selasa, dan seterusnya
        if($hari_ini=='1'){
            $hari_ini2='Senin';
        }else if($hari_ini=='2'){
            $hari_ini2='Selasa';
        }else if($hari_ini=='3'){
            $hari_ini2='Rabu';
        }else if($hari_ini=='4'){
            $hari_ini2='Kamis';
        }else if($hari_ini=='5'){
            $hari_ini2='Jumat';
        }else if($hari_ini=='6'){
            $hari_ini2='Sabtu';
        }else if($hari_ini=='7'){
            $hari_ini2='Minggu';
        }

        $id = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $kelasSiswa = DB::table('kelasSiswa')
        ->where('id_siswa',$id)
        ->select('kelas')
        ->get();
        
        $cek_array = array_filter(explode(',', $kelasSiswa));

        $kelas = DB::table('kelas')
        ->select('*');
        foreach ($cek_array as $value) {
            $kelas->orWhere('id', 'like', '%' . $value . '%');
        }
        $kelasku = $kelas->get();

        $kelasHariIni = DB::table('kelas')
        ->select('*');
        foreach ($cek_array as $value) {
            $kelasHariIni->orWhere('id', 'like', '%' . $value . '%')->where('hari',$hari_ini2);
        }
        $kelaskuHariIni = $kelasHariIni->get();
        return view('siswa.home', [
            'title' => 'Home',
            'active' => 'home',
            'kelasku' => $kelasku,
            'kelaskuHariIni' => $kelaskuHariIni,
        ]);
    }

    public function daftarKelasSiswa()
    {
        $email=session('email');
        $id = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $kelasSiswa = DB::table('kelasSiswa')
        ->where('id_siswa',$id)
        ->select('kelas')
        ->get();
        
        $cek_array = array_filter(explode(',', $kelasSiswa));

        $kelas = DB::table('kelas')
        ->select('*');
        foreach ($cek_array as $value) {
            $kelas->orWhere('id', 'like', '%' . $value . '%');
        }
        $kelasku = $kelas->get();

        return view('siswa.daftarKelas', [
            'title' => 'Daftar Kelas',
            'active' => 'daftar kelas',
            'kelasku' => $kelasku,
        ]);
    }

    public function tambahKelasSiswa(Request $request)
    {
        $id_kelas = DB::table('kelas')->pluck('id')->toArray();
        $messages = [
            'required' => ':attribute wajib diisi ',
            'idkelas.required' => 'ID Kelas harus diisi!',
            'idkelas.in' => 'ID Kelas tidak ditemukan',
        ];

        $this->validate($request, [
            "idkelas" => ['required',Rule::in($id_kelas)],
        ], $messages);

        $email=session('email');
        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        $id_siswa = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $kelasSiswa = DB::table('kelasSiswa')
        ->where('id_siswa',$id_siswa)
        ->pluck('kelas')
        ->first();

        if(isset($kelasSiswa)){
            KelasSiswa::where('id_siswa', $id_siswa)
            ->update([
                'kelas' => $kelasSiswa.$request->idkelas.','
        ]);

        }else{
            KelasSiswa::insert([
                'id_siswa' => $id_siswa,
                'nama' => $name,
                'kelas' => $request->idkelas.','
            ]);
        }
        

        return redirect('/daftarKelasSiswa')->with('success');
    }

    public function hapusKelasSiswa($id)
    {
        $id_kelas = base64_decode($id);
        $email=session('email');
        $id_siswa = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $hapus=$id_kelas.',';
        DB::table('kelasSiswa')
        ->where('id_siswa', $id_siswa)
        ->update(['kelas' => DB::raw("REPLACE(kelas, '$hapus', '')")]);

        Absensi::where('id_siswa', $id_siswa)->where('id_kelas', $id_kelas)->delete();

        return redirect('/daftarKelasSiswa')->with('success');
    }

    public function homeGuru()
    {
        $email=session('email');
        $skrg = Carbon::now()->addHours(7);
        $hari_ini = $skrg->format('N'); // 1 untuk Senin, 2 untuk Selasa, dan seterusnya
        if($hari_ini=='1'){
            $hari_ini2='Senin';
        }else if($hari_ini=='2'){
            $hari_ini2='Selasa';
        }else if($hari_ini=='3'){
            $hari_ini2='Rabu';
        }else if($hari_ini=='4'){
            $hari_ini2='Kamis';
        }else if($hari_ini=='5'){
            $hari_ini2='Jumat';
        }else if($hari_ini=='6'){
            $hari_ini2='Sabtu';
        }else if($hari_ini=='7'){
            $hari_ini2='Minggu';
        }

        $name = DB::table('users')
        ->where('email',$email)
        ->pluck('name')
        ->first();
        $kelas = DB::table('kelas')
        ->where('guru',$name)
        ->where('hari',$hari_ini2)
        ->select('*')
        ->get();

        return view('guru.home', [
            'title' => 'Home',
            'active' => 'home',
            'kelas' => $kelas
        ]);
    }

    public function absensi($id)
    {
        $id = base64_decode($id);
        $skrgmin15 = Carbon::now()->addHours(7)->subMinutes(15);
        $hariIni = Carbon::now()->addHours(7)->startOfDay();
        $kelas = DB::table('kelas')
        ->where('waktu_absen', '>', $skrgmin15)
        ->where('id',$id)
        ->select('*')
        ->get();
        $expired=NULL;
        if(count($kelas)>0){
            $expired = date('H:i:s', strtotime($kelas[0]->waktu_absen . ' + 15 minutes'));
        }
        $siswa = DB::table('kelasSiswa')
            ->where('kelas', 'like', '%' . $id . '%')
            ->select('*')
            ->get();
        $absensi = DB::table('absensi')
            ->where('id_kelas',$id)
            ->where('waktu', '>', $hariIni)
            ->select('*')
            ->get();

        $hadir = DB::table('absensi')
            ->where('id_kelas',$id)
            ->where('status','Hadir')
            ->where('waktu', '>', $hariIni)
            ->select('*')
            ->get();
        $izin = DB::table('absensi')
            ->where('id_kelas',$id)
            ->where('status','Izin')
            ->where('waktu', '>', $hariIni)
            ->select('*')
            ->get();
        $jumlahSiswa = count($siswa);
        $jumlahHadir = count($hadir);
        $jumlahIzin = count($izin);
        $jumlahTidakHadir = $jumlahSiswa-$jumlahHadir-$jumlahIzin;

        return view('guru.absen', [
            'title' => 'Absensi',
            'active' => 'home',
            'id' => $id,
            'kelas' => $kelas,
            'expired' => $expired,
            'siswa' => $siswa,
            'absensi' => $absensi,
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahHadir' => $jumlahHadir,
            'jumlahIzin' => $jumlahIzin,
            'jumlahTidakHadir' => $jumlahTidakHadir,
        ]);
    }

    public function homeAdmin()
    {
        return view('admin.home', [
            'title' => 'Home',
            'active' => 'home'
        ]);
    }
}
