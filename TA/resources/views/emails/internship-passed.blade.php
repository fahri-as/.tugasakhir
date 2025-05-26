@component('mail::message')
# Congratulations, {{ $pelamar->nama }}!

We are pleased to inform you that you have successfully **completed your internship** with us. Your dedication, hard work, and contributions throughout your time here have been remarkable.

## Internship Details
- **Position**: {{ $pelamar->job ? $pelamar->job->nama_job : 'Not specified' }}
- **Period**: {{ $pelamar->periode ? $pelamar->periode->nama_periode : 'Not specified' }}

Your performance during the internship has been evaluated, and we are happy to share that you have met all the requirements and expectations. This accomplishment represents an important milestone in your professional journey.

@if($discussionDate)
## Contract Discussion
We would like to invite you to a contract discussion meeting to discuss potential employment opportunities:

- **Date**: {{ $discussionDate->format('l, d F Y') }}
- **Time**: {{ $discussionDate->format('H:i') }} WIB
- **Location**: Our office at Jl. Veteran No.15, Purus, Kec. Padang Bar., Kota Padang, Sumatera Barat 25115

Please bring your ID card, educational certificates, and any questions you may have about the position.
@endif

@component('mail::button', ['url' => config('app.url')])
Visit Our Website
@endcomponent

Should you require a certificate of completion or a reference letter, please feel free to contact our Human Resources department. We would be happy to provide any documentation you need for your future endeavors.

Thank you for being part of our team. We wish you every success in your future career!

Best regards,
{{ config('app.name') }} Team
@endcomponent
