<aside id="sidebar" class="sidebar">
   <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
         @auth
            @if (auth()->user()->role=="admin")
               <a class="nav-link collapsed {{ ($active === "management user") ? 'active' : '' }}" href="/managementUser"> <i class="bi bi-people"></i><span>Management User</span> </a>              
            @elseif (auth()->user()->role=="siswa")
               <a class="nav-link collapsed {{ ($active === "home") ? 'active' : '' }}" href="/home"> <i class="bi bi-grid"></i><span>Home</span> </a>
               <a class="nav-link collapsed {{ ($active === "daftar kelas") ? 'active' : '' }}" href="/daftarKelasSiswa"> <i class="bi bi-list-ul"></i><span>Daftar Kelas</span> </a>
               <a class="nav-link collapsed {{ ($active === "riwayat absen") ? 'active' : '' }}" href="/riwayatAbsen"> <i class="bi bi-clock-history"></i><span>Riwayat Absen</span> </a>                 
            @elseif (auth()->user()->role=="guru")
               <a class="nav-link collapsed {{ ($active === "home") ? 'active' : '' }}" href="/home/guru"> <i class="bi bi-grid"></i><span>Home</span> </a>
               <a class="nav-link collapsed {{ ($active === "daftar kelas") ? 'active' : '' }}" href="/daftarKelas"> <i class="bi bi-list-ul"></i><span>Daftar Kelas</span> </a>  
            @endif        
         @endauth    
            {{-- @elseif (auth()->user()->level=="pengunjung")
               <a class="nav-link collapsed {{ ($active === "pengunjung") ? 'active' : '' }}" href="/dashboard"> <i class="bi bi-grid"></i><span>Dashboard</span> </a>
               <a class="nav-link collapsed {{ ($active === "antrian") ? 'active' : '' }}" href="/ambil/antrian"> <i class="bx bxs-add-to-queue"></i><span>Ambil Antrian</span> </a>
               <a class="nav-link collapsed {{ ($active === "daftar antrian") ? 'active' : '' }}" href="/daftar/antrian"> <i class="bi bi-list-ul"></i><span>Daftar Antrian</span> </a>  
            @elseif (auth()->user()->level=="admin")
               <a class="nav-link collapsed {{ ($active === "admin") ? 'active' : '' }}" href="/dashboard/admin"> <i class="bi bi-grid"></i><span>Dashboard</span> </a>
               <a class="nav-link collapsed {{ ($active === "management user") ? 'active' : '' }}" href="/managementUser"> <i class="bi bi-people"></i><span>Management User</span> </a>
               <a class="nav-link collapsed {{ ($active === "daftar antrian") ? 'active' : '' }}" href="/daftar/antrian/admin"> <i class="bi bi-list-ul"></i><span>Daftar Antrian</span> </a>
               <a class="nav-link collapsed {{ ($active === "setting") ? 'active' : '' }}" href="/setting/admin"> <i class="bi bi-gear"></i><span>Setting</span> </a>   
            @endif
         @else
            <a class="nav-link collapsed {{ ($active === "pengunjung") ? 'active' : '' }}" href="/dashboard"> <i class="bi bi-grid"></i><span>Dashboard</span> </a>
            <a class="nav-link collapsed {{ ($active === "antrian") ? 'active' : '' }}" href="/ambil/antrian"> <i class="bx bxs-add-to-queue"></i><span>Ambil Antrian</span> </a>
            <a class="nav-link collapsed {{ ($active === "daftar antrian") ? 'active' : '' }}" href="/daftar/antrian"> <i class="bi bi-list-ul"></i><span>Daftar Antrian</span> </a>
         @endauth   --}}
      </li>
      @auth
         <li class="nav-item">
            <form action="/logout" method="post" class="nav-link collapsed">
               @csrf
                  <button type="submit">
                     <i class="bi bi-box-arrow-in-left"></i><span>Logout</span>
                  </button>
            </form>
         </li>
      @else
         <li class="nav-heading">Pages</li>
         <li class="nav-item"> <a class="nav-link collapsed" href="pages-faq.html"> <i class="bi bi-question-circle"></i> <span>F.A.Q</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="pages-contact.html"> <i class="bi bi-envelope"></i> <span>Contact</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="/login"> <i class="bi bi-box-arrow-in-right"></i> <span>Login</span> </a></li>
      @endauth 
   </ul>
</aside>