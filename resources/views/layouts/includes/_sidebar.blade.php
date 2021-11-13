<div class="wrapper">
    <!-- SideBar -->
    <nav id="sidebar">
        {{-- <div class="sidebar-header">
            <h3>{{ config('app.name', 'Laravel') }}</h3>
        </div> --}}

        @if(is_null(auth()->user()->avatar))
            <div id="container">
                <div id="name">
                    {{ auth()->user()->name[0] }}

                </div>
            </div>
        @else
            {{-- <div class="d-flex justify-content-center align-items-center"> --}}
                <a href="{{ route('user.profile', auth()->user()->id) }}">
                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}" class="mt-3 img-fluid rounded-circke mx-auto d-block ac-avatar">
                </a>
            {{-- </div> --}}
        @endif

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

                {{-- <li class="{{ Route::is('users.index') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                    </a>
                </li> --}}
            @endif

            @if($user->hasRole(['superadmin']))
                <li class="{{ Route::is('bookings.index') ? 'active' : '' }}">
                    <a href="{{ route('bookings.index') }}">
                        <i class="fa fa-calendar"></i>
                        <span class="ml-3">Bookings</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole(['psychologist', 'superadmin']))
                <li class="{{ Route::is('schedules.index') ? 'active' : '' }}">
                    <a href="{{ route('schedules.index') }}">
                        <i class="fa fa-calendar"></i>
                        <span class="ml-3">Schedules</span>
                    </a>
                </li>
            @endif

            @if($user->hasRole(['admin', 'superadmin']))
                <li class="{{ Route::is('member.lists') ? 'active' : '' }}">
                    <a href="{{ route('member.lists') }}">
                        <i class="fa fa-address-card"></i>
                        <span class="ml-3">Members</span>
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
                        {{-- <li>
                            <a href="#accessRightsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-wrench"></i>
                                <span>Access Rights</span>
                            </a>
                            <ul class="collapse list-unstyled" id="accessRightsSubmenu">
                                <li>
                                    <a href="{{ route('roles.index') }}">

                                        <span>Roles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('permissions.index') }}">Permissions</a>
                                </li>
                            </ul>
                        </li> --}}
                        <li>
                            <a href="{{ route('assessments') }}">
                                <i class="fa fa-clipboard-list"></i>
                                <span class="ml-3">Assessments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-fw fa-clock"></i>
                                <span class="ml-3">Time lists</span>
                            </a>
                        </li>
                    </ul>
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

    <div id="content">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    </div>