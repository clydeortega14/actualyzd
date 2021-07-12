@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12 mb-3 d-flex justify-content-between">
				<h3 class="text-gray">Home Page</h3 class="text-gray">
				<a href="{{ route('booking.onboarding') }}" class="btn btn-primary">
					<i class="fa fa-calendar"></i>
					<span>Book A Session</span>
				</a>
			</div>

			<div class="col-xl-3 col-md-6 mb-4">
                <div class="card mb-3">
                	<div class="card-header">
                		<div class="text-xs text-uppercase mb-1">	
                		TOTAL BOOKINGS
                		</div>
                	</div>
                    <div class="card-body">
                    	<div class="h1 mb-0 text-gray-800 text-center">{{ $total_bookings }}</div>
                    </div>
                </div>
                @foreach($booking_by_statuses as $bookedByStatus)
                    <div class="card mb-3">
                    	<div class="card-header">
                    		<div class="text-xs text-uppercase mb-1">
                                {{ $bookedByStatus->toStatus->name }}
                            </div>
                    	</div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h1 mb-0 text-gray-800 text-center">{{ $bookedByStatus->booking_count }}</div>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                
            @endforeach
            </div>

            <div class="col-md-9">
            	<div class="card mb-3">
            		{{-- <div class="card-header">Upcoming Session</div> --}}
            		<div class="card-body">
                        <div class="d-flex justify-content-between mb-3 mr-3 ml-3">
                            <div>
                                <a href="#" class="mr-3">
                                    <i class="fa fa-video"></i>
                                    <span>Start Video Call</span>
                                </a>
                                <a href="#" class="mr-3">
                                    <i class="fa fa-book"></i>
                                    <span>Progress Report</span>
                                </a>
                            </div>
                            
                            <div>
                                <a href="#" class="mr-3">
                                    <i class="fa fa-eye-slash"></i>
                                    <span>No Show</span>
                                </a>
                                <a href="#" class="mr-3">
                                    <i class="fa fa-times"></i>
                                    <span>Cancel</span>
                                </a>
                                <a href="#" class="mr-3">
                                    <i class="fa fa-calendar"></i>
                                    <span>Reschedule</span>
                                </a>
                                <a href="#" class="mr-3">
                                    <i class="fa fa-check"></i>
                                    <span>Complete</span>
                                </a>
                            </div>
                        </div>
            			<h5 class="card-title text-center">
            				<div class="mb-4">
            					UPCOMING SESSION
            				</div>
            				<div class="mb-4">
                                @if(!is_null($upcoming))
            					<h4>{{ $upcoming->toSchedule->fullStartDate() }} @ {{ $upcoming->time->parseTimeFrom().' - '.$upcoming->time->parseTimeTo() }}</h4>
                                @else
                                    <b>NOT AVAILABLE</b>
                                @endif
            				</div>
            				
            		    </h5>
                        @if(!is_null($upcoming))
                		    <div class="text-center">
                		    	@if(!is_null($upcoming->link_to_session))
                    				<a href="#" data-toggle="tooltip" title="Link To Session" class="mr-3">
                    				    <i class="fa fa-link"></i>
                    				    <span>link to session</span>
                    				</a>
                				@endif
                			</div>
                        @endif

            		</div>
            	</div>

            	<div class="card mb-3">
            		<div class="card-header">Session Logs</div>
            		<div class="card-body">
                        <bookings-lists></bookings-lists>
            			{{-- @include('pages.bookings.index') --}}
            		</div>
            	</div>
            </div>


		</div>
	</div>

@endsection