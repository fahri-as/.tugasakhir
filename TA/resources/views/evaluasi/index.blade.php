<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Weekly Evaluations') }}
            </h2>
            <a href="{{ route('evaluasi.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create New Evaluation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Period Filter -->
                    <div class="mb-6">
                        <form action="{{ route('evaluasi.index') }}" method="GET" class="flex items-end space-x-4">
                            <div>
                                <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Period</label>
                                <select id="periode_filter" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @php
                                        $latestPeriode = App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
                                        $latestPeriodeId = $latestPeriode ? $latestPeriode->periode_id : '';
                                        $selectedPeriodeId = request('periode_id') !== null ? request('periode_id') : $latestPeriodeId;
                                        $selectedPeriode = App\Models\Periode::find($selectedPeriodeId);
                                        $durasiMinggu = $selectedPeriode ? $selectedPeriode->durasi_minggu_magang : 0;
                                    @endphp
                                    @foreach(App\Models\Periode::orderBy('tanggal_mulai', 'desc')->get() as $periode)
                                        <option value="{{ $periode->periode_id }}" {{ $selectedPeriodeId == $periode->periode_id ? 'selected' : '' }}>
                                            {{ $periode->nama_periode }} ({{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Filter
                                </button>

                                @if(request()->has('periode_id'))
                                    <a href="{{ route('evaluasi.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Week Selection Cards -->
                    @if($selectedPeriode && $durasiMinggu > 0)
                        <div id="week-cards" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-6">
                            @for($week = 1; $week <= $durasiMinggu; $week++)
                                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 hover:shadow-md transition-shadow cursor-pointer"
                                     onclick="loadWeekEvaluations('{{ $selectedPeriodeId }}', {{ $week }})">
                                    <div class="p-6">
                                        <h3 class="text-lg font-medium text-gray-900">Week {{ $week }}</h3>
                                        <p class="mt-2 text-sm text-gray-600">
                                            @php
                                                $evaluationCount = App\Models\EvaluasiMingguanMagang::whereHas('magang', function($query) use ($selectedPeriodeId) {
                                                    $query->whereHas('pelamar', function($q) use ($selectedPeriodeId) {
                                                        $q->where('periode_id', $selectedPeriodeId);
                                                    });
                                                })->where('minggu_ke', $week)->count();
                                            @endphp
                                            {{ $evaluationCount }} {{ Str::plural('evaluation', $evaluationCount) }} recorded
                                        </p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @elseif(!$selectedPeriode)
                        <div class="text-center py-4 bg-yellow-50 rounded-lg">
                            <p class="text-yellow-700">No period selected. Please select a period to view evaluations.</p>
                        </div>
                    @elseif($durasiMinggu == 0)
                        <div class="text-center py-4 bg-yellow-50 rounded-lg">
                            <p class="text-yellow-700">The selected period doesn't have any weeks defined. Please select a different period or update the week duration.</p>
                        </div>
                    @endif

                    <!-- Evaluation Data Table (initially hidden, shown when a week is selected) -->
                    <div id="evaluation-table-container" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 id="week-title" class="text-lg font-medium text-gray-900">Week # Evaluations</h3>
                            <button onclick="showWeekCards()" class="inline-flex items-center px-3 py-1.5 bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Weeks
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table id="evaluation-table" class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern Name</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="evaluation-tbody" class="bg-white divide-y divide-gray-200">
                                    <!-- Evaluation data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>

                        <div id="no-evaluations" class="hidden text-center py-4 bg-gray-50 rounded-lg mt-4">
                            <p class="text-gray-700">No evaluations recorded for this week yet.</p>
                            <a href="{{ route('evaluasi.create') }}?periode_id={{ $selectedPeriodeId }}&week=" id="create-link" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-2">
                                Add Evaluation for Week #
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for handling week selection and data loading -->
    <script>
        let currentWeek = 0;
        let currentPeriod = '';

        function showWeekCards() {
            document.getElementById('week-cards').classList.remove('hidden');
            document.getElementById('evaluation-table-container').classList.add('hidden');
            currentWeek = 0;
        }

        function loadWeekEvaluations(periodeId, week) {
            currentWeek = week;
            currentPeriod = periodeId;

            // Update the week title and create link
            document.getElementById('week-title').textContent = `Week ${week} Evaluations`;
            const createLink = document.getElementById('create-link');
            createLink.href = `{{ route('evaluasi.create') }}?periode_id=${periodeId}&week=${week}`;
            createLink.textContent = `Add Evaluation for Week ${week}`;

            // Hide week cards and show evaluation table
            document.getElementById('week-cards').classList.add('hidden');
            document.getElementById('evaluation-table-container').classList.remove('hidden');

            // Fetch data for the selected week
            fetchWeekData(periodeId, week);
        }

        function fetchWeekData(periodeId, week) {
            // In a real application, this would be an AJAX request to fetch data
            // For demo purposes, we'll simulate the data fetch

            // Simulating an AJAX call - in a real app, you would use fetch() or axios
            // to call a route that returns the evaluation data for the selected week

            // Example fetch format:
            // fetch(`/api/evaluations?periode_id=${periodeId}&week=${week}`)
            //     .then(response => response.json())
            //     .then(data => populateTable(data))
            //     .catch(error => console.error('Error:', error));

            // For demonstration, let's populate with sample data
            // In a real application, this data would come from the server via AJAX
            setTimeout(() => {
                // Assuming we fetch data and store it in 'evaluations'
                // This is where you would make a real AJAX call to get the data from the server

                // Example route for data:
                // Route::get('/api/evaluations', [EvaluasiMingguanMagangController::class, 'getByWeek'])->name('api.evaluations');

                // For now, simulate an empty data set
                const evaluations = [];

                // Call function to populate the table with data
                populateTable(evaluations);
            }, 300);
        }

        function populateTable(evaluations) {
            const tbody = document.getElementById('evaluation-tbody');
            tbody.innerHTML = ''; // Clear existing rows

            if (evaluations.length === 0) {
                // Show no evaluations message
                document.getElementById('no-evaluations').classList.remove('hidden');
                document.getElementById('evaluation-table').classList.add('hidden');
            } else {
                // Hide no evaluations message and show table
                document.getElementById('no-evaluations').classList.add('hidden');
                document.getElementById('evaluation-table').classList.remove('hidden');

                // Populate table with evaluation data
                evaluations.forEach(eval => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${eval.magang.pelamar.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${eval.magang.pelamar.job.nama_job}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${eval.ratingScale.name} (${eval.ratingScale.singkatan})</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${eval.skor_minggu}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="/evaluasi/${eval.evaluasi_id}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                            <a href="/evaluasi/${eval.evaluasi_id}/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="/evaluasi/${eval.evaluasi_id}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this evaluation?')">Delete</button>
                            </form>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        }

        // Auto-load first week if a period is selected
        document.addEventListener('DOMContentLoaded', function() {
            const periodeId = '{{ $selectedPeriodeId }}';
            if (periodeId && {{ $durasiMinggu }} > 0) {
                // Optional: auto-load the first week
                // loadWeekEvaluations(periodeId, 1);
            }
        });
    </script>
</x-app-layout>
