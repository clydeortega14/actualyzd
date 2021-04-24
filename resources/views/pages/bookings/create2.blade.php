@extends('layouts.app')


@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{{ Breadcrumbs::render() }}

				<calendar-page @if(isset($booking)) :booking="{{ $booking }}" @endif></calendar-page>
			</div>
		</div>
	</div>
	
@stop