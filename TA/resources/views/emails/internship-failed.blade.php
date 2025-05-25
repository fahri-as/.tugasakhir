@component('mail::message')
# Important Notice Regarding Your Internship

Dear {{ $pelamar->nama }},

We regret to inform you that your internship evaluation has concluded and **you have not met the required criteria** to successfully complete the program.

## Internship Details
- **Position**: {{ $pelamar->job ? $pelamar->job->nama_job : 'Not specified' }}
- **Period**: {{ $pelamar->periode ? $pelamar->periode->nama_periode : 'Not specified' }}

While this outcome may be disappointing, please consider it a learning opportunity. Each experience, regardless of its outcome, contributes to personal and professional growth. We encourage you to reflect on the feedback provided during your time with us and use it to strengthen your skills for future opportunities.

@component('mail::button', ['url' => config('app.url')])
Visit Our Website
@endcomponent

If you have any questions regarding this decision or would like to receive detailed feedback on your performance, please don't hesitate to contact our Human Resources department.

We appreciate the time and effort you invested during your internship period and wish you success in your future endeavors.

Best regards,
{{ config('app.name') }} Team
@endcomponent
