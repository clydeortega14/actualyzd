@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <h3>Bookings</h3>
				{{ Breadcrumbs::render('psychologist.bookings') }}
			</div>
            {{-- <div class="col-md-12 mb-3">
                @if(auth()->user()->hasRole('psychologist'))
                    @php
                        $route = route('psychologist.home');
                    @endphp
                @elseif(auth()->user()->hasRole('member'))
                    @php
                        $route = route('member.home');
                    @endphp
                @else
                    @php
                        $route = route('home');
                    @endphp

                @endif
                <a href="{{ $route }}" class="btn btn-info">
                    <i class="fa fa-arrow-left"></i>
                    <span>Return Back</span>
                </a>
            </div> --}}
			<div class="col-md-12">
				{{-- <div class="card mb-3">
					<div class="card-body">
						@if(!is_null($upcoming))
                            <div class="d-flex justify-content-between mb-3 mr-3 ml-3">
                                <div>
                                    <a href="#" class="mr-3">
                                        <i class="fa fa-video"></i>
                                        <span>Start Video Call</span>
                                    </a>
                                </div>
                                
                                <div>
                                    <form action="{{ route('booking.update.status', $upcoming->id) }}" method="POST">
                                        @csrf
                                        <booking-status session-status="{{ $upcoming->toStatus->name }}" :booking-id="{{ $upcoming->id }}" :booking-status="{{ $upcoming->toStatus->id}}"></booking-status>
                                    </form>
                                </div>
                            </div>
                        @endif
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
					</div>
				</div> --}}

				<div class="card mb-3">
					<div class="card-body">
						<bookings-lists></bookings-lists>
					</div>
				</div>
			</div>
		</div>
	</div>	

@endsection