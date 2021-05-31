<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('bookings.create') }}">
        <i class="fas fa-fw fa-calendar"></i>
        <span>Book A Session</span></a>
</li>
@if(auth()->user()->hasRole('admin'))
    <li class="nav-item">
        <a class="nav-link" href="{{ url('client/users') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Members</span>
        </a>
    </li>
@endif

@if(auth()->user()->hasRole('superadmin'))
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Set Up
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">
            <i class="fas fa-fw fa-clock"></i>
            <span>Clients</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('packages.index') }}">
            <i class="fas fa-fw fa-clock"></i>
            <span>Packages</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Access Rights</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('users') }}">Users</a>
                <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#assessments"
            aria-expanded="true" aria-controls="assessments">
            <i class="fas fa-fw fa-cog"></i>
            <span>Assessments</span>
        </a>
        <div id="assessments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('categories.index') }}">Categories</a>
                <a class="collapse-item" href="{{ route('options.index') }}">Options</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('time-lists.index') }}">
            <i class="fas fa-fw fa-clock"></i>
            <span>Time Lists</span>
        </a>
    </li>
@endif

{{-- <!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Transactions
</div>

<!-- Nav Item - Pages Collapse Menu -->

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('schedules.index') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Schedules</span>
    </a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('bookings.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Bookings</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block"> --}}

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>