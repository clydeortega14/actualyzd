@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('booking.store.date-time') }}" method="GET">
							<bookings-calendar></bookings-calendar>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop