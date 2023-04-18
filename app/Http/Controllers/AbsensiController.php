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
        $id_kelas = base64_decode($id);
        $rand = mt_rand(100000, 999999);
        $skrg = Carbon::now()->addHours(7);
        $hariIni = Carbon::now()->addHours(7)->startOfDay();
        $cek = DB::table('kelas')
        ->where('id',$id_kelas)
        ->pluck('waktu_absen')
        ->first();
        if($cek<$hariIni){
            $siswa = DB::table('kelasSiswa')
            ->where('kelas', 'like', '%' . $id_kelas . '%')
            ->select('*')
            ->get();

            foreach ($siswa as $data) {
                $id_siswa = $data->id_siswa;
                $nama = $data->nama;

                Absensi::insert([
                    'id_siswa' => $id_siswa,
                    'nama' => $nama,
                    'id_kelas' => $id_kelas,
                    'waktu' => $skrg,
                    'status' => 'Tidak Hadir'
                ]);
            }
        }
        Kelas::where('id', $id_kelas)
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
                'status' => 'Hadir'
            ]);
            return redirect('/home')->with('success', 'Berhasil melakukan absensi');
        }else{
            return redirect('/scan/'.$id_kelas)->with('success', 'Absensi gagal, silahkan coba lagi!');
        }
    }

    public function riwayatAbsen()
    {
        $email=session('email');
        $id_siswa = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $absensi = DB::table('absensi')
        ->where('id_siswa',$id_siswa)
        ->select('*')
        ->get();
        $kelas = DB::table('kelas')
        ->select('*')
        ->get();
        return view('siswa.riwayatAbsen', [
            'title' => 'Riwayat Absen',
            'active' => 'riwayat absen',
            'absensi' => $absensi,
            'kelas' => $kelas,
        ]);
    }

    public function setHadir($id_kelas,$id_siswa)
    {
        $id_siswa = base64_decode($id_siswa);
        $idkelas = base64_decode($id_kelas);
        $skrg = Carbon::now()->addHours(7);
        $hariIni = Carbon::now()->addHours(7)->startOfDay();
        $name = DB::table('users')
        ->where('id',$id_siswa)
        ->pluck('name')
        ->first();
        $cek = DB::table('absensi')
        ->where('id_siswa',$id_siswa)
        ->where('waktu', '>', $hariIni)
        ->pluck('status')
        ->first();

        if(isset($cek)){
            $rowToUpdate = Absensi::where('id_siswa', $id_siswa)
                ->where('id_kelas', $idkelas)
                ->orderBy('id', 'desc')
                ->first();
                if($rowToUpdate){
                    $rowToUpdate->update([
                        'status' => 'Hadir',
                        'waktu' => $skrg,
                    ]);
                }
        }else{
            Absensi::insert([
                'id_siswa' => $id_siswa,
                'nama' => $name,
                'id_kelas' => $idkelas,
                'status' => 'Hadir',
                'waktu' => $skrg,
            ]);
        }

                

        return redirect('/home/absensi/'.$id_kelas)->with('success');
    }
    public function setIzin($id_kelas,$id_siswa)
    {
        $id_siswa = base64_decode($id_siswa);
        $idkelas = base64_decode($id_kelas);
        $skrg = Carbon::now()->addHours(7);
        $hariIni = Carbon::now()->addHours(7)->startOfDay();
        $name = DB::table('users')
        ->where('id',$id_siswa)
        ->pluck('name')
        ->first();
        $cek = DB::table('absensi')
        ->where('id_siswa',$id_siswa)
        ->where('waktu', '>', $hariIni)
        ->pluck('status')
        ->first();

        if(isset($cek)){
            $rowToUpdate = Absensi::where('id_siswa', $id_siswa)
                ->where('id_kelas', $idkelas)
                ->orderBy('id', 'desc')
                ->first();
                if($rowToUpdate){
                    $rowToUpdate->update([
                        'status' => 'Izin',
                        'waktu' => $skrg,
                    ]);
                }
        }else{
            Absensi::insert([
                'id_siswa' => $id_siswa,
                'nama' => $name,
                'id_kelas' => $idkelas,
                'status' => 'Izin',
                'waktu' => $skrg,
            ]);
        }
        return redirect('/home/absensi/'.$id_kelas)->with('success');
    }

    public function setTidakHadir($id_kelas,$id_siswa)
    {
        $id_siswa = base64_decode($id_siswa);
        $idkelas = base64_decode($id_kelas);
        $skrg = Carbon::now()->addHours(7);
        $hariIni = Carbon::now()->addHours(7)->startOfDay();
        $name = DB::table('users')
        ->where('id',$id_siswa)
        ->pluck('name')
        ->first();
        $cek = DB::table('absensi')
        ->where('id_siswa',$id_siswa)
        ->where('waktu', '>', $hariIni)
        ->pluck('status')
        ->first();

        if(isset($cek)){
            $rowToUpdate = Absensi::where('id_siswa', $id_siswa)
                ->where('id_kelas', $idkelas)
                ->orderBy('id', 'desc')
                ->first();
                if($rowToUpdate){
                    $rowToUpdate->update([
                        'status' => 'Tidak Hadir',
                        'waktu' => $skrg,
                    ]);
                }
        }else{
            Absensi::insert([
                'id_siswa' => $id_siswa,
                'nama' => $name,
                'id_kelas' => $idkelas,
                'status' => 'Tidak Hadir',
                'waktu' => $skrg,
            ]);
        }
        return redirect('/home/absensi/'.$id_kelas)->with('success');
    }

}
