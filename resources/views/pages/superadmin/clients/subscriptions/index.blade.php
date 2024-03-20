@extends('layouts.app')

@section('content')

	<div class="container-fluid">

		<div class="row clearfix mb-3">
	    	<div class="col-12">
                <h3 class="mb-3 text-gray-800">Client Profile</h3>
            </div>
        </div>

		<div class="row clearfix">

			<div class="col-md-12">

				@include('alerts.message')

				<div class="card mb-3">

					<div class="card-header">
						@include('pages.superadmin.clients.includes.client-profile-nav')
					</div>

					<div class="card-body">
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade">
						  		<div class="m-3">
						  			@include('pages.superadmin.clients.includes.company-info')
						  		</div>
						  	</div>
						  	<div class="tab-pane fade show active">
						  		<div class="m-3">
						  			@include('pages.superadmin.clients.includes.subscription')
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						  		<div class="m-3">
						  			@include('pages.superadmin.clients.includes.employees')
						  		</div>
						  	</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection