<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('job.index') }}" class="bg-white  overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 ">Jobs</h3>
                        <p class="mt-2 text-sm text-gray-600 ">Manage available internship positions and their requirements.</p>
                    </div>
                </a>

                <a href="{{ route('periode.index') }}" class="bg-white  overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 ">Periods</h3>
                        <p class="mt-2 text-sm text-gray-600 ">Manage internship periods and their associated jobs.</p>
                    </div>
                </a>

                <a href="{{ route('pelamar.index') }}" class="bg-white  overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 ">Applicants</h3>
                        <p class="mt-2 text-sm text-gray-600 ">View and manage internship applications.</p>
                    </div>
                </a>

                <a href="{{ route('interview.index') }}" class="bg-white  overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 ">Interviews</h3>
                        <p class="mt-2 text-sm text-gray-600 ">Schedule and manage applicant interviews.</p>
                    </div>
                </a>

                <a href="{{ route('tes-kemampuan.index') }}" class="bg-white  overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 ">Skill Tests</h3>
                        <p class="mt-2 text-sm text-gray-600 ">Manage applicant skill assessments.</p>
                    </div>
                </a>

                <a href="{{ route('magang.index') }}" class="bg-white  overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 ">Internships</h3>
                        <p class="mt-2 text-sm text-gray-600 ">Track active internships and their progress.</p>
                    </div>
                </a>

                <a href="{{ route('evaluasi.index') }}" class="bg-white  overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 ">Evaluations</h3>
                        <p class="mt-2 text-sm text-gray-600 ">Manage weekly intern performance evaluations.</p>
                    </div>
                </a>

                <!-- Decision Support System Section -->
                <div class="sm:col-span-2 lg:col-span-3 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Decision Support System</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                            Use our decision support system to help select the best candidates for Cook and Pastry Chef positions
                            using AHP (Analytic Hierarchy Process) for weighting criteria and SMART (Simple Multi-Attribute Rating Technique) for ranking.
                        </p>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                                <h4 class="font-medium text-gray-800 dark:text-gray-200">Cook Position (JOB001)</h4>
                                <div class="mt-4 space-y-2">
                                    <a href="{{ route('ahp.index', 'JOB001') }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        AHP Criteria Weighting
                                    </a>
                                    <a href="{{ route('smart.index', 'JOB001') }}" class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                        SMART Ranking
                                    </a>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                                <h4 class="font-medium text-gray-800 dark:text-gray-200">Pastry Chef Position (JOB004)</h4>
                                <div class="mt-4 space-y-2">
                                    <a href="{{ route('ahp.index', 'JOB004') }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        AHP Criteria Weighting
                                    </a>
                                    <a href="{{ route('smart.index', 'JOB004') }}" class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                        SMART Ranking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
