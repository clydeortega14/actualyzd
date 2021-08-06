@extends('layouts.app')


@section('content')
	

	<div class="container-fluid">
		<div class="row offset-md-3">
			<div class="col-md-8">
				<h4>New Package</h4>
				<hr>
				<a href="{{ route('home') }}" class="btn btn-info mr-2">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
				<a href="{{ route('setups.home') }}" class="btn btn-outline-info mr-2">
					<i class="fa fa-cogs"></i>
					<span>Set ups</span>
				</a>
				<a href="{{ route('packages.index') }}" class="btn btn-outline-info mr-2">
					<i class="fa fa-clipboard-list"></i>
					<span>Packages Lists</span>
				</a>

				{{-- @include('alerts.message') --}}
				<div class="card mb-3 mt-3">
					<div class="card-body">
						<form action="{{ isset($package) ? route('packages.update', $package->id) : route('packages.store') }}" method="POST">
							@csrf
							@if(isset($package))
								@method('PUT')
							@endif
							<div class="form-group">
								<label>Package Name</label>
								<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($package) ? $package->name : old('name') }}">
								@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror">{{ isset($package) ? $package->description : old('description') }}</textarea>
								@error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ isset($package) ? $package->price : old('price') }}">
								@error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<label>Number Of Months Valid</label>
								<input type="number" name="no_of_months" class="form-control @error('no_of_months') is-invalid @enderror" value="{{ isset($package) ? $package->no_of_months : old('no_of_months') }}">
								@error('no_of_months')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="{{ route('packages.index') }}" class="btn btn-secondary">Cancel</a>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection