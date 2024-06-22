@extends('layouts.app')


@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="text-gray-800 mb-3">Manage Schedules</h3>
        <a href="{{ route('schedule.create') }}" class="btn btn-primary">
            <i class="fa fa-calendar"></i>
            <span>Create New Schedule</span>
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">

            @include('pages.schedules.nav-tabs.nav-item')
            
            @if(count($pending_schedules) > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Session Type</th>
                                        <th>Date and Time</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pending_schedules as $pending)
                                        <tr>
                                            <td>{{ $pending->sessionType->name }}</td>
                                            <td>{{ $pending->toSchedule->format_start.' - '.$pending->time->format_time }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success">Accept</button>
                                                <button type="button" class="btn btn-sm btn-secondary">Reassign</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            @else
                <p class="text-center p-4">No Pending Session</p>
            @endif
        </div>
    </div>
</div>


@endsection