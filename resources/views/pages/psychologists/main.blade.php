@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-md-12">
				<h3>Dashboard </h3>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-md-3 grid-margin stretch-card">
	            <div class="card mb-3">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">Upcoming sessions</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ count($upcoming_sessions) }}</h3>
	                        <i class="fa fa-calendar fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>

	            <div class="card mb-3">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">Completed Sessions</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $completed_sessions }}</h3>
	                        <i class="fa fa-check fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>

	            <div class="card mb-3">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">Cancelled</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $cancelled_bookings }}</h3>
	                        <i class="fa fa-exclamation-circle fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>

	            <div class="card mb-3">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">No Show</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $no_show }}</h3>
	                        <i class="fa fa-thumbs-down fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>

	            <div class="card mb-3">
	                <div class="card-body">
	                    <p class="card-title text-md-center text-xl-left">Unclose Sessions</p>
	                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
	                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $unclosed_bookings_count }}</h3>
	                        <i class="fa fa-times fa-2x pr-3"></i>
	                    </div>  
	                </div>
	            </div>

	        </div>

	        <div class="col-md-9">
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

						@if(count($upcoming_sessions) > 0)

						<bookings-lists role="{{ $role }}"></bookings-lists>

						@else
							<h5 class="card-title text-center">No Upcoming Sessions</h5>
						@endif
	    			</div>
	    		</div>

				@if(count($unclosed_bookings) > 0)
	    		<div class="card mb-3">
					<div class="card-header">
						Unclose Sessions
					</div>
					<div class="card-body">
					
						<h5 class="card-title text-danger"><b>WARNING:</b> <small> You have past due sessions / bookings that has not been closed. please close it immediately</small></h5>

						<div class="table-responsive mt-3">
							{{ $unclosed_bookings->links() }}
							<table class="table">
								<thead>
									<tr>
										<th>Session Type</th>
										<th>DateTime</th>
										<!-- <th>Counselee</th> -->
										<th></th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($unclosed_bookings as $uc_b)
									<tr>
										<td>{{ $uc_b->sessionType->name }}</td>
										<td>
											<a href="{{ config('app.url').'bookings/session/'.$uc_b->room_id }}" target="_blank">
												{{$uc_b->toSchedule->fullStartDate().' - '.$uc_b->time->parseTimeFrom().' - '.$uc_b->time->parseTimeTo()}}
											</a>
										</td>
										<!-- <td>
											<a href="#">
												<img src="{{ is_null($uc_b->counselee) ? 'images/user.png' : asset('storage/'.$uc_b->toCounselee->avatar) }}" 
												     alt="{{ is_null($uc_b->counselee) ? 'N/A' : $uc_b->toCounselee->name }}" 
												     width="50" 
												     height="50" 
												     data-toggle="tooltip" 
												     title="{{ is_null($uc_b->counselee) ? 'N/A' : $uc_b->toCounselee->name }}"
												     class="rounded-circle">
											</a>
										</td> -->
										@if($uc_b->sessionType->name == "Individual Session" && !is_null($uc_b->toCounselee))
											<td>
												@if(count($uc_b->toCounselee->progressReports))
													@php
														$latest_report = $uc_b->toCounselee->progressReports()->orderBy('created_at', 'desc')->first();
														$link = !is_null($latest_report) ?  : '';
													@endphp	
													@if(!is_null($latest_report))
														<a href="{{ config('app.url').'progress-reports/create-for-bookig/'.$latest_report->id }}" target="_blank">
															<i class="fa fa-book"></i>
														</a>
													@endif
												@else
													<span>Firstimer</span>
												@endif
											</td>
										@endif
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
					
					</div>
				</div>
				@endif
	    	</div>
	    </div>
	</div>

@endsection