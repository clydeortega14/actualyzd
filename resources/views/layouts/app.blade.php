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

    
    <style>
      .ac-upload input[type=file] {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        opacity: 0;
      }

      .ac-avatar {
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 70%;
        max-height: 320px;
        border-radius: 50%;
        border: 5px solid #D5D5D5;
      }
    </style>
    

    @yield('custom_styles')
</head>
<body>
    <div id="app">
            @php
                $user = auth()->user();
            @endphp
            <nav class="navbar navbar-expand-md shadow-sm">
                <a class="navbar-brand pr-4 pl-4" href="{{ auth()->user() ? url('/home') : url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                    {{-- <img src="{{ asset('/images/logo-01.png') }}" class="mx-auto d-block" width="60" height="60"> --}}
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
                                <a href="#" id="notifications" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="badge badge-danger badge-counter">{{ count(auth()->user()->notifications()->whereNull('read_at')->get()) }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifications">
                                    @if(count(auth()->user()->unreadNotifications) > 0)
                                        @foreach(auth()->user()->unreadNotifications->slice(0, 3) as $notification)
                                            <a href="#" class="dropdown-item d-flex align-items-center">
                                                <div class="mr-3">
                                                    <i class="fa fa-bell"></i>
                                                    
                                                </div>
                                                <div>
                                                    <div>
                                                        <span class="{{ is_null($notification->read_at) ? 'font-weight-bold' : '' }}">
                                                            {{ $notification->data['title'] }}
                                                        </span>
                                                        <span class="small text-gray-500">
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <span>
                                                        {{ $notification->data['description'] }}
                                                    </span>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <a href="#" class="dropdown-item">No Notifications Available</a>
                                    @endif
                                </div>
                            </li>

                            <li class="mr-3">
                                <faq-icon></faq-icon>

                                <faq-modal></faq-modal>
                                <!-- Help Modal -->
                                {{-- @include('layouts.includes.modals.help-modal') --}}
                            </li>
                            
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="far fa-arrow-alt-circle-right"></i>
                                    <span class="ml-2">{{ __('Logout') }}</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile', auth()->user()->id) }}">
                                        <i class="fa fa-user"></i>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    
                                </div> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            @guest
                <main class="py-4">
                    @yield('content')
                </main>
            @endguest
        

            @auth
                @include('layouts.includes._sidebar')
            @endauth
        
            
        
    </div>

    <!-- js compiled assets -->
    <script defer src="{{ asset('js/app.js') }}"></script>


    @stack('scripts')
</body>
</html>
