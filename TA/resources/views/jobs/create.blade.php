<x-crud-layout title="Create Job" icon="fa-briefcase-medical">
    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 p-6 rounded-lg border border-indigo-100 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
            <i class="fas fa-briefcase-medical text-indigo-600 mr-2"></i> Create New Job Position
        </h3>

        <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <div class="transform transition duration-200 hover:-translate-y-1">
                    <label for="nama_job" class="block text-sm font-medium text-gray-700 mb-1">Job Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-briefcase text-gray-400"></i>
                        </div>
                        <input type="text" name="nama_job" id="nama_job" required
                            class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Enter job position title">
                    </div>
                    @error('nama_job')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-4 rounded-lg border border-purple-100 shadow-sm">
                <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-align-left text-indigo-500 mr-2"></i> Job Description
                </h4>

                <div class="transform transition duration-200 hover:-translate-y-1">
                    <div class="relative">
                        <textarea name="deskripsi" id="deskripsi" rows="5"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Enter detailed job description, responsibilities, requirements, etc."></textarea>
                    </div>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">A good job description improves the quality of applicants. Include key responsibilities, qualifications, and any special requirements.</p>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-save mr-2"></i> Create Job
                </button>
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</x-crud-layout>
