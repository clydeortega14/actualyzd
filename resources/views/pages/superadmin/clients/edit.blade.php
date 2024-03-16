@extends('layouts.app')

@section('custon_styles')

<link rel="stylesheet" type="text/css" href="{{ asset('css/user-lists-styles.css') }}">

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
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Company Information</button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Subscriptions</button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Employees</button>
						  	</li>
						</ul>
					</div>

					<div class="card-body">
						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						  		<div class="m-3">
						  			@include('pages.superadmin.clients.includes.company-info')
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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