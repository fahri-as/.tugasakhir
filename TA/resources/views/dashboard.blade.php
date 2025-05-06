<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('job.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Jobs</h3>
                        <p class="mt-2 text-sm text-gray-600">Manage available internship positions and their requirements.</p>
                    </div>
                </a>

                <a href="{{ route('periode.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Periods</h3>
                        <p class="mt-2 text-sm text-gray-600">Manage internship periods and their associated jobs.</p>
                    </div>
                </a>

                <a href="{{ route('pelamar.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Applicants</h3>
                        <p class="mt-2 text-sm text-gray-600">View and manage internship applications.</p>
                    </div>
                </a>

                <a href="{{ route('interview.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Interviews</h3>
                        <p class="mt-2 text-sm text-gray-600">Schedule and manage applicant interviews.</p>
                    </div>
                </a>

                <a href="{{ route('tes-kemampuan.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Skill Tests</h3>
                        <p class="mt-2 text-sm text-gray-600">Manage applicant skill assessments.</p>
                    </div>
                </a>

                <a href="{{ route('magang.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Internships</h3>
                        <p class="mt-2 text-sm text-gray-600">Track active internships and their progress.</p>
                    </div>
                </a>

                <a href="{{ route('evaluasi.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Evaluations</h3>
                        <p class="mt-2 text-sm text-gray-600">Manage weekly intern performance evaluations.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
