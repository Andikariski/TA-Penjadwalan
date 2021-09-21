<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Pemberitahuan Sidang Skripsi</title >
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
 
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Pemberitahuan Jadwal Sidang Skripsi</span>
    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #000000">Kepada <b>{{ $kepada }}</b></p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #000000">Assalamualaikum Warahmatullahi Wabarakatuh.<br>Yang terhormat bapak dan ibu dosen, serta mahasiswa program studi teknik informatika Universitas Ahmad Dahlan.
                         Dengan ini kami menginfromasikan bahwa akan di adakan <?php 
                          if($jenis_ujian == 0){
                             echo ' <strong>Ujian Seminar Proposal</strong> ';
                          }elseif($jenis_ujian == 1){
                               echo ' <strong>Ujian Pendadaran Tugas Akhir</strong> ';
                             }
                        ?>dengan data sebagai berikut: </p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                        </table>
                        <table style="margin-top: 5px">
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .15rem 0" width="150px"> Nim Mahasiswa
                            </td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $nim }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .15rem 0" width="150px"> Nama Mahasiswa
                            </td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $nama_mahasiswa }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .15rem 0" width="150px">Judul Skripsi</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $judul_skripsi }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Topik Skripsi</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $topik_skripsi }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Dosen Pembimbing</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $dosen_pembimbing }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Dosen Penguji 1</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $dosen_penguji_1 }}</th>
                          </tr>
                          @if ($jenis_ujian == 1)      
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Dosen penguji 2</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $dosen_penguji_2 }}</th>
                          </tr>
                          @endif
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Periode</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $periode }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Tanggal</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $tanggal }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Waktu</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $waktu_mulai . ' - ' . $waktu_selesai}} WIB</th>
                          </tr> 
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0" width="150px">Status</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left">{{ $status }}</th>
                          </tr>
                          <tr>
                            <th style="color: #000000; text-align: left; padding: .7rem 0 .3rem; border-bottom: 2px solid #000000" colspan="3">Meeting</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .6rem 0 .3rem">Platform</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left; padding: .3rem 0">Google Meet</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0">Ruang Ujian</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="color: #000000; text-align: left; padding: .3rem 0">Room Google Meet {{ $ruang_pertemuan }}</th>
                          </tr>
                          <tr>
                            <td style="color: #000000; text-align: left; padding: .3rem 0">Link Google Meet</td>
                            <th style="color: #000000; text-align: left; padding-left: 5px; padding-right: 10px">:</th>
                            <th style="text-align: left"><a href="{{ $link_meet }}">{{ $link_meet }}</a></th>
                          </tr>
                        </table>
                        <br /><br />
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #000000">Demikian yang dapat kami sampaikan, Harapanya dapat menjadi perhatian, Terimakasih.</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #000000">Hormat Kami: <b style="color: #000000">Administrator SIMTAKHIR</b></p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- START FOOTER -->
            <div style="color: #888; font-size: 13px; font-family: sans-serif; margin-top: 30px; text-align: center; width: 100%">Program Studi Teknik Informatika</div>
            <div style="color: #888; font-size: 13px; font-family: sans-serif; margin-top: 5px; text-align: center; width: 100%">Powered by SIMTAKHIR Universitas Ahmad Dahlan</div>
            <!-- END FOOTER -->
          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>