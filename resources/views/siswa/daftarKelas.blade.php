@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="mt-4">
         @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
                 </ul>
             </div>
         @endif
     </div>
      <div class="row align-items-center">
         <div class="col">
            <h1>Daftar Kelas</h1>
         </div>
         <div class="col-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
               <i class="bi bi-person-fill-add me-2"></i><span>Tambah Kelas</span>
            </button>
                <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
               <div class="modal-content">
                  
                  <form class="row g-3 mt-3" method="GET" action="/tambahKelasSiswa">
                  <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     
                        <div class="col-md-12"> <label for="idkelas" class="form-label">Masukkan ID Kelas :</label> <input type="text" class="form-control" id="idkelas" name="idkelas" value="" required></div>
                     
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </form>
               </div>
               </div>
            </div>
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
               @if(count($kelasku) > 0)
               @foreach($kelasku as $item)
                <tr>
                   <td scope="row" class="text-center">{{ $no++ }}</td>
                   <td class="text-center">{{ $item->id }}</td>
                   <td class="text-center">{{ $item->guru }}</td>
                   <td class="text-center">{{ $item->ruang }}</td>
                   <td class="text-center">{{ $item->pelajaran }}</td>
                   <td class="text-center">{{ $item->hari }}, {{ substr($item->waktu, 0, 5) }}</td>
                   <td class="text-center">
                     <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirmDelete()" a href="{{ route('hapusKelasSiswa', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-trash"></i></a>
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
<script>
function confirmDelete() {
    var confirmation = prompt("Peringatan!!\nJika kelas dihapus maka seluruh riwayat absen\nanda pada kelas ini akan dihapus juga\nUntuk melanjutkan, ketik 'Konfirmasi':");
    if (confirmation === "konfirmasi" || confirmation === "Konfirmasi") {
        return true;
    } else {
        return false;
    }
}
</script>
<script>
  // ambil elemen form dan input
  var form = document.querySelector('#exampleModal form');
  var inputIdKelas = document.querySelector('#idkelas');
  
  // tambahkan event listener pada saat form disubmit
  form.addEventListener('submit', function(event) {
    // cek apakah input kosong atau tidak
    if (inputIdKelas.value.trim() === '') {
      // jika kosong, berikan alert
      alert('Kolom inputan belum diisi!');
      // hentikan proses submit form
      event.preventDefault();
    }
  });
</script>

@endsection