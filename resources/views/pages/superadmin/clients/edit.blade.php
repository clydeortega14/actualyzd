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
						@include('pages.superadmin.clients.includes.client-profile-nav')
					</div>

					<div class="card-body">
						@include('pages.superadmin.clients.includes.tab-content')
					</div>
					
				</div>
			</div>
		</div>
	</div>

@endsection