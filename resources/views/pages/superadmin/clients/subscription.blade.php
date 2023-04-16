@extends('layouts.app')

@section('title', 'Client Subscription')


@section('content')

	<div class="container-fluid">

		<div class="row clearfix mb-3">
	    	<div class="col-12">
                <h3 class="mb-3 text-gray-800">Subscriptions</h3>
            </div>
        </div>

		<form action="{{ route('add.client.subscription') }}" method="POST">
			@csrf
			<div class="row">
				
				<input type="hidden" name="client_id" value="{{ $client->id}}">

				@if(count($packages) > 0)
					
						@foreach($packages as $package)
							<div class="col-md-4">
								<div class="card mb-3">
									<div class="card-header">
										<div class="d-sm-flex justify-content-between">
											<div>{{ $package->name }} - &#8369; {{ $package->formattedPrice() }}</div>
											<div>{{ $package->no_of_months }} {{ $package->no_of_months <= 1 ? 'Month' : 'Months'}}</div>
										</div>
										
									</div>

									<div class="card-body">
										<div class="row justify-content-center">
											<ul>
												@foreach($package->services as $service)
													<li>{{ $service->limit.' '.$service->sessionType->name}}</li>
												@endforeach
											</ul>
										</div>
										
									</div>

									<div class="card-footer">
										<div class="d-flex justify-content-center">
											<input type="radio" name="package_id" value="{{ $package->id }}">
										</div>
									</div>
								</div>
							</div>
						@endforeach

						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="row justify-content-between">
										<div class="col-md-4">
											<a href="{{ route('clients.index') }}" class="btn btn-danger">
												<i class="fa fa-times"></i>
												<span>Cancel</span>
											</a>
										</div>
										<div class="col-md-4" align="right">
											<button type="submit" class="btn btn-primary">
												<i class="fa fa-check"></i>
												<span>Submit</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					
				@else

					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center text-center">
									<h5 class="card-title">No Subscriptions Available</h5>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</form>
	</div>

@stop