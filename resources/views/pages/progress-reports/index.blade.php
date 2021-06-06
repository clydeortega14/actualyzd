@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-book"></i>
						<span>Progress Reports</span>
					</div>
					<div class="card-body">
						<div class="table-reponsive">
							<table class="table">
								<thead>
									<tr>
										<th>Timestamp</th>
										<th>Date of Session</th>
										<th>Company Name</th>
										<th>Employee Name</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($reports as $report)
										<tr>
											<td>{{ $report->booking->time->parseTimeFrom().' - '.$report->booking->time->parseTimeTo() }}</td>
											<td>{{ $report->booking->toSchedule->formattedStart() }}</td>
											<td>{{ $report->booking->toClient->name }}</td>
											<td>
												@if(count($report->booking->participants) > 0)
				                                    @foreach($report->booking->participants as $participant)
				                                      <span>{{ $participant->name }}</span>
				                                    @endforeach
			                                  	@endif
											</td>
											<td>
												<a href="#" data-toggle="modal" data-target="#report-{{ $report->id }}">View Report</a>
											</td>
										</tr>
										@include('pages.progress-reports.modals.report')
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection