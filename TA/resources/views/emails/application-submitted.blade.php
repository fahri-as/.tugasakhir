<!DOCTYPE html>
<html>
<head>
    <title>Lamaran Diterima</title>
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
            background-color: #f97316;
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
            border-left: 4px solid #f97316;
        }
        .steps {
            margin: 20px 0;
        }
        .step {
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            background-color: #f97316;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 15px 0;
            text-align: center;
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
        <h1>Lamaran Diterima</h1>
    </div>

    <div class="content">
        <p>Yth. {{ $pelamar->nama }},</p>

        <p>Terima kasih telah mengirimkan lamaran Anda ke JIWARAGA Careers. Kami telah berhasil menerima lamaran Anda dan saat ini sedang dalam proses peninjauan.</p>

        <div class="details">
            <h3>Detail Lamaran:</h3>
            <p>
                <strong>ID Pelamar:</strong> {{ $pelamar->pelamar_id }}<br>
                <strong>Posisi:</strong> {{ $pelamar->job ? $pelamar->job->nama_job : 'Tidak ditentukan' }}<br>
                <strong>Tanggal Pengiriman:</strong> {{ now()->format('l, d F Y') }}
            </p>
        </div>

        <p>Lamaran Anda sedang dalam proses peninjauan oleh tim rekrutmen kami. Kami menghargai ketertarikan Anda untuk bergabung dengan JIWARAGA dan akan mengevaluasi kualifikasi Anda dengan seksama.</p>

        <h3>Apa Selanjutnya?</h3>

        <p>Tim kami akan meninjau lamaran Anda dan menentukan apakah keterampilan dan pengalaman Anda sesuai dengan kebutuhan kami saat ini. Berikut adalah apa yang dapat Anda harapkan:</p>

        <div class="steps">
            <div class="step">1. <strong>Peninjauan Awal:</strong> Tim rekrutmen kami akan meninjau lamaran Anda</div>
            <div class="step">2. <strong>Proses Wawancara:</strong> Jika terpilih, Anda akan diundang untuk wawancara</div>
            <div class="step">3. <strong>Penilaian Keterampilan:</strong> Anda  akan diminta untuk menyelesaikan tes kemampuan</div>
            <div class="step">4. <strong>Tahap Magang:</strong> Kandidat terpilih akan menjalani masa pelatihan</div>
            <div class="step">5. <strong>Keputusan Akhir:</strong> Kandidat yang berhasil akan menerima tawaran kerja</div>
        </div>

        <p>Anda dapat melacak status lamaran Anda kapan saja menggunakan ID Pelamar Anda:</p>

        <a href="{{ route('applicant.progress.index') }}" class="button">Lacak Status Lamaran</a>

        <p>Jika Anda memiliki pertanyaan tentang lamaran Anda atau proses rekrutmen, jangan ragu untuk menghubungi HR kami di jiwaragacareers@gmail.com.</p>

        <p>Terima kasih atas ketertarikan Anda pada JIWARAGA. Kami mengucapkan semoga sukses dalam proses lamaran Anda!</p>

        <p>Salam hormat,<br>
        Tim JIWARAGA Careers</p>
    </div>

    <div class="footer">
        <p>Ini adalah email otomatis. Mohon tidak membalas pesan ini.</p>
    </div>
</body>
</html>
