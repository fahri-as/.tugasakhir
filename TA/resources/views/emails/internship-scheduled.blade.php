<!-- resources/views/emails/internship-scheduled.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Mulai Magang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #00466a;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #00466a;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Jadwal Mulai Magang</h1>
    </div>

    <div class="content">
        <p>Yth. Bapak/Ibu {{ $pelamar->nama }},</p>

        <p>Selamat! Kami dengan senang hati memberitahukan bahwa Anda telah diterima untuk program magang pada posisi <strong>{{ $pelamar->job->nama_job }}</strong>. Setelah melalui proses seleksi yang ketat, Anda telah berhasil menunjukkan kualifikasi yang kami cari.</p>

        <div class="details">
            <h2>Detail Magang:</h2>
            <p>
                <strong>Posisi:</strong> {{ $pelamar->job->nama_job }}<br>
                <strong>Tanggal Mulai:</strong> {{ $magang->jadwal_mulai->format('d F Y') }}<br>
                <strong>Waktu Mulai:</strong> {{ $magang->jadwal_mulai->format('H:i') }} WIB<br>
            </p>
        </div>

        <p>Mohon hadir 30 menit sebelum waktu mulai yang ditentukan untuk orientasi singkat. Pastikan untuk membawa:</p>
        <ul>
            <li>Kartu identitas (KTP/SIM)</li>
            <li>Surat keterangan dari institusi pendidikan (jika ada)</li>
            <li>Perlengkapan tulis</li>
            <li>Laptop pribadi (opsional)</li>
        </ul>

        <p>Pada hari pertama, Anda akan bertemu dengan pembimbing magang Anda yang akan memberikan informasi lebih lanjut tentang tugas, tanggung jawab, dan jadwal selama program magang.</p>

        <p>Jika Anda memiliki pertanyaan atau memerlukan informasi tambahan, jangan ragu untuk menghubungi kami.</p>

        <p>Kami berharap dapat segera bertemu dan bekerja sama dengan Anda.</p>

        <p>Hormat kami,<br>
        Departemen HR</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
