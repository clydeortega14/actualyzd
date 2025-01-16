

<div class="d-flex justify-content-between mb-3">
    <h3 class="text-gray-800 mb-3">Manage Schedules</h3>
    
    <div>
        @if(auth()->user()->hasRole(['psychologist', 'superadmin']))

            <a href="{{ route('schedule.create') }}" class="btn btn-primary">
                <i class="fa fa-calendar"></i>
                <span>Create New Schedule</span>
            </a>

        @endif


        @if(auth()->user()->hasRole(['member', 'superadmin']))

            <a href="{{ route('booking.onboarding') }}" class="btn btn-primary">
                <i class="fa fa-calendar"></i>
                <span>Book A Session</span>
            </a>
        @endif
    </div>
    
</div>