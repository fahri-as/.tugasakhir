<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Applicant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('pelamar.update', $pelamar) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Applicant ID (readonly) -->
                            <div>
                                <label for="pelamar_id" class="block text-sm font-medium text-gray-700">Applicant ID</label>
                                <input type="text" name="pelamar_id" id="pelamar_id" value="{{ $pelamar->pelamar_id }}" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" readonly>
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $pelamar->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Period Selection -->
                            <div>
                                <label for="periode_id" class="block text-sm font-medium text-gray-700">Period</label>
                                <select name="periode_id" id="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select Period</option>
                                    @foreach($periodes as $periode)
                                        <option value="{{ $periode->periode_id }}"
                                            {{ old('periode_id', $pelamar->periode_id) == $periode->periode_id ? 'selected' : '' }}
                                            data-jobs="{{ json_encode($periode->jobs) }}">
                                            {{ $periode->nama_periode }} ({{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('periode_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Job Selection (will be dynamically populated) -->
                            <div>
                                <label for="job_id" class="block text-sm font-medium text-gray-700">Position Applied</label>
                                <select name="job_id" id="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select Position</option>
                                    @if(isset($currentPeriodeJobs))
                                        @foreach($currentPeriodeJobs as $job)
                                            <option value="{{ $job->job_id }}" {{ old('job_id', $pelamar->job_id) == $job->job_id ? 'selected' : '' }}>
                                                {{ $job->nama_job }} - {{ $job->deskripsi ?? '' }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('job_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $pelamar->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- WhatsApp Number -->
                            <div>
                                <label for="nomor_wa" class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                                <input type="text" name="nomor_wa" id="nomor_wa" value="{{ old('nomor_wa', $pelamar->nomor_wa) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('nomor_wa')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div>
                                <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir', $pelamar->tgl_lahir ? $pelamar->tgl_lahir->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('tgl_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Education -->
                            <div>
                                <label for="pendidikan" class="block text-sm font-medium text-gray-700">Education</label>
                                <select name="pendidikan" id="pendidikan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select Education Level</option>
                                    <option value="SMA" {{ old('pendidikan', $pelamar->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                    <option value="D3" {{ old('pendidikan', $pelamar->pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('pendidikan', $pelamar->pendidikan) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan', $pelamar->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan', $pelamar->pendidikan) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                                @error('pendidikan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('alamat', $pelamar->alamat) }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Experience Duration -->
                            <div>
                                <label for="lama_pengalaman" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                                <input type="number" name="lama_pengalaman" id="lama_pengalaman" value="{{ old('lama_pengalaman', $pelamar->lama_pengalaman) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('lama_pengalaman')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Previous Workplace -->
                            <div>
                                <label for="tempat_pengalaman" class="block text-sm font-medium text-gray-700">Previous Workplace</label>
                                <input type="text" name="tempat_pengalaman" id="tempat_pengalaman" value="{{ old('tempat_pengalaman', $pelamar->tempat_pengalaman) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('tempat_pengalaman')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Workplace Description -->
                        <div>
                            <label for="deskripsi_tempat" class="block text-sm font-medium text-gray-700">Workplace Description</label>
                            <textarea name="deskripsi_tempat" id="deskripsi_tempat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('deskripsi_tempat', $pelamar->deskripsi_tempat) }}</textarea>
                            @error('deskripsi_tempat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current CV File -->
                        @if($pelamar->berkas_cv)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Current CV</label>
                            <div class="mt-1 flex items-center">
                                <a href="{{ $pelamar->berkas_cv }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    View Current CV
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- CV File Upload -->
                        <div>
                            <label for="berkas_cv" class="block text-sm font-medium text-gray-700">
                                {{ $pelamar->berkas_cv ? 'Replace CV File (Max 500KB)' : 'Upload CV (Max 500KB)' }}
                            </label>
                            <input type="file" name="berkas_cv" id="berkas_cv" accept=".pdf,.doc,.docx" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" {{ $pelamar->berkas_cv ? '' : 'required' }}>
                            <p class="mt-1 text-xs text-gray-500">Accepted formats: PDF, DOC, DOCX (Max size: 500KB)</p>
                            @error('berkas_cv')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('pelamar.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Update Applicant
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
            const oldJobId = '{{ old("job_id", $pelamar->job_id) }}';

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
                        if (job.job_id === oldJobId) {
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
