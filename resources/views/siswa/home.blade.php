@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>Home</h1>
         </div>
      </div>
   </div>
</div>


<style>
   .table-container {
     max-height: 300px;
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

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             <h5 class="card-title">Daftar Kelas Anda Hari Ini</h5>
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
                  @if(count($kelaskuHariIni) > 0)
                  @foreach($kelaskuHariIni as $item)
                   <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="text-center">{{ $item->id }}</td>
                      <td class="text-center">{{ $item->guru }}</td>
                      <td class="text-center">{{ $item->ruang }}</td>
                      <td class="text-center">{{ $item->pelajaran }}</td>
                      <td class="text-center">{{ $item->hari }}, {{ substr($item->waktu, 0, 5) }}</td>
                      <td class="text-center">
                        <a class="btn btn-success" style="border-radius: 100px;" a href="{{ route('scan', ['id_kelas' => base64_encode($item->id)]) }}"><i class="bi bi-qr-code-scan text-white"></i></a>
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
@endsection