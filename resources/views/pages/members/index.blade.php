@extends('layouts.sb-admin.master')

@section('content')
	
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">

				<!-- Render Bookings Breadcrumbs -->
				{{-- {{ Breadcrumbs::render() }} --}}
				<!-- end render bookings breadcrumb -->

				@include('alerts.message')

				<ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Summary</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="scheduler-tab" data-toggle="tab" href="#scheduler" role="tab" aria-controls="scheduler" aria-selected="false">Scheduler</a>
                    </li>
                </ul>

                <div class="tab-content">
                	<div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">

                		<div class="row mt-3">
                			<div class="col-xl-3 col-md-6 mb-4">
	                            <div class="card border-left-info shadow h-100 py-2">
	                                <div class="card-body">
	                                    <div class="row no-gutters align-items-center">
	                                        <div class="col mr-2">
	                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
	                                                Total Bookings</div>
	                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_bookings }}</div>
	                                        </div>
	                                        <div class="col-auto">
	                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                        @foreach($booking_by_statuses as $bookedByStatus)

	                        	@if($bookedByStatus->toStatus->name == "New")

	                        		@php
	                        			$badge = 'primary'
	                        		@endphp

	                        	@elseif($bookedByStatus->toStatus->name == "Cancelled")

	                        		@php
	                        			$badge = 'danger'
	                        		@endphp

	                        	@elseif($bookedByStatus->toStatus->name == "Rescheduled")

	                        		@php
	                        			$badge = 'warning'
	                        		@endphp

	                        	@endif

	                        	<div class="col-xl-3 col-md-6 mb-4">
		                            <div class="card border-left-{{ $badge }} shadow h-100 py-2">
		                                <div class="card-body">
		                                    <div class="row no-gutters align-items-center">
		                                        <div class="col mr-2">
		                                            <div class="text-xs font-weight-bold text-{{ $badge }} text-uppercase mb-1">
		                                                {{ $bookedByStatus->toStatus->name == "New" ? 'Upcoming Scheduled Booking' : $bookedByStatus->toStatus->name }}</div>
		                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookedByStatus->booking_count }}</div>
		                                        </div>
		                                        <div class="col-auto">
		                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
	                        @endforeach
                		</div>

	            	</div>

	            	<div class="tab-pane fade" id="scheduler" role="tabpanel" aria-labelledby="scheduler-tab">
	 
	            		<div class="card mt-3">
	            			<div class="card-body">
	            				<div class="card-header">
	            					<a href="{{ route('bookings.create') }}" class="btn btn-primary form-control">If you want to book a session, Click here</a>
	            				</div>
	            				<div class="card-body">
	            					<div class="table-responsive">
	            						@include('pages.bookings.index')
	            					</div>
								</div>
	            			</div>
	            		</div>
	            	</div>
                </div>
			</div>
		</div>
	</div>

@endsection