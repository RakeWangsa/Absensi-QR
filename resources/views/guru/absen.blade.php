@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>Absensi</h1>
         </div>
      </div>
   </div>
   
</div>

<style>
   .table-container {
     max-height: 400px;
     overflow-y: scroll;
   }
   
   table {
     width: 100%;
     border-collapse: collapse;
   }
   
   th, td {
     padding: 8px;
     text-align: left;
     border-bottom: 1px solid #ddd;
   }
   
   th {
     background-color: #c3c3c3;
     position: sticky;
     top: 0;
   }
   
   </style>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center mt-4">
                  @if(count($kelas)>0)
                     <h3 class="mt-3">Scan QR Code dibawah untuk melakukan absen</h3>
                     <p class="mt-3">Code ini berlaku hingga {{ $expired }}</p>
                     {!! QrCode::size(250)->generate($kelas[0]->code_absen) !!}
                     <p class="mt-3">{{ $kelas[0]->code_absen }}</p>
                     <a type="button" class="btn btn-primary mb-4" a href="{{ route('generateQR', ['id' => base64_encode($id)]) }}">
                        <i class="bi bi-qr-code-scan text-white me-2"></i><span>Generate ulang QR Code</span>
                     </a>
                  @else
                     <a type="button" class="btn btn-primary mb-4" a href="{{ route('generateQR', ['id' => base64_encode($id)]) }}">
                        <i class="bi bi-qr-code-scan text-white me-2"></i><span>Generate QR Code</span>
                     </a>
                  @endif
                  
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             <h5 class="card-title">Daftar Hadir Siswa</h5>
             <p>Hadir : {{ $jumlahHadir }}, Izin : {{ $jumlahIzin }}, Tidak Hadir : {{ $jumlahTidakHadir }}</p>
             <div class="table-container border">
             <table>
                <thead>
                   <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">ID Siswa</th>
                    <th scope="col" class="text-center">Nama</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($absensi) > 0)
                  @foreach($absensi as $item)
                  {{-- @php($absensi = \App\Models\Absensi::where('id_siswa', $item->id_siswa)->first()) --}}
                   <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="text-center">{{ $item->id_siswa }}</td>
                      <td class="text-center">{{ $item->nama }}</td>
                      <td class="text-center">{{ $item->status }}</td>
                      <td class="text-center">
                        <a class="btn btn-primary" style="border-radius: 100px;" a href="{{ route('setHadir', ['id_siswa' => base64_encode($item->id_siswa), 'id_kelas' => base64_encode($id)]) }}"><i class="bi bi-check-circle"></i></a>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('setIzin', ['id_siswa' => base64_encode($item->id_siswa), 'id_kelas' => base64_encode($id)]) }}"><i class="bi bi-exclamation-circle"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" a href="{{ route('setTidakHadir', ['id_siswa' => base64_encode($item->id_siswa), 'id_kelas' => base64_encode($id)]) }}"><i class="bi bi-x-circle"></i></a>
                     </td>
                   </tr>
                   @endforeach
                   @else
                   <tr>
                     <td colspan="6" class="text-center">Tidak ada siswa</td>
                   </tr>
                   @endif
                </tbody>
             </table>
            </div>
         </div>
      </div>
</div>
@endsection