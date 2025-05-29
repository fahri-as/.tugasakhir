<!DOCTYPE html>
<html>
<head>
    <title>Application Received</title>
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
        <h1>Application Received</h1>
    </div>

    <div class="content">
        <p>Dear {{ $pelamar->nama }},</p>

        <p>Thank you for submitting your application to JIWARAGA Careers. We've successfully received your application and it's now in our system for review.</p>

        <div class="details">
            <h3>Application Details:</h3>
            <p>
                <strong>Application ID:</strong> {{ $pelamar->pelamar_id }}<br>
                <strong>Position:</strong> {{ $pelamar->job ? $pelamar->job->nama_job : 'Not specified' }}<br>
                <strong>Submitted On:</strong> {{ now()->format('l, d F Y') }}
            </p>
        </div>

        <p>Your application is currently under review by our recruitment team. We appreciate your interest in joining JIWARAGA and will carefully evaluate your qualifications.</p>

        <h3>What's Next?</h3>

        <p>Our team will review your application and determine if your skills and experience match our current needs. Here's what you can expect:</p>

        <div class="steps">
            <div class="step">1. <strong>Initial Review:</strong> Our recruitment team will review your application (1-2 weeks)</div>
            <div class="step">2. <strong>Interview Process:</strong> If selected, you'll be invited for an interview</div>
            <div class="step">3. <strong>Skills Assessment:</strong> You may be asked to complete a skills test</div>
            <div class="step">4. <strong>Internship Phase:</strong> Selected candidates undergo a training period</div>
            <div class="step">5. <strong>Final Decision:</strong> Successful candidates receive job offers</div>
        </div>

        <p>You can track your application status anytime using your Application ID:</p>

        <a href="{{ route('applicant.progress.index') }}" class="button">Track Application Status</a>

        <p>If you have any questions about your application or the recruitment process, please don't hesitate to contact our recruitment team at careers@jiwaraga.com.</p>

        <p>Thank you for your interest in JIWARAGA. We wish you the best in your application!</p>

        <p>Best regards,<br>
        JIWARAGA Careers Team</p>
    </div>

    <div class="footer">
        <p>This is an automated email. Please do not reply to this message.</p>
    </div>
</body>
</html>
