<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-md transform transition-all duration-300 hover:scale-110">
                            J
                        </div>
                        <span class="ml-2 font-bold text-gray-800 text-lg">JIWARAGA</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="group transition-all duration-300 flex items-center px-3">
                        <i class="fas fa-tachometer-alt mr-1.5 text-gray-400 group-hover:text-indigo-600 transition-all duration-300"></i>
                        <span class="transition-all duration-300">Dashboard</span>
                    </x-nav-link>
                    <x-nav-link :href="route('job.index')" :active="request()->routeIs('job.*')" class="group transition-all duration-300 flex items-center px-3">
                        <i class="fas fa-briefcase mr-1.5 text-gray-400 group-hover:text-indigo-600 transition-all duration-300"></i>
                        <span class="transition-all duration-300">Jobs</span>
                    </x-nav-link>
                    <x-nav-link :href="route('periode.index')" :active="request()->routeIs('periode.*')" class="group transition-all duration-300 flex items-center px-3">
                        <i class="fas fa-calendar-alt mr-1.5 text-gray-400 group-hover:text-indigo-600 transition-all duration-300"></i>
                        <span class="transition-all duration-300">Periods</span>
                    </x-nav-link>
                    <x-nav-link :href="route('criteria.index')" :active="request()->routeIs('criteria.*')" class="group transition-all duration-300 flex items-center px-3">
                        <i class="fas fa-briefcase mr-1.5 text-gray-400 group-hover:text-indigo-600 transition-all duration-300"></i>
                        <span class="transition-all duration-300">Criteria</span>
                    </x-nav-link>
                    <x-nav-link :href="route('pelamar.index')" :active="request()->routeIs('pelamar.*')" class="group transition-all duration-300 flex items-center px-3">
                        <i class="fas fa-user-friends mr-1.5 text-gray-400 group-hover:text-indigo-600 transition-all duration-300"></i>
                        <span class="transition-all duration-300">Applicants</span>
                    </x-nav-link>
                    <x-dropdown align="right" width="48" contentClasses="py-1 bg-white rounded-md border border-gray-100 shadow-lg">
                        <x-slot name="trigger">
                            <button class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 transition duration-300 ease-in-out hover:text-indigo-600 group">
                                <i class="fas fa-caret-down mr-1.5 text-gray-400 group-hover:text-indigo-600 transition-all duration-300"></i>
                                <span>More</span>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('interview.index')" class="flex items-center px-4 py-2 text-sm transition-all duration-300 hover:bg-indigo-50">
                                <i class="fas fa-comments mr-2 text-gray-400"></i>
                                Interviews
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('tes-kemampuan.index')" class="flex items-center px-4 py-2 text-sm transition-all duration-300 hover:bg-indigo-50">
                                <i class="fas fa-tasks mr-2 text-gray-400"></i>
                                Skill Tests
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('magang.index')" class="flex items-center px-4 py-2 text-sm transition-all duration-300 hover:bg-indigo-50">
                                <i class="fas fa-user-graduate mr-2 text-gray-400"></i>
                                Internships
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('evaluasi.index')" class="flex items-center px-4 py-2 text-sm transition-all duration-300 hover:bg-indigo-50">
                                <i class="fas fa-chart-line mr-2 text-gray-400"></i>
                                Evaluations
                            </x-dropdown-link>
                        
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48" contentClasses="py-1 bg-white rounded-md border border-gray-100 shadow-lg">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium transition duration-300 ease-in-out bg-white border border-transparent rounded-full hover:border-gray-200 focus:outline-none px-3 py-1.5">
                            <div class="h-7 w-7 mr-2 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="text-gray-600">{{ Auth::user()->username }}</div>
                            <div class="ml-1 text-gray-400 transition duration-300">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Info -->
                        <div class="px-4 py-2 border-b border-gray-100">
                            <div class="font-medium text-indigo-600">{{ Auth::user()->username }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                        </div>

                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('dashboard')" class="flex items-center px-4 py-2 text-sm transition-all duration-300 hover:bg-indigo-50">
                            <i class="fas fa-user-cog mr-2 text-gray-400"></i>
                            Profile
                        </x-dropdown-link>

                        <!-- Settings Link -->
                        <x-dropdown-link :href="route('dashboard')" class="flex items-center px-4 py-2 text-sm transition-all duration-300 hover:bg-indigo-50">
                            <i class="fas fa-cog mr-2 text-gray-400"></i>
                            Settings
                        </x-dropdown-link>

                        <!-- Divider -->
                        <div class="border-t border-gray-100 my-1"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="flex items-center px-4 py-2 text-sm transition-all duration-300 hover:bg-red-50 hover:text-red-600"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2 text-gray-400"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center">
                <i class="fas fa-tachometer-alt mr-2 w-5 text-indigo-600"></i>
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('job.index')" :active="request()->routeIs('job.*')" class="flex items-center">
                <i class="fas fa-briefcase mr-2 w-5 text-indigo-600"></i>
                Jobs
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('periode.index')" :active="request()->routeIs('periode.*')" class="flex items-center">
                <i class="fas fa-calendar-alt mr-2 w-5 text-indigo-600"></i>
                Periods
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pelamar.index')" :active="request()->routeIs('pelamar.*')" class="flex items-center">
                <i class="fas fa-user-friends mr-2 w-5 text-indigo-600"></i>
                Applicants
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('interview.index')" :active="request()->routeIs('interview.*')" class="flex items-center">
                <i class="fas fa-comments mr-2 w-5 text-indigo-600"></i>
                Interviews
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tes-kemampuan.index')" :active="request()->routeIs('tes-kemampuan.*')" class="flex items-center">
                <i class="fas fa-tasks mr-2 w-5 text-indigo-600"></i>
                Skill Tests
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('magang.index')" :active="request()->routeIs('magang.*')" class="flex items-center">
                <i class="fas fa-user-graduate mr-2 w-5 text-indigo-600"></i>
                Internships
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('evaluasi.index')" :active="request()->routeIs('evaluasi.*')" class="flex items-center">
                <i class="fas fa-chart-line mr-2 w-5 text-indigo-600"></i>
                Evaluations
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('criteria.index')" :active="request()->routeIs('criteria.*')" class="flex items-center">
                <i class="fas fa-clipboard-list mr-2 w-5 text-indigo-600"></i>
                Criteria
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 bg-gray-50">
            <div class="px-4 py-2 flex items-center">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                    <i class="fas fa-user-circle text-xl"></i>
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->username }}</div>
                    <div class="font-medium text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 border-t border-gray-200 pt-2">
                <!-- Profile Link -->
                <x-responsive-nav-link :href="route('dashboard')" class="flex items-center">
                    <i class="fas fa-user-cog mr-2 w-5 text-indigo-600"></i>
                    Profile
                </x-responsive-nav-link>

                <!-- Settings Link -->
                <x-responsive-nav-link :href="route('dashboard')" class="flex items-center">
                    <i class="fas fa-cog mr-2 w-5 text-indigo-600"></i>
                    Settings
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="flex items-center text-red-600"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2 w-5"></i>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
