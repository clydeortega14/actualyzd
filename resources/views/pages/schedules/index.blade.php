@extends('admin-layouts.master')

@section('title', 'Schedules')

@section('custom_css')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">

@endsection

@section('content')

	<div class="container-fluid" id="main-index">

		<div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        Psychologists
                    </div>

                    <div class="body">
                        <div class="form-group">
                            <input type="radio" id="example1" name="psychologist" class="with-gap" />
                            <label for="example1">Psychologist One</label>
                        </div>  

                        <div class="form-group">
                            <input type="radio" id="example2" name="psychologist" class="with-gap" />
                            <label for="example2">Psychologist Two</label>
                        </div>  
                    </div>
                </div>
            </div>
	        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="body">
	                	<!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active"><a href="#calendar-schedule" data-toggle="tab">Schedules</a></li>
                            <li role="presentation"><a href="#schedule-request" data-toggle="tab"> Counselings <span class="badge bg-red">5</span></a> </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active mb-4" id="calendar-schedule">
                            	<div class="row clearfix">
                            		<div class="col-sm-12">
	                    				<div id="calendar"></div>
                                        @include('pages.schedules.modals.create-schedule')
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
                                						<th>Action</th>
                                					</tr>
                                				</thead>
                                				<tbody>
                                					<tr>
                                						<td>Homar</td>
                                						<td>
                                                            <a href="{{ route('schedule.show') }}">Depressed</a>
                                                        </td>
                                						<td>Victor Ortiza</td>
                                						<td><span class="badge bg-orange">February 4, 2021, 8:30 am - 10:00 am</span></td>
                                						<td>
                                							<span class="badge bg-blue">New</span>
                                						</td>
                                						<td>
                                                            <a href="#" class="btn btn-success waves-effect btn-xs">Confirm</a>
                                                            <a href="#" class="btn btn-danger waves-effect btn-xs">Cancel</a>
                                                            <a href="#" class="btn btn-warning waves-effect btn-xs">Reschedule</a>
                                							
                                						</td>
                                					</tr>

                                					<tr>
                                						<td>Gloria</td>
                                						<td>
                                                           <a href="{{ route('schedule.show') }}"> Been thinking of my losses, and don't know what to do </a>
                                                        </td>
                                						<td>Bonito</td>
                                						<td>
                                							<span class="badge bg-orange">February 4, 2021, 8:30 am - 10:00 am</span>
                                						</td>
                                						<td>
                                							<span class="badge bg-blue">New</span>
                                						</td>
                                						<td>
                                							<a href="#" class="btn btn-success waves-effect btn-xs">Confirm</a>
                                                            <a href="#" class="btn btn-danger waves-effect btn-xs">Cancel</a>
                                                            <a href="#" class="btn btn-warning waves-effect btn-xs">Reschedule</a>
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
    <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
	<script type="module" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>

@endsection