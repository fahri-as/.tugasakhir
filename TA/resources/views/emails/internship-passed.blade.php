@component('mail::message')
# Selamat, {{ $pelamar->nama }}!

Dengan senang hati kami informasikan bahwa Anda telah berhasil **menyelesaikan masa magang** bersama kami. Dedikasi, kerja keras, dan kontribusi Anda selama waktu di sini sangat luar biasa.

## Detail Magang
- **Posisi**: {{ $pelamar->job ? $pelamar->job->nama_job : 'Tidak ditentukan' }}
- **Periode**: {{ $pelamar->periode ? $pelamar->periode->nama_periode : 'Tidak ditentukan' }}

Kinerja Anda selama magang telah dievaluasi, dan kami dengan senang hati memberi tahu bahwa Anda telah memenuhi semua persyaratan dan ekspektasi. Pencapaian ini mewakili tonggak penting dalam perjalanan profesional Anda.

@if($discussionDate)
## Diskusi Kontrak
Kami ingin mengundang Anda ke pertemuan diskusi kontrak untuk membahas peluang kerja potensial:

- **Tanggal**: {{ $discussionDate->format('l, d F Y') }}
- **Waktu**: {{ $discussionDate->format('H:i') }} WIB
- **Lokasi**: Kantor kami di Jl. Veteran No.15, Purus, Kec. Padang Bar., Kota Padang, Sumatera Barat 25115

Mohon bawa kartu identitas Anda, ijazah pendidikan, dan pertanyaan yang mungkin Anda miliki tentang posisi tersebut.
@endif

@component('mail::button', ['url' => config('app.url')])
Kunjungi Website Kami
@endcomponent

Jika Anda memerlukan sertifikat penyelesaian atau surat referensi, jangan ragu untuk menghubungi departemen Sumber Daya Manusia kami. Kami akan dengan senang hati menyediakan dokumentasi apa pun yang Anda butuhkan untuk masa depan Anda.

Terima kasih telah menjadi bagian dari tim kami. Kami mendoakan kesuksesan untuk Anda dalam karir Anda ke depan!

Salam hormat,
Tim {{ config('app.name') }}
@endcomponent
