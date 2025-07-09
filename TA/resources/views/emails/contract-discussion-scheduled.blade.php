<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Diskusi Kontrak</title>
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
        <h1>Jadwal Diskusi Kontrak</h1>
    </div>

    <div class="content">
        <p>Yth. {{ $pelamar->nama }},</p>

        <p>Selamat atas keberhasilan Anda dalam melewati tes kemampuan untuk posisi <strong>{{ $pelamar->job->nama_job }}</strong>! Kami dengan senang hati mengundang Anda untuk sesi diskusi kontrak guna memfinalisasi langkah selanjutnya dalam proses penerimaan kerja Anda.</p>

        <div class="details">
            <h2>Detail Diskusi Kontrak:</h2>
            <p>
                <strong>Posisi:</strong> {{ $pelamar->job->nama_job }}<br>
                <strong>Tanggal:</strong> {{ $discussionDate->format('l, d F Y') }}<br>
                <strong>Waktu:</strong> {{ $discussionDate->format('H:i') }} WIB<br>
                <strong>Lokasi:</strong> Kantor kami di Jl. Veteran No.15, Purus, Kec. Padang Bar., Kota Padang, Sumatera Barat 25115. https://g.co/kgs/8NRXWuK<br>
            </p>
        </div>

        <p>Selama pertemuan ini, kita akan membahas:</p>
        <ul>
            <li>Ketentuan kontrak kerja</li>
            <li>Gaji dan tunjangan</li>
            <li>Jadwal kerja dan tanggung jawab</li>
            <li>Kebijakan perusahaan dan ekspektasi</li>
        </ul>

        <p>Mohon membawa item berikut untuk diskusi:</p>
        <ul>
            <li>Kartu identitas asli (KTP/SIM)</li>
            <li>Ijazah pendidikan terakhir</li>
            <li>Pertanyaan yang mungkin Anda miliki tentang posisi tersebut</li>
        </ul>

        <p>Mohon konfirmasi kehadiran Anda dengan membalas email ini atau menghubungi HR kami di jiwaragacareers@gmail.com.</p>

        <p>Kami menantikan pertemuan dengan Anda!</p>

        <p>Salam hormat,<br>
        Tim JIWARAGA Careers</p>
    </div>

    <div class="footer">
        <p>Ini adalah email otomatis. Mohon jangan membalas langsung.</p>
    </div>
</body>
</html>
