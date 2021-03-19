@extends('layouts.sb-admin.master')

@section('content')
	

	<div class="container-fluid">
		<div class="row">

			<h1 class="h3 mb-3 text-gray-800">Bookings</h1>

			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-header">
						<a href="#" class="btn btn-info btn-sm float-right">
							<i class="fa fa-plus"></i>
							<span>Book Session</span>
						</a>
					</div>
					<div class="card-body">
						<div class="table-resposive">
							<table class="table">
								<thead>
									<tr>
										<th>Psychologist</th>
										<th>Schedule</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop