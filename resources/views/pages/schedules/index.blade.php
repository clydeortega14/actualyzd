@extends('admin-layouts.master')

@section('title', 'Schedules')

@section('custom_css')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">

@endsection

@section('content')

	<div class="container-fluid">

		<div class="row clearfix">
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="header">
	                    <h2>
	                        Schedules <small>Description text here...</small>
	                    </h2>
	                            
			            <a href="{{ route('book.now') }}" class="btn btn-primary header-dropdown m-r--5 pull-right">Book Now</a>
	                </div>

	                <div class="body">
	                	<!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active"><a href="#calendar-schedule" data-toggle="tab">Calendar Schedule</a></li>
                            <li role="presentation"><a href="#schedule-request" data-toggle="tab">Schedule Request <span class="badge bg-red">5</span></a> </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active mb-4" id="calendar-schedule">
                            	<div class="row clearfix">
                            		<div class="col-sm-12">
	                    				<div id="calendar"></div>
                            			
                            		</div>
                            	</div>
                                
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="schedule-request">
                                
                                <div class="row clearfix">
                                	<div class="col-sm-12">
                                		<div class="table-responsive">
                                			<table class="table table-bordered table-hover table-striped">
                                				<thead>
                                					<tr>
                                						<th>Client</th>
                                						<th>Reason / Purpose</th>
                                						<th>Psychologist</th>
                                						<th>Schedule</th>
                                						<th>Status</th>
                                						<th></th>
                                					</tr>
                                				</thead>
                                				<tbody>
                                					<tr>
                                						<td>Homar</td>
                                						<td>Depressed</td>
                                						<td>Victor Ortiza</td>
                                						<td><span class="badge bg-orange">February 4, 2021, 8:30 am - 10:00 am</span></td>
                                						<td>
                                							<span class="badge bg-blue">New</span>
                                						</td>
                                						<td>
                                							<button class="btn btn-primary waves-effect btn-block">Action</button>
                                						</td>
                                					</tr>

                                					<tr>
                                						<td>Gloria</td>
                                						<td>Been thinking of my losses, and don't know what to do</td>
                                						<td>Bonito</td>
                                						<td>
                                							<span class="badge bg-orange">February 4, 2021, 8:30 am - 10:00 am</span>
                                						</td>
                                						<td>
                                							<span class="badge bg-blue">New</span>
                                						</td>
                                						<td>
                                							<button class="btn btn-primary waves-effect btn-block">Action</button>
                                						</td>
                                					</tr>
                                				</tbody>
                                			</table>
                                		</div>
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

@section('custom_js')

	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>

@endsection