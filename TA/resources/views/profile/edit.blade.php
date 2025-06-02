<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-user-circle text-indigo-600 mr-2"></i> {{ __('Profile') }}
            </h2>
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('status') === 'profile-updated')
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-green-50" role="alert">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                    <span>{{ __('Profile information updated successfully.') }}</span>
                </div>
            @endif

            @if(session('status') === 'password-updated')
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-green-50" role="alert">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                    <span>{{ __('Password updated successfully.') }}</span>
                </div>
            @endif

            <!-- Profile Information Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                            <i class="fas fa-user text-indigo-600"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-gray-100">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Password Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                            <i class="fas fa-lock text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Update Password</h3>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-gray-100">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                            <i class="fas fa-trash-alt text-red-600"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Delete Account</h3>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-gray-100">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Include FontAwesome -->
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    </style>
</x-app-layout>
