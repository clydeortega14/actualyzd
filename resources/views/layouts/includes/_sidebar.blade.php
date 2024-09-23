<div class="wrapper">
    <!-- SideBar -->
    @if(!is_null(auth()->user()->email_verified_at))
    <nav id="sidebar">
        {{-- @if(is_null(auth()->user()->avatar))
            <a href="{{ route('user.profile', auth()->user()->id) }}">
                <div id="container">
                    <div id="name">
                        {{ auth()->user()->name[0] }}
                    </div>
                </div>
            </a>
        @else
           
            <a href="{{ route('user.profile', auth()->user()->id) }}">
                <img src="{{ file_exists(public_path('storage/'.auth()->user()->avatar)) ? asset('storage/'.auth()->user()->avatar) : '/images/profile.png' }}" class="mt-3 rounded-circle ac-avatar">
            </a>
            
        @endif --}}

        <ul class="list-unstyled components">
            <p class="text-center">Hi, {{ auth()->user()->name }}!</p>

            @if($user->hasRole('member'))
                <li class="{{ Route::is('member.home') ? 'active' : '' }}">
                    <a href="{{ route('member.home') }}">
                        <i class="fa fa-home"></i>
                        <span class="ml-3">Home</span>
                    </a>
                </li>

                <li class="{{ Route::is('user.profile.edit', auth()->user()->id) ? 'active' : '' }}">
                    <a href="{{ route('user.profile.edit', auth()->user()->id) }}">
                        <i class="fa fa-home"></i>
                        <span class="ml-3">Account Settings</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole('psychologist'))

                <li class="{{ Route::is('psychologist.home') ? 'active' : '' }}">
                    <a href="{{ route('psychologist.home') }}">
                        <i class="fa fa-home"></i>
                        <span class="ml-3">Home</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole(['superadmin', 'admin']))
                <li class="{{ Route::is('service.utilization.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('service.utilization.dashboard') }}">
                        <i class="fa fa-home"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole(['superadmin']))
                <li class="{{ Route::is('bookings.index') ? 'active' : '' }}">
                    <a href="{{ route('bookings.index') }}">
                        <i class="fa fa-calendar"></i>
                        <span class="ml-3">Sessions</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole(['psychologist', 'superadmin', 'member']))
                <li class="{{ Route::is('psychologist.schedules.page') || Route::is('session.view.calendar') ? 'active' : '' }}">
                    <a href="{{ route('psychologist.schedules.page') }}">
                        <i class="fa fa-calendar"></i>
                        <span class="ml-3">Schedules</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole(['admin']))
                <li class="{{ Route::has('clients.*') ? 'active' : '' }}">
                    <a href="{{ route('clients.edit', auth()->user()->client_id) }}">
                        <i class="fa fa-address-card"></i>
                        <span class="ml-3">Company Profile</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole('superadmin'))
                <li class="{{ Route::is('clients.index') ? 'active' : '' }}">
                    <a href="{{ route('clients.index') }}">
                        <i class="fa fa-address-card"></i>
                        <span class="ml-3">Clients</span>
                    </a>
                </li>

                <li class="{{ Route::is('psychologists.index') ? 'active' : '' }}">
                    <a href="{{ route('psychologists.index') }}">
                        <i class="fa fa-address-card"></i>
                        <span class="ml-3">Psychologists</span>
                    </a>
                </li>

            

                <li class="{{ \Request::is('set-up/*') ? 'active' : '' }}">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-cogs"></i>
                        <span class="ml-3">Settings</span>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ route('packages.index') }}">
                                <i class="fa fa-box-open"></i>
                                <span class="ml-3">Packages</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('assessments') }}">
                                <i class="fa fa-clipboard-list"></i>
                                <span class="ml-3">Assessments</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('time-lists.index') }}">
                                <i class="fa fa-fw fa-clock"></i>
                                <span class="ml-3">Time lists</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="{{ \Request::is('FAQs/*') ? 'active' : '' }}">
                    <a href="{{ route('faqs.index') }}">
                        <i class="fa fa-address-card"></i>
                        <span class="ml-3">FAQ's</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole(['superadmin', 'psychologist']))
            <li class="{{ \Request::is('progress-reports/*') || Route::is('progress.report') ? 'active' : '' }}">
                <a href="{{ route('progress.report') }}">
                    <i class="fa fa-list-alt"></i>
                    <span class="ml-3">Progress Reports</span>
                </a>
            </li>
            @endif
        </ul>
    </nav>
    @endif

    <div id="content">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</div>