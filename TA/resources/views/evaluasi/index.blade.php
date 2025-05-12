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
                        <!-- Replace this section in your index.blade.php file around line 55-67 -->
<div id="week-cards" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-6">
    @for($week = 1; $week <= $durasiMinggu; $week++)
        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 hover:shadow-md transition-shadow cursor-pointer"
             onclick="loadWeekEvaluations('{{ $selectedPeriodeId }}', {{ $week }})">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Week {{ $week }}</h3>
                <p class="mt-2 text-sm text-gray-600">
                    @php
                        // Count DISTINCT interns with evaluations for this week
                        $internCount = App\Models\EvaluasiMingguanMagang::whereHas('magang', function($query) use ($selectedPeriodeId) {
                            $query->whereHas('pelamar', function($q) use ($selectedPeriodeId) {
                                $q->where('periode_id', $selectedPeriodeId);
                            });
                        })
                        ->where('minggu_ke', $week)
                        ->select('magang_id')
                        ->groupBy('magang_id')  // Group by magang_id to ensure we count distinct interns
                        ->get()
                        ->count();
                    @endphp
                    {{ $internCount }} {{ Str::plural('intern', $internCount) }} evaluated
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
                            <table id="interns-table" class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern Name</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average Score</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="interns-tbody" class="bg-white divide-y divide-gray-200">
                                    <!-- Intern data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>

                        <div id="no-interns" class="hidden text-center py-4 bg-gray-50 rounded-lg mt-4">
                            <p class="text-gray-700">No interns evaluated for this week yet.</p>
                            <a href="{{ route('evaluasi.create') }}?periode_id={{ $selectedPeriodeId }}&week=" id="create-link" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-2">
                                Add Evaluation for Week #
                            </a>
                        </div>
                    </div>

                    <!-- Criteria Evaluations for Selected Intern (hidden by default) -->
                    <div id="criteria-container" class="hidden mt-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 id="intern-title" class="text-lg font-medium text-gray-900">Evaluations for [Intern Name]</h3>
                            <button onclick="showInternsTable()" class="inline-flex items-center px-3 py-1.5 bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Interns List
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table id="criteria-table" class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="criteria-tbody" class="bg-white divide-y divide-gray-200">
                                    <!-- Criteria evaluations will be loaded here -->
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-50">
                                        <td class="px-6 py-4 font-medium">Total Score</td>
                                        <td></td>
                                        <td id="total-score" class="px-6 py-4 font-medium">0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for handling week and intern selection -->
    <script>
        let currentWeek = 0;
        let currentPeriod = '';
        let currentMagangId = '';
        let weeklyEvaluations = [];

        function showWeekCards() {
            document.getElementById('week-cards').classList.remove('hidden');
            document.getElementById('evaluation-table-container').classList.add('hidden');
            document.getElementById('criteria-container').classList.add('hidden');
            currentWeek = 0;
            currentMagangId = '';
        }

        function showInternsTable() {
            document.getElementById('evaluation-table-container').classList.remove('hidden');
            document.getElementById('criteria-container').classList.add('hidden');
            currentMagangId = '';
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
            document.getElementById('criteria-container').classList.add('hidden');

            // Show loading indicator
            const tbody = document.getElementById('interns-tbody');
            tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center">Loading...</td></tr>';

            // Fetch data for the selected week
            fetchWeekData(periodeId, week);
        }

        function fetchWeekData(periodeId, week) {
            // Make an AJAX request to get the evaluations for this week
            fetch(`{{ route('api.evaluations') }}?periode_id=${periodeId}&week=${week}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Store the full evaluations data
                    weeklyEvaluations = data;

                    // Group evaluations by intern
                    const internMap = new Map();

                    data.forEach(eval => {
                        if (!eval.magang || !eval.magang.pelamar) return;

                        const magangId = eval.magang_id;

                        if (!internMap.has(magangId)) {
                            internMap.set(magangId, {
                                magangId: magangId,
                                nama: eval.magang.pelamar.nama,
                                job: eval.magang.pelamar.job ? eval.magang.pelamar.job.nama_job : 'N/A',
                                evaluations: [],
                                totalScore: 0,
                                count: 0
                            });
                        }

                        const intern = internMap.get(magangId);
                        intern.evaluations.push(eval);
                        intern.totalScore += parseFloat(eval.skor_minggu);
                        intern.count++;
                    });

                    // Calculate average scores
                    internMap.forEach(intern => {
                        intern.averageScore = intern.count > 0 ? (intern.totalScore / intern.count).toFixed(2) : 0;
                    });

                    // Convert to array for rendering
                    const interns = Array.from(internMap.values());
                    populateInternsTable(interns);
                })
                .catch(error => {
                    console.error('Error fetching evaluations:', error);
                    document.getElementById('interns-tbody').innerHTML =
                        `<tr><td colspan="4" class="px-6 py-4 text-center text-red-600">Error loading evaluations: ${error.message}</td></tr>`;
                });
        }

        function populateInternsTable(interns) {
            const tbody = document.getElementById('interns-tbody');
            tbody.innerHTML = ''; // Clear existing rows

            if (!interns || interns.length === 0) {
                // Show no interns message
                document.getElementById('no-interns').classList.remove('hidden');
                document.getElementById('interns-table').classList.add('hidden');
            } else {
                // Hide no interns message and show table
                document.getElementById('no-interns').classList.add('hidden');
                document.getElementById('interns-table').classList.remove('hidden');

                // Populate table with intern data
                interns.forEach(intern => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-gray-50 cursor-pointer';
                    row.onclick = () => showInternEvaluations(intern.magangId, intern.nama);

                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${intern.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${intern.job}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${intern.averageScore}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="showInternEvaluations('${intern.magangId}', '${intern.nama}'); event.stopPropagation();" class="text-blue-600 hover:text-blue-900 mr-3">View Details</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        }

        function showInternEvaluations(magangId, internName) {
            currentMagangId = magangId;

            // Update the intern title
            document.getElementById('intern-title').textContent = `Evaluations for ${internName} - Week ${currentWeek}`;

            // Hide interns table and show criteria table
            document.getElementById('evaluation-table-container').classList.add('hidden');
            document.getElementById('criteria-container').classList.remove('hidden');

            // Filter evaluations for this intern
            const internEvals = weeklyEvaluations.filter(eval => eval.magang_id === magangId);

            // Calculate total score (sum of all criteria scores)
            const totalScore = internEvals.reduce((sum, eval) => sum + parseFloat(eval.skor_minggu), 0).toFixed(2);
            document.getElementById('total-score').textContent = totalScore;

            // Populate criteria table
            const tbody = document.getElementById('criteria-tbody');
            tbody.innerHTML = ''; // Clear existing rows

            internEvals.forEach(eval => {
                const criteriaName = eval.criteria ?
                    `${eval.criteria.name} (${eval.criteria.code})` :
                    'General Evaluation';

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 text-sm text-gray-900">${criteriaName}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${eval.rating_scale ? eval.rating_scale.name : 'N/A'} (${eval.rating_scale ? eval.rating_scale.singkatan : 'N/A'})</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${eval.skor_minggu}</td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <a href="/evaluasi/${eval.evaluasi_id}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="/evaluasi/${eval.evaluasi_id}/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                    </td>
                `;
                tbody.appendChild(row);
            });
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
