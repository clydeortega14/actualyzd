@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		<h1 class="h3 mb-3 text-gray-800">FAQ's</h1>
		{{ Breadcrumbs::render() }}

		<button type="button" class="btn btn-primary btn-block mr-2">
			<i class="fa fa-check"></i>
			<span>Submit</span>
		</button>

		<button type="button" class="btn btn-secondary btn-block mb-2">
			<i class="fa fa-times"></i>
			<span>Cancel</span>
		</button>

		

		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						FAQ Information
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="title" class="form-control">
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
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-step">
								<i class="fa fa-plus"></i>
								<span>Add New Step</span>
							</button>

							<!-- FAQ Step Modal -->
							@include('pages.faq.modals.step')
						</div>
					</div>

					<div class="card-body">
						<h5 class="card-title text-center text-gray">No Steps / Procedure</h5>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop