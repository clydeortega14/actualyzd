@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				{{ Breadcrumbs::render('progress.report') }}
			</div>
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-book"></i>
						<span>Progress Reports</span>
					</div>
					<div class="card-body">
						<div class="table-reponsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>Timestamp</th>
										<th>Date of Session</th>
										<th>Company Name</th>
										<th>Employee Name</th>
										<th>Main Concern</th>
										<th>Current Prescriptions and Over the counter</th>
										<th>Initial Assessment</th>
										<th>Recomended Follow up session</th>
										<th>Intervention plan / treatment goal</th>
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
												<span>{{ !is_null($report->booking->toCounselee) ? $report->booking->toCounselee->name : 'N/A' }}</span>
											</td>
											<td>{{ $report->main_concern }}</td>
											<td>{{ $report->has_prescription && !is_null($report->hasMedication) ?  $report->hasMedication->medication : 'None'}}</td>
											<td>{{ $report->initial_assessment }}</td>
											<td>{{ $report->followupSession->name }}</td>
											<td>{{ $report->treatment_goal }}</td>
											<td>
												<a href="{{ route('progress.report.create-for-booking', $report->booking->id) }}">
													<i class="fa fa-eye"></i>
												</a>
											</td>
										</tr>
										{{-- @include('pages.progress-reports.modals.report') --}}
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