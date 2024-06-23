@extends('layouts.app')


@section('content')

<div class="container-fluid">
    
    @include('pages.schedules.header.index')

    <div class="row">
        <div class="col-md-12">

            @include('pages.schedules.nav-tabs.nav-item')

            @if(session()->has('success'))

                <div class="alert alert-success" role="alert">{{ session('success') }}</div>

            @endif

            @if(session()->has('error'))

                <div class="alert alert-error" role="alert">{{ session('error') }}</div>

            @endif
            
            @if(count($pending_schedules) > 0)
                <div class="card">
                    <div class="card-body">
                        @foreach($pending_schedules as $pending)
                            <div class="d-flex justify-content-between border-bottom mb-5">
                                <div>
                                    <h5 class="card-title">{{ $pending->sessionType->name }}</h5>
                                    <p class="card-text">{{ $pending->toSchedule->format_start.' - '.$pending->time->format_time }}</td></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-sm btn-success mr-2" 
                                        onclick="event.preventDefault(); document.getElementById('update-pending-form-{{$pending->id}}').submit();" name="btn_action">Accept</button>
                                    <button type="button" class="btn btn-sm btn-secondary">Reassign</button>
                                </div>
                            </div>

                            <form action="{{ route('update.pending.schedule') }}" method="POST" id="update-pending-form-{{ $pending->id }}">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $pending->room_id }}">
                            </form>
                        @endforeach
                        
                        
                    </div>
                </div>
                
            @else
                <p class="text-center p-4">No Pending Session</p>
            @endif

            
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        (function(){
            //
        })
    </script>

@endsection