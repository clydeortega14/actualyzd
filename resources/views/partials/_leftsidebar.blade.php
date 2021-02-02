@php
    $user = auth()->user();
@endphp

<aside id="leftsidebar" class="sidebar">
<!-- User Info -->
<div class="user-info">
    <div class="image">
        <img src="{{ asset('admin-bsb/images/user.png') }}" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $user->name }}</div>
        <div class="email">{{ $user->email  }}</div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- #User Info -->
<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
            <a href="{{ route('home') }}">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>

        <li>
            <a href="{{ route('clients.index') }}">
                <i class="material-icons">home</i>
                <span>Clients</span>
            </a>
        </li>

        <li>
            <a href="{{ route('psychologists.index') }}">
                <i class="material-icons">home</i>
                <span>Psychologists</span>
            </a>
        </li>

        <li>
            <a href="{{ route('schedules.index') }}">
                <i class="material-icons">home</i>
                <span>Schedules</span>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Access Rights</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="javascript:void(0);">
                        <span>Users</span>
                    </a>
                    <a href="javascript:void(0);">
                        <span>Roles</span>
                    </a>
                    <a href="javascript:void(0);">
                        <span>Permissions</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- #Menu -->
<!-- Footer -->
<div class="legal">
    <div class="copyright">
        &copy; {{ now()->format('Y') }} <a href="javascript:void(0);">{{ config('app.name') }}</a>
    </div>
    <div class="version">
        <b>Version: </b> 1.0
    </div>
</div>
<!-- #Footer -->
</aside>