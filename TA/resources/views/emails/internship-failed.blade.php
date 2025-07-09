@component('mail::message')
# Pemberitahuan Penting Mengenai Magang Anda

Yth. {{ $pelamar->nama }},

Dengan berat hati kami informasikan bahwa evaluasi magang Anda telah selesai dan **Anda belum memenuhi kriteria yang diperlukan** untuk menyelesaikan program dengan berhasil.

## Detail Magang
- **Posisi**: {{ $pelamar->job ? $pelamar->job->nama_job : 'Tidak ditentukan' }}
- **Periode**: {{ $pelamar->periode ? $pelamar->periode->nama_periode : 'Tidak ditentukan' }}

Meskipun hasil ini mungkin mengecewakan, mohon anggap ini sebagai kesempatan untuk belajar. Setiap pengalaman, terlepas dari hasilnya, berkontribusi pada pertumbuhan pribadi dan profesional. Kami mendorong Anda untuk merefleksikan umpan balik yang diberikan selama waktu Anda bersama kami dan menggunakannya untuk memperkuat keterampilan Anda untuk kesempatan di masa depan.

@component('mail::button', ['url' => config('app.url')])
Kunjungi Website Kami
@endcomponent

Jika Anda memiliki pertanyaan mengenai keputusan ini atau ingin menerima umpan balik mendetail tentang kinerja Anda, jangan ragu untuk menghubungi HR kami di jiwaragacareers@gmail.com.

Kami menghargai waktu dan upaya yang Anda berikan selama periode magang dan mendoakan kesuksesan untuk Anda di masa depan.

Salam hormat,
Tim {{ config('app.name') }}
@endcomponent
