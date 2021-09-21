<head>
  <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ url('assets/css/atlantis.min.css')}}">
  
  
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="{{ url('assets/css/demo.css')}}">
  
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <style>
    /* -------------------------------------
        INLINED WITH htmlemail.io/inline
    ------------------------------------- */
    /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
    ------------------------------------- */
    @media only screen and (max-width: 620px) {
      table[class=body] h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }
      table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
        font-size: 16px !important;
      }
      table[class=body] .wrapper,
            table[class=body] .article {
        padding: 10px !important;
      }
      table[class=body] .content {
        padding: 0 !important;
      }
      table[class=body] .container {
        padding: 0 !important;
        width: 100% !important;
      }
      table[class=body] .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      table[class=body] .btn table {
        width: 100% !important;
      }
      table[class=body] .btn a {
        width: 100% !important;
      }
      table[class=body] .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }

    /* -------------------------------------
        PRESERVE THESE STYLES IN THE HEAD
    ------------------------------------- */
    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }
      .btn-primary table td:hover {
        background-color: #34495e !important;
      }
      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    </style>
<?php
$nim = '1700018174';
$nama_mahasiswa = 'M Andika Riski';
$judul_skripsi  = 'Refactore dan pengembangan test suite otomatis pada sistem paenjadwalan tugas akhir';
$topik_skripsi = 'Multimedia';
$dosen_pembimbing = 'Ardiansyah, S.T., M.Cs.';
$dosen_penguji_1 = 'Supriyanto, S.T.,M.T.';
$dosen_penguji_2 = 'Murein Miksa Mardhia, S.T., M.T';
$periode = 'Ganjil 2020/2021';
$tanggal ='20 Juli 2021';
$waktu_mulai = '07.00';
$waktu_selesai = '11.00';
$ruang = 'Ruang 7';
$status = 'Mahasiswa';
$kepada = 'M Andika Riski';
$jenis_ujian = 1;
?>

<div class="container">
<div class="card m-5">
    <div class="card-header bg-primary">   
          <img src="{{ url('assets/img/simtakhir3.svg')}}" alt="navbar brand" class="navbar-brand text-center pull-left">   
    </div> 

    <div class="card-body m-4">
      <h3>Kepada, <strong>{{ $kepada }}</strong></h3>
      <h5 class="card-text mt-2">Assalamualaikum Warahmatullahi Wabarakatuh.<br>
        Yang terhormat bapak dan ibu dosen, serta mahasiswa program studi teknik informatika Universitas Ahmad Dahlan. Dengan ini kami menginfromasikan bahwa akan di adakan 
        <?php 
        if($jenis_ujian == 0){
           echo '<strong>Ujian Seminar Proposal,</strong>';
        }elseif($jenis_ujian == 1){
             echo '<strong>Ujian Pendadaran Tugas Akhir,</strong>';
           }
      ?>
      dengan data sebagai berikut :  
        </h5>
    <div class="mt-4">
    <table>
        <tr>
          <td style="color:#575962; text-align: left;" width="200px"><h5>Nim Mahasiswa</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 25px"><h5>:</h5></td>
          <td style="color:#575962; text-align: left;"><h5><strong>{{ $nim }}</strong></h5></td>
        </tr>
        <tr>
          <td style="color:#575962; text-align: left;"><h5>Nama Mahasiswa</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          <td style="color:#575962; text-align: left; "><h5><strong>{{ $nama_mahasiswa }}</strong></h5></td>
        </tr>
        <tr>
          <td style="color:#575962; text-align: left;"><h5>Judul Skripsi</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          <td style="color:#575962; text-align: left; "><h5><strong>{{ $judul_skripsi }}</strong></h5></td>
        </tr>
        <tr>
          <td style="color:#575962; text-align: left;"><h5>Topik Skripsi</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          <td style="color:#575962; text-align: left; "><h5><strong>{{ $topik_skripsi }}</strong></h5></td>
        </tr>
        <tr>
          <td style="color:#575962; text-align: left;"><h5>Dosen Pembimbing</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          <td style="color:#575962; text-align: left; "><h5><strong>{{ $dosen_pembimbing }}</strong></h5></td>
        </tr>      
        <tr>
          <td style="color:#575962; text-align: left;"><h5>Dosen penguji 1</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          <td style="color:#575962; text-align: left; "><h5><strong>{{ $dosen_penguji_1 }}</strong></h5></td>
        </tr>

        @if ($jenis_ujian == 1)     
        <tr>
            <td style="color:#575962; text-align: left;"><h5>Dosen penguji 2</h5></td>
            <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
            <td style="color:#575962; text-align: left; "><h5><strong>{{ $dosen_penguji_2 }}</strong></h5></td>
        </tr>
        @endif
        <tr>
            <td style="color:#575962; text-align: left;"><h5>Tanggal</h5></td>
            <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
            <td style="color:#575962; text-align: left; "><h5><strong>{{ $tanggal }}</strong></h5></td>
        <tr>
        <tr>
            <td style="color:#575962; text-align: left;"><h5>Waktu</h5></td>
            <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
            <td style="color:#575962; text-align: left; "><h5><strong>{{ $waktu_mulai . ' - ' . $waktu_selesai }} WIB </strong></h5></td>
        <tr>
        <tr>
            <td style="color:#575962; text-align: left;"><h5>Ruang Ujian</h5></td>
            <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
            <td style="color:#575962; text-align: left; "><h5><strong>{{ $ruang }}</strong></h5></td>
        <tr>
        <tr>
            <td style="color:#575962; text-align: left;"><h5>Status</h5></td>
            <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
            <td style="color:#575962; text-align: left; "><h5><strong>{{ $status }}</strong></h5></td>
        <tr>
        <tr>
          <th style="color: #575962; text-align: left; padding: .7rem 0 .3rem;">Meeting</th>
        </tr>
        <br>
        <tr class="mt-2">
          <td style="color:#575962; text-align: left;"><h5>Platform</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          {{-- <th style="color: #000000; text-align: left; padding: .3rem 0">{{ is_null($meeting) ? '-' : $meeting['platform'] }}</th> --}}
        </tr>
        <tr class="mt-2">
          <td style="color:#575962; text-align: left;"><h5>Meeting ID</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          {{-- <th style="color: #000000; text-align: left; padding: .3rem 0">{{ is_null($meeting) ? '-' : $meeting['platform'] }}</th> --}}
        </tr>
        <tr class="mt-2">
          <td style="color:#575962; text-align: left;"><h5>Link Google Meet</h5></td>
          <td style="color:#575962; text-align: left; padding-left: 5px; padding-right: 10px""><h5>:</h5></td>
          {{-- <th style="color: #000000; text-align: left; padding: .3rem 0">{{ is_null($meeting) ? '-' : $meeting['platform'] }}</th> --}}
        </tr>
      </table>
    </div>
      <br /><br />
      <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #000000"><P>Demikian yang dapat kami sampaikan, Harapanya dapat menjadi perhatian, Terimakasih.</p>
      <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #000000"><P>Hormat Kami: <b style="color: #000000">Administrator SIMTAKHIR</b></p>
    </td>
  </tr>
</table>
    </div>
    <div class="card-footer text-center bg-primary text-white">Powered by SIMTAKHIR<br>Teknik Informatika Universitas Ahmad Dahlan</div>
  </div>
</div>

<script src="{{ url('assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{ url('assets/js/core/popper.min.js')}}"></script>
<script src="{{ url('assets/js/core/bootstrap.min.js')}}"></script>