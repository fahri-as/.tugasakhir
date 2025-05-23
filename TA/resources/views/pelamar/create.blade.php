<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-user-plus text-indigo-600 mr-2"></i> {{ __('Create New Applicant') }}
            </h2>
            <a href="{{ route('pelamar.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('pelamar.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-user text-indigo-600 mr-2"></i> Personal Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="nama" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-circle text-gray-400"></i>
                                        </div>
                                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    </div>
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- WhatsApp Number -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="nomor_wa" class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fab fa-whatsapp text-gray-400"></i>
                                        </div>
                                        <input type="text" name="nomor_wa" id="nomor_wa" value="{{ old('nomor_wa') }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    </div>
                                    @error('nomor_wa')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-alt text-gray-400"></i>
                                        </div>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    </div>
                                    @error('tgl_lahir')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Education -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="pendidikan" class="block text-sm font-medium text-gray-700">Education</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-graduation-cap text-gray-400"></i>
                                        </div>
                                        <select name="pendidikan" id="pendidikan" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                            <option value="">Select Education Level</option>
                                            <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                            <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                            <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                        </select>
                                    </div>
                                    @error('pendidikan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2 transform transition duration-200 hover:-translate-y-1">
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                                    <div class="relative mt-1">
                                        <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        </div>
                                        <textarea name="alamat" id="alamat" rows="3" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('alamat') }}</textarea>
                                    </div>
                                    @error('alamat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Application Details Section -->
                        <div class="bg-gradient-to-r from-gray-50 to-indigo-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-briefcase text-indigo-600 mr-2"></i> Application Details
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Period Selection -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="periode_id" class="block text-sm font-medium text-gray-700">Period</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar text-gray-400"></i>
                                        </div>
                                        <select name="periode_id" id="periode_id" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                            <option value="">Select Period</option>
                                            @foreach($periodes as $periode)
                                                <option value="{{ $periode->periode_id }}" {{ old('periode_id') == $periode->periode_id ? 'selected' : '' }}
                                                    data-jobs="{{ json_encode($periode->jobs) }}">
                                                    {{ $periode->nama_periode }} ({{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('periode_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Job Selection (will be dynamically populated) -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="job_id" class="block text-sm font-medium text-gray-700">Position Applied</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-tie text-gray-400"></i>
                                        </div>
                                        <select name="job_id" id="job_id" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required disabled>
                                            <option value="">Select Period First</option>
                                        </select>
                                    </div>
                                    @error('job_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CV File Upload (replaces CV Link) -->
                                <div class="md:col-span-2 transform transition duration-200 hover:-translate-y-1">
                                    <label for="berkas_cv" class="block text-sm font-medium text-gray-700">Upload CV (Max 500KB)</label>
                                    <div class="mt-1 flex items-center">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">
                                            <i class="fas fa-file-pdf text-red-400"></i>
                                        </span>
                                        <input type="file" name="berkas_cv" id="berkas_cv" accept=".pdf,.doc,.docx" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-r-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-r-md" required>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Accepted formats: PDF, DOC, DOCX (Max size: 500KB)</p>
                                    @error('berkas_cv')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Experience Section -->
                        <div class="bg-gradient-to-r from-gray-50 to-purple-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-history text-indigo-600 mr-2"></i> Work Experience
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Experience Duration -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="lama_pengalaman" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-clock text-gray-400"></i>
                                        </div>
                                        <input type="number" name="lama_pengalaman" id="lama_pengalaman" value="{{ old('lama_pengalaman', 0) }}" min="0" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    </div>
                                    @error('lama_pengalaman')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Previous Workplace -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="tempat_pengalaman" class="block text-sm font-medium text-gray-700">Previous Workplace</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-building text-gray-400"></i>
                                        </div>
                                        <input type="text" name="tempat_pengalaman" id="tempat_pengalaman" value="{{ old('tempat_pengalaman') }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    </div>
                                    @error('tempat_pengalaman')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Workplace Description -->
                                <div class="md:col-span-2 transform transition duration-200 hover:-translate-y-1">
                                    <label for="deskripsi_tempat" class="block text-sm font-medium text-gray-700">Workplace Description</label>
                                    <div class="relative mt-1">
                                        <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                            <i class="fas fa-tasks text-gray-400"></i>
                                        </div>
                                        <textarea name="deskripsi_tempat" id="deskripsi_tempat" rows="3" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('deskripsi_tempat') }}</textarea>
                                    </div>
                                    @error('deskripsi_tempat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('pelamar.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-3 transform hover:scale-105">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-save mr-2"></i> Create Applicant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const periodeSelect = document.getElementById('periode_id');
            const jobSelect = document.getElementById('job_id');

            // Initialize jobs if periode is already selected (e.g. when validation fails and page is reloaded)
            if (periodeSelect.value) {
                updateJobOptions();
            }

            periodeSelect.addEventListener('change', updateJobOptions);

            function updateJobOptions() {
                // Clear job dropdown
                jobSelect.innerHTML = '<option value="">Select Position</option>';

                if (periodeSelect.value === '') {
                    jobSelect.disabled = true;
                    return;
                }

                // Get selected option
                const selectedOption = periodeSelect.options[periodeSelect.selectedIndex];
                // Get jobs data from data attribute
                const jobs = JSON.parse(selectedOption.getAttribute('data-jobs') || '[]');

                if (jobs && jobs.length > 0) {
                    // Populate job dropdown
                    jobs.forEach(job => {
                        const option = document.createElement('option');
                        option.value = job.job_id;
                        option.textContent = `${job.nama_job} - ${job.deskripsi || ''}`;

                        // Check if job was previously selected
                        if (job.job_id === '{{ old("job_id") }}') {
                            option.selected = true;
                        }

                        jobSelect.appendChild(option);
                    });

                    // Enable job dropdown
                    jobSelect.disabled = false;
                } else {
                    // No jobs available for this period
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'No positions available for this period';
                    jobSelect.appendChild(option);
                    jobSelect.disabled = true;
                }
            }
        });
    </script>
</x-app-layout>
