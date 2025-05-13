<!-- resources/views/emails/skill-test-passed.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Tes Kemampuan</title>
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
        <h1>Hasil Tes Kemampuan</h1>
    </div>

    <div class="content">
        <p>Yth. Bapak/Ibu {{ $pelamar->nama }},</p>

        <p>Kami dengan senang hati memberitahukan bahwa Anda telah <strong>LULUS</strong> tes kemampuan untuk posisi <strong>{{ $pelamar->job->nama_job }}</strong>.</p>

        <div class="details">
            <h2>Detail Hasil:</h2>
            <p>
                <strong>Posisi:</strong> {{ $pelamar->job->nama_job }}<br>
                <strong>Tanggal Tes:</strong> {{ $tesKemampuan->jadwal->format('d F Y') }}<br>
                <strong>Status:</strong> <span style="color: green; font-weight: bold;">LULUS</span>
            </p>
        </div>

        @if(isset($kontrak_jadwal))
        <div class="details" style="border-left: 4px solid #4caf50;">
            <h2>Diskusi Kontrak Kerja:</h2>
            <p>
                <strong>Tanggal:</strong> {{ $kontrak_jadwal->format('d F Y') }}<br>
                <strong>Waktu:</strong> {{ $kontrak_jadwal->format('H:i') }} WIB<br>
            </p>
        </div>

        <p>Anda dijadwalkan untuk diskusi kontrak magang pada waktu tersebut. Mohon kehadiran dan ketepatan waktu Anda untuk membahas hal-hal terkait kontrak magang.</p>
        @endif

        <p>Mohon untuk tetap memperhatikan email dan telepon Anda untuk informasi selanjutnya.</p>

        <p>Selamat atas keberhasilan Anda dalam tahap ini dan kami berharap dapat segera bekerjasama dengan Anda.</p>

        <p>Hormat kami,<br>
        Departemen HR</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
