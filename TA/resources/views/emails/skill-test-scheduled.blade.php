<!-- resources/views/emails/skill-test-scheduled.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Tes Kemampuan</title>
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
        <h1>Jadwal Tes Kemampuan</h1>
    </div>

    <div class="content">
        <p>Yth. Bapak/Ibu {{ $pelamar->nama }},</p>

        <p>Selamat! Anda telah lulus tahap interview untuk posisi <strong>{{ $pelamar->job->nama_job }}</strong>. Kami dengan senang hati mengundang Anda untuk mengikuti tes kemampuan sebagai tahap selanjutnya dalam proses seleksi.</p>

        <div class="details">
            <h2>Detail Tes Kemampuan:</h2>
            <p>
                <strong>Tanggal:</strong> {{ $tesKemampuan->jadwal->format('d F Y') }}<br>
                <strong>Waktu:</strong> {{ $tesKemampuan->jadwal->format('H:i') }} WIB<br>
            </p>
        </div>

        <p>Mohon hadir 15 menit sebelum jadwal yang ditentukan. Pastikan untuk membawa:</p>
        <ul>
            <li>Kartu identitas (KTP/SIM)</li>
            <li>CV terbaru</li>
            <li>Portfolio karya (jika ada)</li>
            <li>Alat tulis</li>
        </ul>

        <p>Tes kemampuan akan mencakup pengetahuan dan keterampilan yang relevan dengan posisi yang Anda lamar. Persiapkan diri Anda dengan baik.</p>

        <p>Jika Anda memiliki pertanyaan atau perlu mengatur ulang jadwal, silakan hubungi kami segera.</p>

        <p>Hormat kami,<br>
        Departemen HR</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
