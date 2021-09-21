@component('mail::message')
<p>
Hai {{ $data['email'] }}

Ini adalah kode OTP Anda: <b>{{ $data['otpCode'] }}</b>.
<br>
Silakan gunakan untuk login ke Sistem Pengelolaan Tugas Akhir Prodi Teknik Informatika UAD (SIMTAKHIR).

Thanks,<br>
Admin {{ config('app.name') }}
@endcomponent
