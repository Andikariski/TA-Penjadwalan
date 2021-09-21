<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ url('assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }} 
                            <span class="user-level">
                                @if (Auth::user()->hasRole('super_admin'))
                                    Super Admin
                                @elseif(Auth::user()->hasRole('dosen'))
                                    Dosen
                                @elseif(Auth::user()->hasRole('mahasiswa'))
                                    Mahasiswa    
                                @endif
                                
                            </span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../demo1/index.html">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="../demo2/index.html">
                                    <span class="sub-item">Dashboard 2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @if (Auth::user()->hasRole('dosen|super_admin'))
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Topik Metopen</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/penelitian') }}">
                                    <span class="sub-item">Topik saya</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/penelitian/create') }}">
                                    <span class="sub-item">Buat Penawaran topik</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/mytopik') }}">
                                    <span class="sub-item">Request Mahasiswa</span>
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#bimbingan">
                        <i class="fas fa-user-friends"></i>
                        <p>Bimbingan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="bimbingan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/bimbingan') }}">
                                    <span class="sub-item">Bimbingan saya</span>
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#exam">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Penilaian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="exam">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/semprop-penguji') }}">
                                    <span class="sub-item">Seminar Proposal</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('nilai-pendadaran-penguji') }}">
                                    <span class="sub-item">Pendadaran</span>
                                </a>
                            </li>   
                           
                        </ul>
                    </div>
                </li>
                @endif
                
                @if (Auth::user()->hasRole('mahasiswa'))
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Topik Metopen</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/topik') }}">
                                    <span class="sub-item">Ajukan judul</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/penawaran/topiksaya') }}">
                                    <span class="sub-item">Request Saya</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/penawaran') }}">
                                    <span class="sub-item">Lihat Penawaran</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#log">
                        <i class="fas fa-book"></i>
                        <p>Logbook</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="log">
                        <ul class="nav nav-collapse">
                            
                            <li>
                                <a href="{{ url('/logbook') }}">
                                    <span class="sub-item">Lihat Logbook</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logbook/create') }}">
                                    <span class="sub-item">Tambah Logbook</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#ujian">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Daftar Ujian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="ujian">
                        <ul class="nav nav-collapse">
                            
                            <li>
                                <a href="{{ url('/daftar-semprop/create') }}">
                                    <span class="sub-item">Seminar Proposal</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/daftar-pendadaran/create') }}">
                                    <span class="sub-item">Pendadaran</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                @endif

                
                
                @if (Auth::user()->hasRole('super_admin'))
                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-users"></i>
                        <p>Dosen</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/dosen') }}">
                                    <span class="sub-item">Daftar dosen</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#setting">
                        <i class="fas fa-cogs"></i>
                        <p>Setting</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/setup') }}">
                                    <span class="sub-item">Setting</span>
                                </a>
                                <a href="{{ url('/data-mahasiswa') }}">
                                    <span class="sub-item">Data Mahasiswa</span>
                                </a>
                                <a href="{{ route('jadwalDosen') }}">
                                    <span class="sub-item">Jadwal Dosen</span>
                                </a>
                                <a href="{{ route('linkgooglemeet') }}">
                                    <span class="sub-item">Link Google Meet</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#skripsi">
                        <i class="fas fa-book"></i>
                        <p>Skripsi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="skripsi">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/skripsi') }}">
                                    <span class="sub-item">Judul Tugas akhir Mahasiswa</span>
                                </a>
                                <a href="{{ route('dataPenjadwalan') }}">
                                    <span class="sub-item">Data Jadwal Ujian</span>
                                </a>
                                <a href="{{ route('dataMahasiswa') }}">
                                    <span class="sub-item">Penjadwalan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#daftar">
                        <i class="fas fa-laptop"></i>
                        <p>Pendaftaran Ujian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="daftar">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/semprop-register') }}">
                                    <span class="sub-item">Seminar proposal</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/pendadaran-register') }}">
                                    <span class="sub-item">Pendadaran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                
                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Tables</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/jqvmap.html">
                                    <span class="sub-item">JQVMap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Charts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                {{-- <li class="mx-4 mt-2">
                    <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a> 
                </li> --}}
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->