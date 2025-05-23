<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Your Application Progress</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 text-gray-800 flex p-6 lg:p-8 items-center min-h-screen flex-col">
        <header class="w-full max-w-7xl text-sm mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Application Progress Tracker</h1>
            </div>
            <nav class="flex items-center justify-end gap-4">
                <a
                    href="{{ route('applicant.progress.index') }}"
                    class="inline-block px-5 py-1.5 text-gray-800 border border-gray-300 hover:border-gray-400 rounded-md text-sm leading-normal"
                >
                    Back to Periods
                </a>
            </nav>
        </header>

        <div class="flex items-center justify-center w-full">
            <main class="w-full max-w-7xl">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">Application Progress for {{ $pelamar->nama }}</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                Application ID: {{ $pelamar->pelamar_id }}
                            </p>
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 bg-gray-50 p-4 rounded-lg">
                                    <h3 class="font-medium text-gray-900 mb-2">Personal Information</h3>
                                    <div class="grid grid-cols-1 gap-2">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">Position Applied</span>
                                            <span class="text-sm">{{ $pelamar->job->nama_job }}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">Period</span>
                                            <span class="text-sm">{{ $pelamar->periode->nama_periode }}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">Status</span>
                                            <span class="text-sm font-medium
                                                {{ $pelamar->status_seleksi === 'Pending' ? 'text-yellow-600' :
                                                  ($pelamar->status_seleksi === 'Rejected' ? 'text-red-600' : 'text-green-600') }}">
                                                {{ $pelamar->status_seleksi }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:w-1/2 bg-gray-50 p-4 rounded-lg">
                                    <h3 class="font-medium text-gray-900 mb-2">Contact Information</h3>
                                    <div class="grid grid-cols-1 gap-2">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">Email</span>
                                            <span class="text-sm">{{ $pelamar->email }}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">WhatsApp</span>
                                            <span class="text-sm">{{ $pelamar->nomor_wa }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Recruitment Stages Progress</h3>

                            <ol class="relative border-l border-gray-300 ml-6 mb-10">
                                <!-- Document Screening -->
                                <li class="mb-10 ml-6">
                                    @php
                                        // Document screening is passed if the applicant has an interview, test or internship record
                                        $documentPassed = $pelamar->interview || $pelamar->tesKemampuan || $pelamar->magang;
                                        $documentRejected = $pelamar->status_seleksi === 'Rejected';
                                        $documentPending = !$documentPassed && !$documentRejected;
                                    @endphp
                                    <span class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-4
                                        {{ $documentPassed ? 'bg-green-200 ring-green-100 text-green-800' :
                                           ($documentRejected ? 'bg-red-200 ring-red-100 text-red-800' :
                                           'bg-yellow-200 ring-yellow-100 text-yellow-800') }}">
                                        @if($documentPassed)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                            </svg>
                                        @elseif($documentRejected)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        @else
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Document Screening</h3>
                                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">
                                        {{ $pelamar->created_at->format('d M Y') }}
                                    </time>
                                    <p class="mb-4 text-base font-normal text-gray-600">
                                        @if($documentPassed)
                                            Your application documents have passed our initial screening.
                                        @elseif($documentRejected)
                                            Your application did not match our requirements at this time.
                                        @else
                                            Your application documents are currently being reviewed.
                                        @endif
                                    </p>
                                </li>

                                <!-- Interview -->
                                @if($pelamar->interview || $pelamar->tesKemampuan || $pelamar->magang)
                                <li class="mb-10 ml-6">
                                    @php
                                        // Interview is passed if the applicant has a test or internship record
                                        $interviewPassed = ($pelamar->interview && $pelamar->interview->hasil === 'Lulus') ||
                                                           $pelamar->tesKemampuan ||
                                                           $pelamar->magang;
                                        $interviewFailed = $pelamar->interview && $pelamar->interview->hasil === 'Gagal';
                                        $interviewPending = $pelamar->interview && !$interviewPassed && !$interviewFailed;
                                    @endphp
                                    <span class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-4
                                        {{ $interviewPassed ? 'bg-green-200 ring-green-100 text-green-800' :
                                           ($interviewFailed ? 'bg-red-200 ring-red-100 text-red-800' :
                                           'bg-blue-200 ring-blue-100 text-blue-800') }}">
                                        @if($interviewPassed)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                            </svg>
                                        @elseif($interviewFailed)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        @else
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Interview</h3>
                                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">
                                        {{ $pelamar->interview && $pelamar->interview->tanggal_wawancara ? $pelamar->interview->tanggal_wawancara->format('d M Y') : 'Scheduled' }}
                                    </time>
                                    <p class="mb-4 text-base font-normal text-gray-600">
                                        @if($interviewPassed)
                                            You've successfully passed the interview stage.
                                        @elseif($interviewFailed)
                                            Thank you for your participation in the interview. Unfortunately, you did not meet our requirements at this stage.
                                        @elseif($pelamar->interview && $pelamar->interview->tanggal_wawancara && $pelamar->interview->tanggal_wawancara->isFuture())
                                            Your interview is scheduled for {{ $pelamar->interview->tanggal_wawancara->format('d M Y') }} at {{ $pelamar->interview->tanggal_wawancara->format('H:i') }}.
                                        @elseif($pelamar->interview && $pelamar->interview->tanggal_wawancara)
                                            Your interview was held on {{ $pelamar->interview->tanggal_wawancara->format('d M Y') }}. Results are being processed.
                                        @else
                                            Your interview is being scheduled. Please check back later.
                                        @endif
                                    </p>
                                </li>
                                @endif

                                <!-- Skills Test -->
                                @if($pelamar->tesKemampuan || $pelamar->magang)
                                <li class="mb-10 ml-6">
                                    @php
                                        // Test is passed if the applicant has an internship record or has passed the test
                                        $testPassed = ($pelamar->tesKemampuan && $pelamar->tesKemampuan->hasil === 'Lulus') || $pelamar->magang;
                                        $testFailed = $pelamar->tesKemampuan && $pelamar->tesKemampuan->hasil === 'Gagal';
                                        $testPending = $pelamar->tesKemampuan && !$testPassed && !$testFailed;
                                    @endphp
                                    <span class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-4
                                        {{ $testPassed ? 'bg-green-200 ring-green-100 text-green-800' :
                                           ($testFailed ? 'bg-red-200 ring-red-100 text-red-800' :
                                           'bg-blue-200 ring-blue-100 text-blue-800') }}">
                                        @if($testPassed)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                            </svg>
                                        @elseif($testFailed)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        @else
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Skills Test</h3>
                                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">
                                        {{ $pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes ? $pelamar->tesKemampuan->tanggal_tes->format('d M Y') : 'Scheduled' }}
                                    </time>
                                    <p class="mb-4 text-base font-normal text-gray-600">
                                        @if($testPassed && $pelamar->tesKemampuan)
                                            You've successfully passed the skills test. Your score: {{ $pelamar->tesKemampuan->nilai }}/100.
                                        @elseif($testFailed && $pelamar->tesKemampuan)
                                            Thank you for taking the skills test. Unfortunately, your score of {{ $pelamar->tesKemampuan->nilai }}/100 did not meet our requirements.
                                        @elseif($pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes && $pelamar->tesKemampuan->tanggal_tes->isFuture())
                                            Your skills test is scheduled for {{ $pelamar->tesKemampuan->tanggal_tes->format('d M Y') }}.
                                        @elseif($pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes)
                                            Your skills test was held on {{ $pelamar->tesKemampuan->tanggal_tes->format('d M Y') }}. Results are being processed.
                                        @else
                                            Your skills test is being scheduled. Please check back later.
                                        @endif
                                    </p>
                                </li>
                                @endif

                                <!-- Internship -->
                                @if($pelamar->magang)
                                <li class="ml-6">
                                    @php
                                        $isCompleted = $pelamar->magang->status_seleksi === 'Completed';
                                        $isTerminated = $pelamar->magang->status_seleksi === 'Terminated';
                                        $isActive = $pelamar->magang->status_seleksi === 'Active';
                                    @endphp
                                    <span class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-4
                                        {{ $isCompleted ? 'bg-green-200 ring-green-100 text-green-800' :
                                           ($isTerminated ? 'bg-red-200 ring-red-100 text-red-800' :
                                           'bg-blue-200 ring-blue-100 text-blue-800') }}">
                                        @if($isCompleted)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                            </svg>
                                        @elseif($isTerminated)
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        @else
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">Internship</h3>
                                    <time class="block mb-2 text-sm font-normal leading-none text-gray-500">
                                        {{ $pelamar->magang->jadwal_mulai ? $pelamar->magang->jadwal_mulai->format('d M Y') . ' - ' . ($pelamar->magang->tanggal_selesai ? $pelamar->magang->tanggal_selesai->format('d M Y') : 'Present') : 'Scheduled' }}
                                    </time>
                                    <p class="mb-4 text-base font-normal text-gray-600">
                                        @if($isCompleted)
                                            Congratulations! You've successfully completed the internship program.
                                        @elseif($isTerminated)
                                            Your internship was terminated before completion.
                                        @elseif($isActive)
                                            Your internship is currently active. Keep up the good work!
                                        @elseif($pelamar->magang->jadwal_mulai && $pelamar->magang->jadwal_mulai->isFuture())
                                            Your internship is scheduled to start on {{ $pelamar->magang->jadwal_mulai->format('d M Y') }}.
                                        @else
                                            Your internship details are being processed. Please check back later.
                                        @endif
                                    </p>

                                    @if($pelamar->magang->evaluasiMingguan && $pelamar->magang->evaluasiMingguan->count() > 0 && $pelamar->magang->totalSkorMingguan)
                                    <div class="mt-4">
                                        <h4 class="text-md font-medium text-gray-800 mb-2">Weekly Evaluations</h4>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Week</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average Score</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @php
                                                        // Group evaluations by week to show one entry per week
                                                        $groupedEvals = $pelamar->magang->evaluasiMingguan->groupBy('minggu_ke');
                                                        $weeklyScores = $pelamar->magang->totalSkorMingguan;
                                                    @endphp

                                                    @foreach($groupedEvals as $week => $evals)
                                                        @php
                                                            // Find the score for this week
                                                            $weekScore = $weeklyScores->where('minggu_ke', $week)->first();
                                                            $totalSkor = $weekScore ? $weekScore->total_skor : null;
                                                        @endphp
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                Week {{ $week }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $evals->first()->created_at->format('d M Y') }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                                    {{ $totalSkor >= 80 ? 'bg-green-100 text-green-800' :
                                                                       ($totalSkor >= 60 ? 'bg-yellow-100 text-yellow-800' :
                                                                       ($totalSkor !== null ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                                    {{ $totalSkor ?? 'Pending' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
