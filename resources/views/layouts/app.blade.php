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

    @yield('custom_styles')
</head>
<body>
    <div id="app">

       
                
        <nav class="navbar navbar-expand-md shadow-sm">
    
            <a class="navbar-brand pr-4 pl-4" href="{{ auth()->user() ? url('/home') : url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    
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


        <div class="wrapper">
            <!-- SideBar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>{{ config('app.name', 'Laravel') }}</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Hi, {{ auth()->user()->name }}!</p>
                    <li class="active">
                        <a href="{{ route('service.utilization.dashboard') }}">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bookings.index') }}">
                            <i class="fa fa-calendar"></i>
                            <span>Sessions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('clients.index') }}">
                            <i class="fa fa-address-card"></i>
                            <span>Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Setups</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-box-open"></i>
                                    <span>Packages</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-wrench"></i>
                                    <span>Access Rights</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-clipboard-list"></i>
                                    <span>Assessments</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-fw fa-clock"></i>
                                    <span>Time lists</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-list-alt"></i>
                            <span>Progress Reports</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div id="content">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
            
        
    </div>

    <!-- js compiled assets -->
    <script defer src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
