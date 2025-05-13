<!-- resources/views/emails/interview-failed.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Interview</title>
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
        <h1>Hasil Interview</h1>
    </div>

    <div class="content">
        <p>Yth. Bapak/Ibu {{ $pelamar->nama }},</p>

        <p>Terima kasih atas partisipasi Anda dalam proses interview untuk posisi <strong>{{ $pelamar->job->nama_job }}</strong> pada tanggal {{ $interview->jadwal->format('d F Y') }}.</p>

        <p>Setelah melalui pertimbangan yang matang, dengan berat hati kami informasikan bahwa Anda belum dapat melanjutkan ke tahap seleksi berikutnya. Keputusan ini diambil berdasarkan penilaian menyeluruh terhadap semua kandidat dan kebutuhan spesifik perusahaan saat ini.</p>

        <div class="details">
            <h2>Detail:</h2>
            <p>
                <strong>Posisi:</strong> {{ $pelamar->job->nama_job }}<br>
                <strong>Tanggal Interview:</strong> {{ $interview->jadwal->format('d F Y') }}<br>
            </p>
        </div>

        <p>Kami mendorong Anda untuk terus mengembangkan kemampuan dan keterampilan Anda. Keputusan ini tidak mencerminkan potensi Anda secara keseluruhan, dan kami menyarankan untuk tetap mengikuti peluang karir lain yang mungkin lebih sesuai dengan profil Anda.</p>

        <p>Jika Anda memiliki pertanyaan atau membutuhkan klarifikasi lebih lanjut, jangan ragu untuk menghubungi kami.</p>

        <p>Kami mengucapkan terima kasih atas minat Anda bergabung dengan perusahaan kami dan mengharapkan yang terbaik untuk karir Anda ke depan.</p>

        <p>Hormat kami,<br>
        Departemen HR</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
