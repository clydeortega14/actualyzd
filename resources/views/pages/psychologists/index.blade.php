@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<h3>Pyschologist Home</h3>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">Bookings</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="progress-reports-tab" data-toggle="tab" href="#progress-reports" role="tab" aria-controls="progress-reports" aria-selected="false">Progress Reports</a>
                            </li>
                        </ul>


                        <div class="tab-content">
                        	<div class="tab-pane fade show active" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
                        		<div class="container mt-4">
                        			<div class="row justify-content-center">
                        				<div class="col-md-10">
                        					<div class="table-responsive">
                        						<table class="table table-bordered">
                        							<thead>
	                        							<tr>
	                        								<th>Date</th>
	                        								<th>Time</th>
	                        								<th>Client Details</th>
	                        								<th>Topic</th>
	                        								<th>Link of session</th>
	                        								<th>Status</th>
	                        							</tr>
                        							</thead>
                        							<tbody>
                        								<tr>
                        									<td>3/22/2021</td>
                        									<td>10:00 - 11:00 PM</td>
                        									<td>Kevin Satingasin Parmoso</td>
                        									<td><a href="#">link to anwers of boarding questions</a></td>
                        									<td><a href="#">Gmail Link</a></td>
                        									<td>Started</td>
                        								</tr>
                        								<tr>
                        									<td>3/22/2021</td>
                        									<td>10:00 - 11:00 PM</td>
                        									<td>Kevin Satingasin Parmoso</td>
                        									<td><a href="#">link to anwers of boarding questions</a></td>
                        									<td><a href="#">Gmail Link</a></td>
                        									<td>Started</td>
                        								</tr>
                        							</tbody>
                        						</table>
                        					</div>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="tab-pane fade" id="progress-reports" role="tabpanel" aria-labelledby="progress-reports-tab">
                        		<div class="container mt-4">
                        			<div class="row">
                        				<div class="col-md-12">
                        					<div class="table-responsive">
                        						<table class="table table-bordered">
                        							<thead>
                        								<tr>
                        									<th>Timestamp</th>
                        									<th>Date Of Session</th>
                        									<th>Company Name</th>
                        									<th>Employee Name</th>
                        									<th>Main Concern</th>
                        									<th>Current prescriptions and over the counter</th>
                        									<th>Initial Assessment / Impression</th>
                        									<th>Recommended for follow up session</th>
                        									<th>Intervention Plan / Treatment Goal:</th>
                        								</tr>
                        							</thead>
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
	</div>
	
@endsection