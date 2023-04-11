@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>Daftar Kelas</h1>
         </div>
         <div class="col-auto">
            <a class="btn btn-primary mt-4" href="/tambahKelas"><i class="bi bi-person-fill-add me-2"></i><span>Tambah Kelas</span></a>
         </div>
      </div>
   </div>
   
</div>

<style>
   .table-container {
     max-height: 200px;
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


<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             <h5 class="card-title">Daftar Kelas Anda</h5>
             <div class="table-container border">
             <table>
                <thead>
                   <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">ID Kelas</th>
                    <th scope="col" class="text-center">Pengajar</th>
                    <th scope="col" class="text-center">Ruang</th>
                    <th scope="col" class="text-center">Pelajaran</th>
                    <th scope="col" class="text-center">Waktu</th>
                    <th scope="col" class="text-center">Action</th>
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($kelas) > 0)
                  @foreach($kelas as $item)
                   <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="text-center">{{ $item->id }}</td>
                      <td class="text-center">{{ $item->guru }}</td>
                      <td class="text-center">{{ $item->ruang }}</td>
                      <td class="text-center">{{ $item->pelajaran }}</td>
                      <td class="text-center">{{ $item->hari }}, {{ substr($item->waktu, 0, 5) }}</td>
                      <td class="text-center">
                        <a class="btn btn-success" style="border-radius: 100px;" a href="{{ route('daftarSiswa', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-card-checklist"></i></a>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('editKelas', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-pencil-square text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusKelas', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-trash"></i></a>
                     </td>
                   </tr>
                   @endforeach
                   @else
                   <tr>
                     <td colspan="6" class="text-center">Tidak ada kelas</td>
                   </tr>
                   @endif
                </tbody>
             </table>
            </div>
         </div>
      </div>
</div>

<div class="row">
   <div class="card col-md-12 mt-2 pb-4">
      <div class="card-body">
          <h5 class="card-title">Daftar Semua Kelas</h5>
          <div class="table-container border">
          <table>
             <thead>
                <tr>
                 <th scope="col" class="text-center">No</th>
                 <th scope="col" class="text-center">ID Kelas</th>
                 <th scope="col" class="text-center">Pengajar</th>
                 <th scope="col" class="text-center">Ruang</th>
                 <th scope="col" class="text-center">Pelajaran</th>
                 <th scope="col" class="text-center">Waktu</th>
                </tr>
             </thead>
             
             <tbody>
               @php($no=1)
               @if(count($semuaKelas) > 0)
               @foreach($semuaKelas as $item)
                <tr>
                   <td scope="row" class="text-center">{{ $no++ }}</td>
                   <td class="text-center">{{ $item->id }}</td>
                   <td class="text-center">{{ $item->guru }}</td>
                   <td class="text-center">{{ $item->ruang }}</td>
                   <td class="text-center">{{ $item->pelajaran }}</td>
                   <td class="text-center">{{ $item->hari }}, {{ substr($item->waktu, 0, 5) }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="6" class="text-center">Tidak ada kelas</td>
                </tr>
                @endif
             </tbody>
          </table>
         </div>
      </div>
   </div>
</div>
@endsection