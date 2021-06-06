@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-8">
				<div class="card">
					<div class="card-header">
						add time
					</div>
					<div class="card-body">
	                    @include('alerts.message')

	                    @php
	                        $hasTime = isset($time);
	                    @endphp

						<form action="{{ $hasTime ? route('time-lists.update', $time->id) : route('time-lists.store') }}" method="POST">
							@csrf
							@if($hasTime)
								@method('PUT')
							@endif
							<div class="form-group row">
								<label for="from" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>
								<div class="col-md-6">
									<input type="time" name="from" class="form-control" value="{{ $hasTime ? $time->from : old('from') }}">
								</div>
							</div>

							<div class="form-group row">
								<label for="to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>
								<div class="col-md-6">
									<input type="time" name="to" class="form-control" value="{{ $hasTime ? $time->to : old('to') }}">
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="{{ route('time-lists.index') }}" class="btn btn-secondary">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection