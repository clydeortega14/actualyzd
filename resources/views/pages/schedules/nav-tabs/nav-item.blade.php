<ul class="nav nav-tabs mb-3">
    <li class="nav-item active">
        <a href="{{ route('session.view.calendar') }}" class="nav-link {{ Route::is('session.view.calendar') ? 'active' : '' }}">
            Session View
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('psychologist.schedules.page') }}" class="nav-link {{ Route::is('psychologist.schedules.page') ? 'active' : '' }}">
            Pending Sessions
        </a>
        
    </li>
</ul>