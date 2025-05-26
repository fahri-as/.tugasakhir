<!DOCTYPE html>
<html>
<head>
    <title>Contract Discussion Schedule</title>
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
        <h1>Contract Discussion Schedule</h1>
    </div>

    <div class="content">
        <p>Dear {{ $pelamar->nama }},</p>

        <p>Congratulations on successfully passing your skill test for the <strong>{{ $pelamar->job->nama_job }}</strong> position! We're pleased to invite you to a contract discussion session to finalize the next steps in your employment process.</p>

        <div class="details">
            <h2>Contract Discussion Details:</h2>
            <p>
                <strong>Position:</strong> {{ $pelamar->job->nama_job }}<br>
                <strong>Date:</strong> {{ $discussionDate->format('l, d F Y') }}<br>
                <strong>Time:</strong> {{ $discussionDate->format('H:i') }} WIB<br>
                <strong>Location:</strong> Our office at Jl. Veteran No.15, Purus, Kec. Padang Bar., Kota Padang, Sumatera Barat 25115. https://g.co/kgs/8NRXWuK<br>
            </p>
        </div>

        <p>During this meeting, we'll discuss:</p>
        <ul>
            <li>Employment contract terms</li>
            <li>Salary and benefits</li>
            <li>Work schedule and responsibilities</li>
            <li>Company policies and expectations</li>
        </ul>

        <p>Please bring the following items to the discussion:</p>
        <ul>
            <li>Original ID card (KTP/SIM)</li>
            <li>Latest educational certificates</li>
            <li>Any questions you may have about the position</li>
        </ul>

        <p>Please confirm your attendance by replying to this email or contacting our HR department.</p>

        <p>We look forward to meeting with you!</p>

        <p>Best regards,<br>
        HR Department</p>
    </div>

    <div class="footer">
        <p>This is an automated email. Please do not reply directly.</p>
    </div>
</body>
</html>
