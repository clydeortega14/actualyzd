@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">FAQ's</h1>
		{{ Breadcrumbs::render() }}


		@if(session()->has('error'))

			<div class="alert alert-danger" role="alert">
				{{ session('error') }}
			</div>

		@endif

		@if(session()->has('success'))

			<div class="alert alert-success" role="alert">
				{{ session('success') }}
			</div>

		@endif

		<form action="{{ route('faqs.store') }}" method="POST">
			@csrf
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							FAQ Information
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="title" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Description</label>
								<input type="text" name="description" class="form-control">
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="card mb-3">
						<div class="card-header">
							<div class="d-flex justify-content-between">
								FAQ Steps / Procedure
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-step" align="right">
									<i class="fa fa-plus"></i>
									<span>Add New Step</span>
								</button>
							</div>

							
								<!-- FAQ Step Modal -->
								{{-- @include('pages.faq.modals.step') --}}
						</div>

						<div class="card-body">

							<!-- Step Lists Component -->
							<faq-setup-steps></faq-setup-steps>
						</div>

						<div class="card-footer">
							<!-- Step Buttons -->
							<faq-setup-buttons></faq-setup-buttons>
						</div>
					</div>
				</div>
			</div>
		</form>

		<div>
			<faq-setup-addstep></faq-setup-addstep>
		</div>
	</div>

@stop