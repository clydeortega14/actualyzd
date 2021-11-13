@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-md-12">
				<h3>Dashboard </h3>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-4 grid-margin stretch-card">
	            <div class="card">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">Upcoming sessions</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ count($upcoming_sessions) }}</h3>
	                        <i class="fa fa-calendar fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>
	        </div>
	        <div class="col-md-4 grid-margin stretch-card">
	            <div class="card">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">Completed Sessions</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $completed_sessions }}</h3>
	                        <i class="fa fa-check fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>
	        </div>

	        <div class="col-md-4 grid-margin stretch-card">
	            <div class="card">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">Unclose Sessions</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ count($unclosed_bookings) }}</h3>
	                        <i class="fa fa-times fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row mb-3">
	    	<div class="col-md-12">
	    		<div class="card mb-3">
	    			<div class="card-header">
	    				Sessions
	    			</div>
	    			<div class="card-body">

	    				@php
                            $user = auth()->user();
                            $user_avatar = $user->avatar;
                        @endphp

                        @if($user->hasRole('member'))
                            @php
                                $role = 'member';
                            @endphp
                        @elseif($user->hasRole('psychologist'))
                            @php
                                $role = 'psychologist';
                            @endphp
                        @elseif($user->hasRole('admin'))
                            @php
                                $role = 'admin';
                            @endphp
                        @elseif($user->hasRole('superadmin'))
                            @php
                                $role = 'superadmin';
                            @endphp
                        @endif

						<bookings-lists role="{{ $role }}"></bookings-lists>
	    			</div>
	    		</div>
	    	</div>
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">
						Unclose Sessions
					</div>
					<div class="card-body">
					@if(count($unclosed_bookings) > 0)
						<h5 class="card-title text-danger"><b>WARNING:</b> <small> You have past due sessions / bookings that has not been closed. please close it immediately</small></h5>

						<div class="table-responsive mt-3">
							{{ $unclosed_bookings->links() }}
							<table class="table">
								<thead>
									<tr>
										<th>DateTime</th>
										<th>Type</th>
										<th>Counselee</th>
										<th>Link to progress report</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($unclosed_bookings as $uc_b)
									<tr>
										<td>
											<b>Date: </b><span>{{ $uc_b->toSchedule->fullStartDate()  }}</span> <br>
											<b>Time: </b><span>{{ $uc_b->time->parseTimeFrom().' - '.$uc_b->time->parseTimeTo() }}</span>
										</td>
										<td>{{ $uc_b->sessionType->name }}</td>
										<td>
											<a href="#">
												<img src="{{ is_null($uc_b->counselee) ? 'images/user.png' : asset('storage/'.$uc_b->toCounselee->avatar) }}" 
												     alt="{{ is_null($uc_b->counselee) ? 'N/A' : $uc_b->toCounselee->name }}" 
												     width="50" 
												     height="50" 
												     data-toggle="tooltip" 
												     title="{{ is_null($uc_b->counselee) ? 'N/A' : $uc_b->toCounselee->name }}"
												     class="rounded-circle">
											</a>
										</td>
										<td>N/A</td>
										<td>
											
											<booking-status 
												session-status="{{ $uc_b->toStatus->name }}" 
												:booking-id="{{ $uc_b->id}}" 
												:booking-status="{{ $uc_b->toStatus->id}}" ></booking-status>
											
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection