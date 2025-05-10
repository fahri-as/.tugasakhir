<!-- resources/views/emails/interview-scheduled.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Interview</title>
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
        <h1>Jadwal Interview</h1>
    </div>

    <div class="content">
        <p>Yth. Bapak/Ibu {{ $pelamar->nama }},</p>

        <p>Terima kasih atas minat Anda untuk bergabung dengan perusahaan kami. Kami dengan senang hati menginformasikan bahwa Anda telah terjadwal untuk interview pada posisi <strong>{{ $pelamar->job->nama_job }}</strong>.</p>

        <div class="details">
            <h2>Detail Interview:</h2>
            <p>
                <strong>Tanggal:</strong> {{ $interview->jadwal->format('d F Y') }}<br>
                <strong>Waktu:</strong> {{ $interview->jadwal->format('H:i') }} WIB<br>
            </p>
        </div>

        <p>Mohon hadir 15 menit sebelum jadwal yang ditentukan. Pastikan untuk membawa:</p>
        <ul>
            <li>Kartu identitas (KTP/SIM)</li>
            <li>CV terbaru</li>
            <li>Portofolio (jika ada)</li>
            <li>Dokumen pendukung lainnya</li>
        </ul>

        <p>Jika Anda memiliki pertanyaan atau perlu penjadwalan ulang, silakan hubungi kami segera.</p>

        <p>Kami berharap dapat bertemu dengan Anda segera!</p>

        <p>Hormat kami,<br>
        Departemen HR</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
