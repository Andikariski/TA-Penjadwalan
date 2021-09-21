<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logbook</title>
</head>

<body>
    <h3>Nama : {{ Auth::user()->name }} </h3>
    <h3>NIM : 
        @if ($biodata->nim_submit)
            {{ $biodata->nim_submit}}
        @elseif($biodata->nim_terpilih)
            {{ $biodata->nim_terpilih}}
        @endif
    </h3>
    <h3>Judul : {{ $biodata->judul_topik}}</h3>
    <h3>Dosen Pembimbing : {{ $biodata->dosen->user->name}}</h3>
    <hr>
    <br>
    <table>
        <tr>
            <th width="10%">No</th>
            <th>Tanggal</th>
            <th width="25%">Kegiatan</th>
            <th width="35%">Catatan Kemajuan</th>
            <th width="10%">Acc Pembimbing</th>
        </tr>
        @forelse ($logbook as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                 @php
                    $date= $item->created_at->format('d-m-Y');
                    echo $date;
                @endphp
            </td>
            <td>{{ $item->kegiatan }}</td>
            <td>{{ $item->catatan_kemajuan }}</td>
            <td>
                @if ($item->status==0)
                    Belum Di Verifikasi                
                @else
                    Terverifikasi
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-5">
                Data tidak tersedia
            </td>
        </tr>
        @endforelse

    </table>
</body>

</html>

</html>
