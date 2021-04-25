@extends('layouts.sb-admin.master')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="card-header">
						Session Details
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Start Time</label>
									<input type="time" value="{{ $report->booking->time->from }}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>To</label>
									<input type="time" value="{{ $report->booking->time->to }}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>Date of session</label>
									<input type="date" value="{{ $report->booking->toSchedule->start}}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>Company Name</label>
									<input type="text" value="" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>Employee Name</label>
									<input type="text" value="{{ $report->booking->toCounselee->name }}" readonly class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header">Progress Reports</div>
					<div class="card-body">
						<div class="form-group">
							<label>Main Concern</label>
							<input type="text" name="main_concern" class="form-control">
						</div>
						<div class="form-group">
							<label>Are there any medications that the client is taking?</label>

							<div class="form-check">
  								<input class="form-check-input" type="radio" name="has_prescription" id="yes" value="yes">
								<label class="form-check-label" for="yes">Yes</label>
							</div>
							<div class="form-check">
  								<input class="form-check-input" type="radio" name="has_prescription" id="no" value="no">
								<label class="form-check-label" for="no">No</label>
							</div>
						</div>

						<div class="form-group">
							<label>What are your initial assessments of the client and what are her / his core concerns?</label>
							<textarea type="text" name="initial_assessment" class="form-control" rows="4"></textarea>
						</div>

						<div class="form-group">
							<label>Recommended for follow up session</label>
							<select type="combobox" name="followup_session" class="form-control">
								<option> -- Select --</option>
								<option>Weekly</option>
								<option>Bi-Weekly</option>
								<option>Monthly</option>
							</select>
						</div>

						<div class="form-group">
							<label>What therapy or intervention does your client need?</label>
							<textarea type="text" name="treatment_goal" class="form-control" rows="4"></textarea>
						</div>


						<div class="form-group">
							<button class="btn btn-primary btn-block" type="submit">Submit</button>
							<a href="#" class="btn btn-danger btn-block">Cancel</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop