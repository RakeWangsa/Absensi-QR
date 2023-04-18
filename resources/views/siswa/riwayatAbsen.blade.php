@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>Riwayat Absen</h1>
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


<div class="row">

   


      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body mt-4">
             <div class="table-container border">
               <table>
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">ID Kelas</th>
                      <th scope="col" class="text-center">Pelajaran</th>
                      <th scope="col" class="text-center">Pengajar</th>
                      <th scope="col" class="text-center">Status</th>
                      <th scope="col" class="text-center">Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($no=1)
                    @if(count($absensi) > 0)
                      @foreach($absensi as $item)
                        @php($kelas = \App\Models\Kelas::where('id', $item->id_kelas)->first())
                        <tr>
                          <td scope="row" class="text-center">{{ $no++ }}</td>
                          <td class="text-center">{{ $item->id_kelas }}</td>
                          <td class="text-center">{{ $kelas->pelajaran }}</td>
                          <td class="text-center">{{ $kelas->guru }}</td>
                          <td class="text-center">{{ $item->status }}</td>
                          <td class="text-center">{{ $item->waktu }}</td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="6" class="text-center">Tidak ada absensi</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
                
                
            </div>
         </div>
      </div>
</div>
@endsection