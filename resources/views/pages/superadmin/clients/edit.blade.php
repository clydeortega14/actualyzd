@extends('layouts.sb-admin.master')

@section('content')

	<div class="container-fluid">

		<div class="row clearfix">
			<div class="col-md-4 border-right">
				<div class="card mb-3">
					<div class="card-header">Client Details</div>
					<div class="card-body">
						<form action="#" method="POST">
							@csrf

							@if(isset($client))
								@method('PUT')
							@endif


							<div class="form-group">
	                            <label for="company-name">Company Name</label>
	                        	<input type="text" name="name" id="company-name" class="form-control @error('name') error @enderror " value="{{ $client->name }}" readonly>
		                    </div>

		                    <div class="form-group">
		                        <label for="company-email">Company Email</label>
		                        <input type="text" name="email" id="company-email" class="form-control @error('email') error @enderror" value="{{ $client->email }}" readonly>
		                    </div>

		                    <div class="form-group">
		                    	<label for="no-of-employees">No. of employees</label>
		                    	<input type="number" name="no_of_employees" id="no-of-employees" class="form-control @error('no_of_employees') error @enderror" value="{{ $client->number_of_employees }}" readonly>
		                    </div>

		                    <div class="form-group">
		                    	<label for="contact-number">Contact Number</label>
		                    	<input type="text" name="contact_number" id="contact-number" class="form-control @error('contact_number') error @enderror" value="{{ $client->contact_number }}" readonly>
		                    </div>

		                    <div class="form-group">
		                        <label for="company-address">Company Address</label>
		                        <textarea class="form-control no-resize  @error('address') error @enderror" rows="4" name="address" id="company-address" readonly>{{ $client->postal_address }}</textarea>
		                    </div>
	                    </form>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="row">
					@foreach($packages as $package)
						<div class="col-md-4">
							<div class="card mb-3">
								<div class="card-header">{{ $package->name.' - '.$package->price.' Pesos for '.$package->no_of_months.' Months' }}</div>

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
										<input type="radio" name="package_service" value="{{ $package->id }}">
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				
			</div>
		</div>
	</div>

@endsection