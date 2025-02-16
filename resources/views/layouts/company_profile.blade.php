<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/company_profile.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            
                <a class="navbar-brand pr-4 pl-4" href="{{ auth()->user() ? url('/home') : url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @php
                                $user = auth()->user();
                            @endphp
                            @if($user->hasRole(['admin', 'superadmin']))
                                <li class="nav-item active p-3">
                                    <a class="nav-link" href="{{ route('home') }}">Dashboard <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="{{ url('users') }}">
                                        <i class="fas fa-fw fa-clock"></i>
                                        <span>Users</span>
                                    </a>
                                </li>
                            @endif

                            @if($user->hasRole('superadmin'))
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="{{ route('bookings.create') }}">
                                    <i class="fas fa-fw fa-calendar"></i>
                                    <span>Book A Session</span></a>
                                </li>
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="{{ route('clients.index') }}">
                                        <i class="fas fa-fw fa-clock"></i>
                                        <span>Clients</span>
                                    </a>
                                </li>

                                <li class="nav-item p-3">
                                    <a class="nav-link" href="{{ route('packages.index') }}">
                                        <i class="fas fa-fw fa-clock"></i>
                                        <span>Packages</span>
                                    </a>
                                </li>

                                <li class="nav-item p-3 dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" id="access-rights" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-fw fa-cog"></i>
                                        <span>Access Rights</span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="access-rights">
                                        <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                                        <a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a>
                                    </div>
                                </li>
                                <li class="nav-item p-3 dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" id="assessments" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-fw fa-cog"></i>
                                        <span>Assessments</span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="assessments">
                                        <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
                                        <a class="dropdown-item" href="{{ route('options.index') }}">Options</a>
                                    </div>
                                </li>

                                <!-- Nav Item - Utilities Collapse Menu -->
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="{{ route('time-lists.index') }}">
                                        <i class="fas fa-fw fa-clock"></i>
                                        <span>Time Lists</span>
                                    </a>
                                </li>

                                <li class="nav-item p-3">
                                    <a class="nav-link" href="{{ route('progress.report') }}">
                                        <i class="fas fa-book"></i>
                                        <span>Progress Report</span>
                                    </a>
                                </li>
                            @endif

                            @if($user->hasRole('admin'))
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="{{ url('company_info') }}">
                                        <i class="fas fa-fw fa-clock"></i>
                                        <span>Company</span>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest

                        @else
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile', auth()->user()->id) }}">
                                        <i class="fa fa-user"></i>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="far fa-arrow-alt-circle-right"></i>
                                        <span class="ml-2">{{ __('Logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- js compiled assets -->
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script defer src="{{ asset('js/company_profile.js') }}"></script>
</body>
</html>
