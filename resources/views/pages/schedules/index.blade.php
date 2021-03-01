@extends('layouts.sb-admin.master')

@section('css_links')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">

@endsection

@section('content')

	<div class="container" id="main-index">

		<div class="row">
	        <div class="col-sm-12">
	            <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                        @include('pages.schedules.modals.create-schedule')
                    </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection

@section('js_scripts')

	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
	<script type="module" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>

@endsection