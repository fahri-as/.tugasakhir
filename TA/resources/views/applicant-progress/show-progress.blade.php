<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Your Application Progress - JIWARAGA</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|poppins:400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .fade-in {
                animation: fadeIn 0.8s ease-in;
            }

            .slide-in-bottom {
                animation: slideInBottom 0.5s ease-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes slideInBottom {
                from { transform: translateY(30px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            .tracking-hero {
                background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
                color: white;
                min-height: 160px;
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            body {
                font-family: 'Poppins', sans-serif;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Instrument Sans', sans-serif;
            }

            .timeline-card {
                position: relative;
                transition: all 0.3s ease;
            }

            .timeline-card:hover {
                transform: translateX(5px);
            }

            .timeline-connector:after {
                content: '';
                position: absolute;
                width: 2px;
                background-color: #e5e7eb;
                top: 0;
                bottom: 0;
                left: 24px;
                margin-left: -1px;
                z-index: 0;
            }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-800 min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="text-xl font-bold text-indigo-600">JIWARAGA</a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('applicant.progress.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Periods
                        </a>
                    </div>
                </div>
            </div>
            </nav>

        <!-- Hero Section -->
        <section class="tracking-hero py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-2 fade-in">Application Status</h1>
                <div class="bg-white/10 backdrop-blur-sm inline-flex items-center px-4 py-1 rounded-full text-sm font-medium fade-in mb-4">
                    <i class="fas fa-user-circle mr-2"></i>
                    <span>{{ $pelamar->nama }}</span>
                </div>
                <p class="text-sm max-w-3xl mx-auto opacity-90 fade-in">
                    <span class="bg-white/20 rounded-md px-3 py-1">Application ID: {{ $pelamar->pelamar_id }}</span>
                </p>
                                        </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden slide-in-bottom">
                <div class="p-6">
                    <!-- Application Details Cards -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Status Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-indigo-100 rounded-lg p-6 card-hover">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                                    <i class="fas fa-clipboard-check text-indigo-600 text-xl"></i>
                                        </div>
                                <div class="ml-4">
                                    <h3 class="font-medium text-gray-900">Application Status</h3>
                                    <span class="text-sm font-medium px-3 py-1 rounded-full
                                        {{ $pelamar->status_seleksi === 'Pending' ? 'bg-yellow-100 text-yellow-800' :
                                          ($pelamar->status_seleksi === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800') }}">
                                                {{ $pelamar->status_seleksi }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                        <!-- Position Card -->
                        <div class="bg-gradient-to-br from-green-50 to-teal-50 border border-green-100 rounded-lg p-6 card-hover">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                                    <i class="fas fa-briefcase text-green-600 text-xl"></i>
                                        </div>
                                <div class="ml-4">
                                    <h3 class="font-medium text-gray-900">Position Applied</h3>
                                    <p class="text-sm text-gray-800 font-medium">{{ $pelamar->job->nama_job }}</p>
                                    <p class="text-xs text-gray-500">{{ $pelamar->periode->nama_periode }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Card -->
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-100 rounded-lg p-6 card-hover">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-purple-100 rounded-full p-3">
                                    <i class="fas fa-address-card text-purple-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-medium text-gray-900">Contact Information</h3>
                                    <p class="text-sm text-gray-800"><i class="fas fa-envelope text-purple-400 mr-2"></i>{{ $pelamar->email }}</p>
                                    <p class="text-sm text-gray-800"><i class="fab fa-whatsapp text-purple-400 mr-2"></i>{{ $pelamar->nomor_wa }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Timeline -->
                    <div class="mt-12">
                        <h3 class="text-2xl font-semibold mb-8 text-gray-800 flex items-center">
                            <span class="bg-indigo-100 text-indigo-600 w-10 h-10 rounded-full inline-flex items-center justify-center mr-3">
                                <i class="fas fa-tasks"></i>
                            </span>
                            Recruitment Progress Timeline
                        </h3>

                        <div class="relative timeline-connector">
                                <!-- Document Screening -->
                                    @php
                                        // Document screening is passed if the applicant has an interview, test or internship record
                                        $documentPassed = $pelamar->interview || $pelamar->tesKemampuan || $pelamar->magang;
                                        $documentRejected = $pelamar->status_seleksi === 'Rejected';
                                        $documentPending = !$documentPassed && !$documentRejected;
                                    @endphp

                            <div class="mb-10 ml-12 timeline-card">
                                <span class="absolute flex items-center justify-center w-12 h-12 rounded-full -left-6 ring-8
                                    {{ $documentPassed ? 'bg-green-500 ring-green-100 text-white' :
                                       ($documentRejected ? 'bg-red-500 ring-red-100 text-white' :
                                       'bg-yellow-500 ring-yellow-100 text-white') }}">
                                        @if($documentPassed)
                                        <i class="fas fa-check"></i>
                                        @elseif($documentRejected)
                                        <i class="fas fa-times"></i>
                                        @else
                                        <i class="fas fa-hourglass-half fa-spin"></i>
                                        @endif
                                    </span>

                                <div class="p-6 bg-white rounded-lg shadow-sm border-l-4
                                    {{ $documentPassed ? 'border-l-green-500' :
                                       ($documentRejected ? 'border-l-red-500' : 'border-l-yellow-500') }}">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                                            <i class="fas fa-file-alt mr-2
                                                {{ $documentPassed ? 'text-green-500' :
                                                   ($documentRejected ? 'text-red-500' : 'text-yellow-500') }}"></i>
                                            Document Screening
                                        </h4>
                                        <time class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        {{ $pelamar->created_at->format('d M Y') }}
                                    </time>
                                    </div>

                                    <p class="mb-2 text-sm text-gray-600">
                                        @if($documentPassed)
                                            Your application documents have passed our initial screening.
                                        @elseif($documentRejected)
                                            Your application did not match our requirements at this time.
                                        @else
                                            Your application documents are currently being reviewed.
                                        @endif
                                    </p>

                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-xs px-3 py-1 rounded-full
                                            {{ $documentPassed ? 'bg-green-100 text-green-800' :
                                               ($documentRejected ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $documentPassed ? 'Passed' : ($documentRejected ? 'Rejected' : 'Pending') }}
                                        </span>

                                        @if(!$documentRejected)
                                        <span class="text-xs text-gray-500">
                                            {{ $documentPassed ? 'Moved to next stage' : 'Awaiting result' }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                                <!-- Interview -->
                                @if($pelamar->interview || $pelamar->tesKemampuan || $pelamar->magang)
                                    @php
                                        // Interview is passed if the applicant has a test or internship record
                                        $interviewPassed = ($pelamar->interview && $pelamar->interview->hasil === 'Lulus') ||
                                                           $pelamar->tesKemampuan ||
                                                           $pelamar->magang;
                                        $interviewFailed = $pelamar->interview && $pelamar->interview->hasil === 'Gagal';
                                        $interviewPending = $pelamar->interview && !$interviewPassed && !$interviewFailed;
                                    @endphp

                            <div class="mb-10 ml-12 timeline-card">
                                <span class="absolute flex items-center justify-center w-12 h-12 rounded-full -left-6 ring-8
                                    {{ $interviewPassed ? 'bg-green-500 ring-green-100 text-white' :
                                       ($interviewFailed ? 'bg-red-500 ring-red-100 text-white' :
                                       'bg-blue-500 ring-blue-100 text-white') }}">
                                        @if($interviewPassed)
                                        <i class="fas fa-check"></i>
                                        @elseif($interviewFailed)
                                        <i class="fas fa-times"></i>
                                        @else
                                        <i class="fas fa-user-tie"></i>
                                        @endif
                                    </span>

                                <div class="p-6 bg-white rounded-lg shadow-sm border-l-4
                                    {{ $interviewPassed ? 'border-l-green-500' :
                                       ($interviewFailed ? 'border-l-red-500' : 'border-l-blue-500') }}">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                                            <i class="fas fa-comments mr-2
                                                {{ $interviewPassed ? 'text-green-500' :
                                                   ($interviewFailed ? 'text-red-500' : 'text-blue-500') }}"></i>
                                            Interview
                                        </h4>
                                        <time class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        {{ $pelamar->interview && $pelamar->interview->tanggal_wawancara ? $pelamar->interview->tanggal_wawancara->format('d M Y') : 'Scheduled' }}
                                    </time>
                                    </div>

                                    <p class="mb-2 text-sm text-gray-600">
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

                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-xs px-3 py-1 rounded-full
                                            {{ $interviewPassed ? 'bg-green-100 text-green-800' :
                                               ($interviewFailed ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ $interviewPassed ? 'Passed' : ($interviewFailed ? 'Failed' : 'In Progress') }}
                                        </span>

                                        @if(!$interviewFailed && $pelamar->interview && $pelamar->interview->tanggal_wawancara && $pelamar->interview->tanggal_wawancara->isFuture())
                                        <span class="text-xs bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full">
                                            <i class="far fa-clock mr-1"></i> Scheduled
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                @endif

                                <!-- Skills Test -->
                                @if($pelamar->tesKemampuan || $pelamar->magang)
                                    @php
                                        // Test is passed if the applicant has an internship record or has passed the test
                                        $testPassed = ($pelamar->tesKemampuan && $pelamar->tesKemampuan->hasil === 'Lulus') || $pelamar->magang;
                                        $testFailed = $pelamar->tesKemampuan && $pelamar->tesKemampuan->hasil === 'Gagal';
                                        $testPending = $pelamar->tesKemampuan && !$testPassed && !$testFailed;
                                    @endphp

                            <div class="mb-10 ml-12 timeline-card">
                                <span class="absolute flex items-center justify-center w-12 h-12 rounded-full -left-6 ring-8
                                    {{ $testPassed ? 'bg-green-500 ring-green-100 text-white' :
                                       ($testFailed ? 'bg-red-500 ring-red-100 text-white' :
                                       'bg-blue-500 ring-blue-100 text-white') }}">
                                        @if($testPassed)
                                        <i class="fas fa-check"></i>
                                        @elseif($testFailed)
                                        <i class="fas fa-times"></i>
                                        @else
                                        <i class="fas fa-clipboard-list"></i>
                                        @endif
                                    </span>

                                <div class="p-6 bg-white rounded-lg shadow-sm border-l-4
                                    {{ $testPassed ? 'border-l-green-500' :
                                       ($testFailed ? 'border-l-red-500' : 'border-l-blue-500') }}">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                                            <i class="fas fa-tasks mr-2
                                                {{ $testPassed ? 'text-green-500' :
                                                   ($testFailed ? 'text-red-500' : 'text-blue-500') }}"></i>
                                            Skills Test
                                        </h4>
                                        <time class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        {{ $pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes ? $pelamar->tesKemampuan->tanggal_tes->format('d M Y') : 'Scheduled' }}
                                    </time>
                                    </div>

                                    <p class="mb-2 text-sm text-gray-600">
                                        @if($testPassed && $pelamar->tesKemampuan)
                                            You've successfully passed the skills test.
                                        @elseif($testFailed && $pelamar->tesKemampuan)
                                            Thank you for taking the skills test. Unfortunately, your score did not meet our requirements.
                                        @elseif($pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes && $pelamar->tesKemampuan->tanggal_tes->isFuture())
                                            Your skills test is scheduled for {{ $pelamar->tesKemampuan->tanggal_tes->format('d M Y') }}.
                                        @elseif($pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes)
                                            Your skills test was held on {{ $pelamar->tesKemampuan->tanggal_tes->format('d M Y') }}. Results are being processed.
                                        @else
                                            Your skills test is being scheduled. Please check back later.
                                        @endif
                                    </p>

                                    @if($pelamar->tesKemampuan && $pelamar->tesKemampuan->nilai)
                                    <div class="mt-4 mb-4">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-700 mr-2">Score:</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                                                <div class="h-2.5 rounded-full
                                                    {{ $pelamar->tesKemampuan->nilai >= 80 ? 'bg-green-500' :
                                                      ($pelamar->tesKemampuan->nilai >= 60 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                     style="width: {{ $pelamar->tesKemampuan->nilai }}%"></div>
                                            </div>
                                            <span class="ml-2 text-sm font-medium">{{ $pelamar->tesKemampuan->nilai }}/100</span>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-xs px-3 py-1 rounded-full
                                            {{ $testPassed ? 'bg-green-100 text-green-800' :
                                               ($testFailed ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ $testPassed ? 'Passed' : ($testFailed ? 'Failed' : 'In Progress') }}
                                        </span>

                                        @if(!$testFailed && $pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes && $pelamar->tesKemampuan->tanggal_tes->isFuture())
                                        <span class="text-xs bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full">
                                            <i class="far fa-clock mr-1"></i> Scheduled
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                @endif

                                <!-- Internship -->
                                @if($pelamar->magang)
                                    @php
                                        $isCompleted = $pelamar->magang->status_seleksi === 'Completed';
                                        $isTerminated = $pelamar->magang->status_seleksi === 'Terminated';
                                        $isActive = $pelamar->magang->status_seleksi === 'Active';
                                    @endphp

                            <div class="ml-12 timeline-card">
                                <span class="absolute flex items-center justify-center w-12 h-12 rounded-full -left-6 ring-8
                                    {{ $isCompleted ? 'bg-green-500 ring-green-100 text-white' :
                                       ($isTerminated ? 'bg-red-500 ring-red-100 text-white' :
                                       'bg-blue-500 ring-blue-100 text-white') }}">
                                        @if($isCompleted)
                                        <i class="fas fa-check"></i>
                                        @elseif($isTerminated)
                                        <i class="fas fa-times"></i>
                                        @else
                                        <i class="fas fa-building"></i>
                                        @endif
                                    </span>

                                <div class="p-6 bg-white rounded-lg shadow-sm border-l-4
                                    {{ $isCompleted ? 'border-l-green-500' :
                                       ($isTerminated ? 'border-l-red-500' : 'border-l-blue-500') }}">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                                            <i class="fas fa-graduation-cap mr-2
                                                {{ $isCompleted ? 'text-green-500' :
                                                   ($isTerminated ? 'text-red-500' : 'text-blue-500') }}"></i>
                                            Internship
                                        </h4>
                                        <time class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        {{ $pelamar->magang->jadwal_mulai ? $pelamar->magang->jadwal_mulai->format('d M Y') . ' - ' . ($pelamar->magang->tanggal_selesai ? $pelamar->magang->tanggal_selesai->format('d M Y') : 'Present') : 'Scheduled' }}
                                    </time>
                                    </div>

                                    <p class="mb-2 text-sm text-gray-600">
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

                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-xs px-3 py-1 rounded-full
                                            {{ $isCompleted ? 'bg-green-100 text-green-800' :
                                               ($isTerminated ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ $pelamar->magang->status_seleksi }}
                                        </span>

                                        @if($isActive)
                                        <span class="text-xs bg-blue-50 text-blue-700 px-3 py-1 rounded-full animate-pulse">
                                            <i class="fas fa-running mr-1"></i> In Progress
                                        </span>
                                        @endif
                                    </div>

                                    @if($pelamar->magang->evaluasiMingguan && $pelamar->magang->evaluasiMingguan->count() > 0 && $pelamar->magang->totalSkorMingguan)
                                    <div class="mt-6">
                                        <h5 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                                            <i class="fas fa-chart-line text-indigo-500 mr-2"></i>
                                            Weekly Performance
                                        </h5>
                                        <div class="overflow-x-auto bg-gray-50 rounded-lg border border-gray-200">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Week</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
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
                                                        <tr class="hover:bg-gray-50">
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                Week {{ $week }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $evals->first()->created_at->format('d M Y') }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-medium rounded-full
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
                                </div>
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('applicant.progress.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    <i class="fas fa-arrow-left mr-2"></i> Back to All Periods
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-xl font-bold">JIWARAGA Job Application Portal</h2>
                        <p class="text-gray-400 mt-1">Find your job with us</p>
                    </div>
                    <div>
                        <a href="/" class="text-gray-300 hover:text-white transition">
                            Back to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add animations
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('.timeline-card').forEach((card, index) => {
                    card.style.animationDelay = `${index * 0.2}s`;
                    observer.observe(card);
                });
            });
        </script>
    </body>
</html>
