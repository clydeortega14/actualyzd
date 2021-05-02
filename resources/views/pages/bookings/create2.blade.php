@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				{{ Breadcrumbs::render() }}
			</div>
		</div>
		@php
			$user = auth()->user();
			$user_role;
		@endphp

		@if($user->hasRole('superadmin'))
			@php
				$user_role = 'superadmin';
			@endphp
		@elseif($user->hasRole('admin'))
			@php
				$user_role = 'admin';
			@endphp
		@elseif($user->hasRole('psychologist'))
			@php
				$user_role = 'psychologist';
			@endphp
		@elseif($user->hasRole('member'))
			@php
				$user_role = 'member';
			@endphp
		@endif

		<calendar-page 
			@if(isset($booking)) :booking="{{ $booking }}" @endif 
			user_role="{{ $user_role }}">	
		</calendar-page>
	</div>
	
@stop